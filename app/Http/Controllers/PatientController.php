<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use App\Models\SessionRecord;
use Illuminate\Support\Facades\Log;
use App\Models\EmergencyContact;
use Illuminate\Auth\Events\Registered;
use Barryvdh\DomPDF\Facade\Pdf;

class PatientController extends Controller
{
    public function show(Patient $patient, Request $request)
    {
        $patient->load(['user', 'emergency_contacts']);

        abort_if(!$patient->user->is_visible, 403, 'Acceso denegado.');

        $number_appointments = $patient->appointments()->count();
        $lastAppointment = $patient->appointments()->where('status', 'completed')->latest('scheduled_at')->value('scheduled_at');
        $lastAppointmentDate = $lastAppointment ? $lastAppointment->locale('es')->isoFormat('D MMM') : 'Sin citas';

        $lastFiveAppointments = $patient->appointments()->latest()->limit(5)->get();

        $lastFiveAppointments->load(['psychologist.user']);

        $data = compact('patient', 'number_appointments', 'lastAppointmentDate', 'lastFiveAppointments');

        //dd($data);

        $userAuth = Auth::user();
        $userAuth->load(['role', 'psychologist', 'patient']);

        $view = null;

        // Decide que vista mostrar dependiendo del rol del usuario autenticado.
        switch ($userAuth->role->slug) {
            case 'administrator':
                $view = 'admin.admin_detalle_usuario_paciente';
                break;
            case 'psychologist':
                $view = 'psychologist.psycho_detalle_usuario_paciente';
                break;
            case 'patient':
                $view = 'patient.patient_detalle_usuario_paciente';
                break;
            default:
                abort(403, 'Acceso denegado.');
                break;
        }

        return view($view)->with($data)->with('status', Helpers::$status)->with('statusColors', Helpers::$statusColors)->with('userAuth', $userAuth);
    }

    public function store(CreatePatientRequest $request)
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

            $patient = DB::transaction(function () use ($data) {
                $user = User::create([
                    'full_name' => $data['full_name'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone_number' => $data['phone_number'],
                    'password' => $data['password'],
                    'curp' => Str::upper($data['curp']),
                    'home_address' => $data['home_address'],
                    'avatar_url' => $data['avatar_url'] ?? 'UploadFiles/default-avatar.png',
                    'rol_id' => Role::where('slug', 'patient')->value('id') ?? 3
                ]);

                $patient = Patient::create([
                    'user_id' => $user->id,
                    'birth_date' => $data['birth_date'],
                    'gender' => $data['gender'],
                ]);

                // Creando los contactos de emergencia (N nuevos registros en emergency_contacts).
                foreach ($data['emergency_contacts'] as $contact) {
                    EmergencyContact::create([
                        'patient_id' => $patient->id,
                        'name' => $contact['name'],
                        'relationship' => $contact['relationship'],
                        'phone_number' => $contact['phone_number'],
                        'email' => $contact['email'],
                        'is_primary' => $contact['is_primary'],
                    ]);
                }

                return $patient;
            });
        } catch (\Throwable $e) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            Log::error($e->getMessage() . ' -> TIMESTAMP: ' . now());

