<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        // Sanitización previa.
        $request->merge([
            'name' => trim($request->input('name')),
            'password' => trim($request->input('password')),
            'remember_token' => boolval(trim($request->input('remember_token'))),
        ]);

        // Validación de los datos de entrada. 
        $credentials = $request->validate(
            [
                'name' => 'required|string|max:255',
                'password' => 'required|string|max:255',
                'remember_token' => 'sometimes|boolean',
            ],
            [
                'name.required' => 'El campo de nombre es obligatorio.',
                'name.string' => 'El nombre debe ser una cadena de texto.',
                'name.max' => 'El nombre no puede tener más de 255 caracteres.',
                'password.required' => 'El campo de contraseña es obligatorio.',
                'password.string' => 'La contraseña debe ser una cadena de texto.',
                'password.max' => 'La contraseña no puede tener más de 255 caracteres.',
                'remember_token.boolean' => 'El token de recordatorio debe ser verdadero o falso.',
            ]
        );

        $user_and_pass = [
            'name' => $credentials['name'],
            'password' => $credentials['password'],
            'is_active' => true,
            'is_visible' => true
        ];

        if (Auth::attempt($user_and_pass, $credentials['remember_token'])) {
            // Regenera la sesión para evitar la fijación de sesión.
            $request->session()->regenerate();

            if (Auth::user()->role->slug === 'administrator') {
                return redirect()->route('admin_dashboard');
            }

            if (Auth::user()->role->slug === 'psychologist') {
                return redirect()->route('request_email');
            }

            return redirect()->route('change_password');
        }

        return back()->withErrors([
            'credentials' => 'El nombre de usuario y/o contraseña son incorrectos o el usuario no esta activo.',
        ])->onlyInput('email');
    }

    public function disauthenticate(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Has cerrado sesión exitosamente.');
    }

    public function findAll(Request $request)
    {
        // Sanitización previa.
        $request->merge([
            'nameOrEmail' => Helpers::emptyToNull($request->query('nameOrEmail')),
            'rol_id' => Helpers::emptyToNull($request->query('rol_id')),
            'is_active' => Helpers::emptyToNull($request->query('is_active')),
            'page' => intval($request->query('page') ?? 1),
        ]);

        // Validación de los datos de entrada.
        $data = $request->validate([
            'nameOrEmail' => 'nullable|string|max:255',
            'rol_id' => 'nullable|integer|exists:roles,id|in:2,3',
            'is_active' => 'nullable|boolean',
            'page' => 'required|integer|min:1',
        ], [
            'nameOrEmail.string' => 'El nombre o email debe ser una cadena de texto.',
            'nameOrEmail.max' => 'El nombre o email no puede tener más de 255 caracteres.',
            'rol_id.integer' => 'El rol debe ser un entero.',
            'rol_id.exists' => 'El rol no existe.',
            'is_active.boolean' => 'El estado debe ser verdadero o falso.',
            'page.required' => 'La página es obligatoria.',
            'page.integer' => 'La página debe ser un entero.',
            'page.min' => 'La página debe ser mayor o igual a 1.',
        ]);

        $limit = 6; // Registros por página.

        $usersQuery = User::with(['role', 'patient', 'psychologist'])->where('is_visible', true)->whereNot('rol_id', 1);

        $usersQuery->when($data['nameOrEmail'], function ($query) use ($data) {
            $query->where(function ($subQuery) use ($data) { // Todas las condiciones deben estar agrupadas por parentesis logicos.
                $subQuery->where('full_name', 'like', '%' . $data['nameOrEmail'] . '%')
                    ->orWhere('email', 'like', '%' . $data['nameOrEmail'] . '%');
            });
        })->when($data['rol_id'], function ($query) use ($data) {
            $query->where('rol_id', $data['rol_id']);
        })->when(!is_null($data['is_active']), function ($query) use ($data) {
            $query->where('is_active', $data['is_active']);
        });

        // Paginando resultados, con limite de 6 resultados por página.

        $users = $usersQuery->paginate(perPage: $limit);

        return view('admin.admin_usuarios', compact('users'));
    }

    public function destroy(User $user)
    {
        abort_if(!$user->is_visible, 403, 'Acceso denegado.');

        try {
            $user->is_active = false;
            $user->is_visible = false;
            $user->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('error', 'El usuario no pudo ser eliminado.');
        }

        return redirect()->route('admin_usuarios')->with('message', 'El usuario fue eliminado exitosamente.');
    }

    public function deleteAvatar(User $user)
    {
        abort_if(!$user->is_visible, 403, 'Acceso denegado.');

        try {
            if ($user->avatar_url !== 'UploadFiles/default-avatar.png' && Storage::disk('public')->exists($user->avatar_url)) {
                Storage::disk('public')->delete($user->avatar_url);
            }
            $user->avatar_url = 'UploadFiles/default-avatar.png';
            $user->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'El avatar no pudo ser eliminado, inténtelo nuevamente.']);
        }

        return redirect()->back()->with('message', 'El avatar fue eliminado exitosamente.');
    }
}
