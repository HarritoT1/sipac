<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePsychologistRequest;
use App\Http\Requests\UpdatePsychologistRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Psychologist;
use App\Models\SessionRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helpers;

class PsychologistController extends Controller
{
    public function index(Request $request)
    {
        $userAuth = Auth::user();
        $userAuth->load('psychologist');

        abort_if(!$userAuth->psychologist, 403, 'Acceso denegado.');

        //Proxima cita respecto al momento actual.
        $actualAppointment = Appointment::with('patient.user')->where('psychologist_id', $userAuth->psychologist->id)->where('scheduled_at', '>', now())->orderBy('scheduled_at', 'asc')->first();
        $nextAppointment = null;
        $beforeAppointment = null;

        if (isset($actualAppointment)) {
            $nextAppointment = Appointment::with('patient.user')->where('psychologist_id', $userAuth->psychologist->id)->where('scheduled_at', '>', $actualAppointment->scheduled_at)->orderBy('scheduled_at', 'asc')->first();
        }

        if (isset($actualAppointment)) {
            $beforeAppointment = Appointment::with('patient.user')->where('psychologist_id', $userAuth->psychologist->id)->where('scheduled_at', '<', $actualAppointment->scheduled_at)->latest('scheduled_at')->first();
        } else {
            $beforeAppointment = Appointment::with('patient.user')->where('psychologist_id', $userAuth->psychologist->id)->latest('scheduled_at')->first();
        }

        $cancelledAppointments = Appointment::where('psychologist_id', $userAuth->psychologist->id)->where('status', 'cancelled')->count();
        $completedAppointments = Appointment::where('psychologist_id', $userAuth->psychologist->id)->where('status', 'completed')->count();
        $pendingAppointments = Appointment::where('psychologist_id', $userAuth->psychologist->id)->where('status', 'scheduled')->count();

        $lastSession = SessionRecord::with('appointment.patient.user')->whereHas('appointment', function ($query) use ($userAuth) {
            $query->where('psychologist_id', $userAuth->psychologist->id);
        })->latest()->first();

        $data = compact('userAuth', 'actualAppointment', 'nextAppointment', 'beforeAppointment', 'cancelledAppointments', 'completedAppointments', 'pendingAppointments', 'lastSession');

        //dd($data);
        return view('psychologist.psycho_dashboard', $data)->with('status', Helpers::$status)->with('statusColors', Helpers::$statusColors)->with('modality', Helpers::$modality);
    }

    public function show(Psychologist $psychologist, Request $request)
    {
        $psychologist->load('user');

        abort_if(!$psychologist->user->is_visible, 403, 'Acceso denegado.');

        $number_appointments = $psychologist->appointments()->count();
        $number_sessions = SessionRecord::whereHas('appointment', function ($query) use ($psychologist) {
            $query->where('psychologist_id', $psychologist->id);
        })->count();
        $specialities = implode(' / ', explode(',', $psychologist->specialty));

        $data = compact('psychologist', 'number_appointments', 'number_sessions', 'specialities');

        $userAuth = Auth::user();
        $userAuth->load(['role', 'psychologist', 'patient']);

        $view = null;

        // Decide que vista mostrar dependiendo del rol del usuario autenticado.
        switch ($userAuth->role->slug) {
            case 'administrator':
                $view = 'admin.admin_detalle_usuario_psicologo';
                break;
            case 'psychologist':
                $view = 'psychologist.psycho_detalle_usuario_psicologo';
                break;
            case 'patient':
                $view = 'patient.patient_detalle_usuario_psicologo';
                break;
            default:
                abort(403, 'Acceso denegado.');
                break;
        }

        //dd($data);
        return view($view)->with($data)->with('userAuth', $userAuth);
    }