            return redirect()->back()->withErrors(['error' => 'El paciente no pudo ser registrado en este momento, por favor intente nuevamente.']);
        }

        event(new Registered($patient->user));

        return redirect()->route('admin_detalle_usuario_paciente', ['patient' => $patient->id])->with('message', 'Paciente registrado correctamente.');
    }

    public function showUpdate(Patient $patient)
    {
        $patient->load(['user', 'emergency_contacts']);

        abort_if(!$patient->user->is_visible, 403, 'Acceso denegado.');

        $userAuth = Auth::user();
        $userAuth->load(['role', 'psychologist', 'patient']);

        $view = null;

        // Decide que vista mostrar dependiendo del rol del usuario autenticado.
        switch ($userAuth->role->slug) {
            case 'administrator':
                $view = 'admin.admin_actualizar_paciente';
                break;
            case 'psychologist':
                $view = 'psychologist.psycho_actualizar_paciente';
                break;
            case 'patient':
                $view = 'patient.patient_actualizar_paciente';
                break;
            default:
                abort(403, 'Acceso denegado.');
                break;
        }

        return view($view)->with('patient', $patient)->with('userAuth', $userAuth);
    }

    public function update(Patient $patient, UpdatePatientRequest $request)
    {
        $patient->load('user');

        abort_if(!$patient->user->is_visible, 403, 'Acceso denegado.');

        // Si alguien altero el user_id, no se puede actualizar.
        abort_if($request->user_id != $patient->user_id, 403, 'Acceso denegado.');

        $data = $request->validated();

        $data['avatar_url'] ??= null;

        //dd($data);

        $path = null;

        $oldAvatarUrl = $patient->user->avatar_url;

        try {
            if ($request->hasFile('avatar_url') && $request->file('avatar_url')->isValid()) {
                $image = $request->file('avatar_url');
                $imageName = Str::uuid() . '.' . $image->extension();
                $path = $image->storeAs('UploadFiles', $imageName, 'public');
                $data['avatar_url'] = $path; // Sustituimos la imagen de tipo UploadedFile por una ruta en string en el array $data.
            }

            DB::transaction(function () use ($data, $patient, $oldAvatarUrl) {
                $patient->user->update([
                    'full_name' => $data['full_name'],
                    'name' => $data['name'],
                    'phone_number' => $data['phone_number'],
                    'is_active' => $data['is_active'],
                    'curp' => Str::upper($data['curp']),
                    'home_address' => $data['home_address'],
                    'avatar_url' => $data['avatar_url'] ?? $oldAvatarUrl,
                ]);

                $patient->update([
                    'birth_date' => $data['birth_date'],
                    'gender' => $data['gender'],
                ]);

                foreach ($data['emergency_contacts'] as $contact) {
                    $contactExists = EmergencyContact::where('id', $contact['id'])->first();

                    if ($contactExists) {
                        // Si el contacto ya existe y pertenece a otro paciente, no se puede actualizar.
                        if ($contactExists->patient_id != $patient->id) {
                            abort(403, 'Acceso denegado.');
                        }

                        $contactExists->update([
                            'name' => $contact['name'],
                            'relationship' => $contact['relationship'],
                            'phone_number' => $contact['phone_number'],
                            'email' => $contact['email'],
                            'is_primary' => $contact['is_primary'],
                        ]);
                    } else {
                        EmergencyContact::create([
                            'patient_id' => $patient->id,
                            'name' => $contact['name'],
                            'relationship' => $contact['relationship'],
                            'phone_number' => $contact['phone_number'],
                            'email' => $contact['email'],
                            'is_primary' => $contact['is_primary'],
                        ]);
                    }
                }

                // Eliminando los contactos de emergencia existentes.
                if ($data['contacts_deleted'] && count($data['contacts_deleted']) > 0) {
                    foreach ($data['contacts_deleted'] as $contactId) {
                        $contact = EmergencyContact::findOrFail($contactId);

                        // Si el contacto existente pertenece a otro paciente, no se puede actualizar.
                        if ($contact->patient_id != $patient->id) {
                            abort(403, 'Acceso denegado.');
                        }

                        $contact->delete();
                    }
                }
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

            return redirect()->back()->withErrors(['error' => 'El paciente no pudo ser actualizado en este momento, por favor intente nuevamente.']);
        }

        return redirect()->route('admin_detalle_usuario_paciente', ['patient' => $patient->id])->with('message', 'Paciente actualizado correctamente.');
    }

    public function findAll(Request $request)
    {
        $userAuth = Auth::user();
        $userAuth->load('psychologist');

        abort_if(!$userAuth->psychologist, 403, 'Acceso denegado.');

        // Sanitización previa.
        $request->merge([
            'nameOrEmail' => Helpers::emptyToNull($request->query('nameOrEmail')),
            'is_active' => Helpers::emptyToNull($request->query('is_active')),
            'page' => intval($request->query('page') ?? 1),
        ]);

        // Validación de los datos de entrada.
        $data = $request->validate([
            'nameOrEmail' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'page' => 'required|integer|min:1',
        ], [
            'nameOrEmail.string' => 'El nombre o email debe ser una cadena de texto.',
            'nameOrEmail.max' => 'El nombre o email no puede tener más de 255 caracteres.',
            'is_active.boolean' => 'El estado debe ser verdadero o falso.',
            'page.required' => 'La página es obligatoria.',
            'page.integer' => 'La página debe ser un entero.',
            'page.min' => 'La página debe ser mayor o igual a 1.',
        ]);

        $limit = 6; // Registros por página.

        $usersQuery = User::with(['patient'])->where('is_visible', true)->whereNotIn('rol_id', [1, 2]);

        $usersQuery->when($data['nameOrEmail'], function ($query) use ($data) {
            $query->where(function ($subQuery) use ($data) { // Todas las condiciones deben estar agrupadas por parentesis logicos.
                $subQuery->where('full_name', 'like', '%' . $data['nameOrEmail'] . '%')
                    ->orWhere('email', 'like', '%' . $data['nameOrEmail'] . '%');
            });
        })->when(!is_null($data['is_active']), function ($query) use ($data) {
            $query->where('is_active', $data['is_active']);
        });

        // Paginando resultados, con limite de 6 resultados por página.

        $users = $usersQuery->paginate(perPage: $limit);

        //dd($users->items());

        return view('psychologist.psycho_pacientes', compact('users', 'userAuth'));
    }

    public function report(Patient $patient, Request $request)
    {
        $patient->load(['user', 'emergency_contacts']);

        abort_if(!$patient->user->is_visible, 403, 'Acceso denegado.');

        $patientSessionRecords = SessionRecord::whereHas('appointment', function ($query) use ($patient) {
            $query->where('patient_id', $patient->id);
        })->oldest()->get();

        $data = compact('patient', 'patientSessionRecords');

        $pdf = Pdf::loadView('pdfs.paciente', $data);

        // Para abrirlo en el navegador:
        return $pdf->stream($patient->user->full_name . '.pdf');
    }
}