    public function store(CreatePsychologistRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        unset($data['confirm_password']);

        $data['avatar_url'] ??= null;

        //dd($data);

        $path = null;

        try {
            if ($request->hasFile('avatar_url') && $request->file('avatar_url')->isValid()) {
                $image = $request->file('avatar_url');
                $imageName = Str::uuid() . '.' . $image->extension();
                $path = $image->storeAs('UploadFiles', $imageName, 'public');
                $data['avatar_url'] = $path; // Sustituimos la imagen de tipo UploadedFile por una ruta en string en el array $data.
            }

            $psychologist = DB::transaction(function () use ($data) {
                $user = User::create([
                    'full_name' => $data['full_name'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone_number' => $data['phone_number'],
                    'password' => $data['password'],
                    'curp' => Str::upper($data['curp']),
                    'home_address' => $data['home_address'],
                    'avatar_url' => $data['avatar_url'] ?? 'UploadFiles/default-avatar.png',
                    'rol_id' => Role::where('slug', 'psychologist')->value('id') ?? 2
                ]);

                return Psychologist::create([
                    'user_id' => $user->id,
                    'professional_license' => Str::upper($data['professional_license']),
                    'years_experience' => $data['years_experience'],
                    'consultation_fee' => $data['consultation_fee'] ?? 0.00,
                    'professional_bio' => $data['professional_bio'],
                    'specialty' => implode(',', $data['specialty']),
                ]);
            });
        } catch (\Throwable $e) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            Log::error($e->getMessage() . ' -> TIMESTAMP: ' . now());

            return redirect()->back()->withErrors(['error' => 'El psicólogo no pudo ser registrado en este momento, por favor intente nuevamente.']);
        }

        event(new Registered($psychologist->user));

        return redirect()->route('admin_detalle_usuario_psicologo', ['psychologist' => $psychologist->id])->with('message', 'Psicólogo registrado correctamente.');
    }

    public function showUpdate(Psychologist $psychologist, Request $request)
    {
        $psychologist->load('user');

        abort_if(!$psychologist->user->is_visible, 403, 'Acceso denegado.');

        $psychologist->specialty = explode(',', $psychologist->specialty);

        $userAuth = Auth::user();
        $userAuth->load(['role', 'psychologist']);

        $view = null;

        // Decide que vista mostrar dependiendo del rol del usuario autenticado.
        switch ($userAuth->role->slug) {
            case 'administrator':
                $view = 'admin.admin_actualizar_psicologo';
                break;
            case 'psychologist':
                $view = 'psychologist.psycho_actualizar_psicologo';
                break;
            default:
                abort(403, 'Acceso denegado.');
                break;
        }

        return view($view)->with('psychologist', $psychologist);
    }

    public function update(Psychologist $psychologist, UpdatePsychologistRequest $request)
    {
        $psychologist->load('user');

        abort_if(!$psychologist->user->is_visible, 403, 'Acceso denegado.');

        // Si alguien altero el user_id o psychologist_id, no se puede actualizar.
        abort_if($request->user_id != $psychologist->user_id || $request->psychologist_id != $psychologist->id, 403, 'Acceso denegado.');

        $data = $request->validated();

        $data['avatar_url'] ??= null;

        //dd($data);

        $path = null;

        $oldAvatarUrl = $psychologist->user->avatar_url;

        try {
            if ($request->hasFile('avatar_url') && $request->file('avatar_url')->isValid()) {
                $image = $request->file('avatar_url');
                $imageName = Str::uuid() . '.' . $image->extension();
                $path = $image->storeAs('UploadFiles', $imageName, 'public');
                $data['avatar_url'] = $path; // Sustituimos la imagen de tipo UploadedFile por una ruta en string en el array $data.
            }

            DB::transaction(function () use ($data, $psychologist, $oldAvatarUrl) {
                $psychologist->user->update([
                    'full_name' => $data['full_name'],
                    'name' => $data['name'],
                    'is_active' => $data['is_active'],
                    'phone_number' => $data['phone_number'],
                    'curp' => Str::upper($data['curp']),
                    'home_address' => $data['home_address'],
                    'avatar_url' => $data['avatar_url'] ?? $oldAvatarUrl,
                ]);

                $psychologist->update([
                    'professional_license' => Str::upper($data['professional_license']),
                    'years_experience' => $data['years_experience'],
                    'consultation_fee' => $data['consultation_fee'] ?? 0.00,
                    'professional_bio' => $data['professional_bio'],
                    'specialty' => implode(',', $data['specialty']),
                ]);
            });

            // Si se actualizo la imagen, se elimina la antigua sin afectar el flujo principal.
            try {
                if ($path && Storage::disk('public')->exists($path) && Storage::disk('public')->exists($oldAvatarUrl) && $oldAvatarUrl != 'UploadFiles/default-avatar.png') {
                    Storage::disk('public')->delete($oldAvatarUrl);
                }
            } catch (\Throwable $e) {
                Log::warning($e->getMessage() . ' -> TIMESTAMP: ' . now());
            }
        } catch (\Throwable $e) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            Log::error($e->getMessage() . ' -> TIMESTAMP: ' . now());

            return redirect()->back()->withErrors(['error' => 'El psicólogo no pudo ser actualizado en este momento, por favor intente nuevamente.']);
        }

        return redirect()->route('admin_detalle_usuario_psicologo', ['psychologist' => $psychologist->id])->with('message', 'Psicólogo actualizado correctamente.');
    }
}
