<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\PatientController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Helpers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/', [UserController::class, 'authenticate'])->name('auth.login');

Route::post('/logout', [UserController::class, 'disauthenticate'])->name('auth.logout')->middleware('auth');

/**** PASSWORD RESET ****/
Route::middleware(['guest'])->group(function () {
    Route::get('/forgot-password', function () {
        return view('general.request_email');
    })->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->merge([
            'email' => Helpers::emptyToNull($request->input('email')),
        ]);

        $request->validate(
            ['email' => 'required|string|email|max:255|exists:users,email'],
            [
                'email.required' => 'El correo es requerido.',
                'email.string' => 'El correo debe ser una cadena.',
                'email.email' => 'El correo debe ser una dirección de correo válida.',
                'email.max' => 'El correo debe tener máximo :max caracteres.',
                'email.exists' => 'El correo no está registrado.',
            ]
        );

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with('message', 'Si su correo está registrado, hemos enviado un enlace para restablecer su contraseña!')
            : back()->withErrors(['email' => 'Ha ocurrido un error, por favor intentelo más tarde.']);
    })->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('general.change_password', ['token' => $token]);
    })->name('password.reset');

    Route::put('/reset-password', function (Request $request) {
        $request->merge([
            'token' => Helpers::emptyToNull($request->input('token')),
            'email' => Helpers::emptyToNull($request->input('email')),
            'password' => Helpers::emptyToNull($request->input('password')),
            'confirm_password' => Helpers::emptyToNull($request->input('confirm_password')),
        ]);

        $request->validate(
            [
                'token' => 'required|string',
                'email' => 'required|string|email|max:255|exists:users,email',
                'password' => 'required|string|min:8|max:255',
                'confirm_password' => 'required|string|min:8|max:255|same:password',
            ],
            [
                'token.required' => 'El token es requerido.',
                'token.string' => 'El token debe ser una cadena.',

                'email.required' => 'El correo es requerido.',
                'email.string' => 'El correo debe ser una cadena.',
                'email.email' => 'El correo debe ser una dirección de correo válida.',
                'email.max' => 'El correo debe tener máximo :max caracteres.',
                'email.exists' => 'El correo no está registrado.',

                'password.required' => 'La contraseña es requerida.',
                'password.string' => 'La contraseña debe ser una cadena.',
                'password.min' => 'La contraseña debe tener al menos :min caracteres.',
                'password.max' => 'La contraseña debe tener máximo :max caracteres.',

                'confirm_password.required' => 'La confirmación de contraseña es requerida.',
                'confirm_password.string' => 'La confirmación de contraseña debe ser una cadena.',
                'confirm_password.min' => 'La confirmación de contraseña debe tener al menos :min caracteres.',
                'confirm_password.max' => 'La confirmación de contraseña debe tener máximo :max caracteres.',
                'confirm_password.same' => 'Las contraseñas no coinciden.',
            ]
        );

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('message', 'Hemos restablecido tu contraseña! Puedes iniciar sesión.')
            : redirect()->route('password.request')->withErrors(['email' => 'Ocurrió un error, por favor intentelo de nuevo.']);
    })->name('password.update');
});

/**** VERIFICATION ****/
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        return view('general.verify_email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/psycho-dashboard');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Enlace de verificación enviado!');
    })->middleware('throttle:6,1')->name('verification.send');
});

/**** GENERAL USER ****/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $authUser = Auth::user();
        $authUser->load(['role']);

        switch ($authUser->role->slug) {
            case 'administrator':
                return redirect()->route('admin_dashboard');
                break;
            case 'psychologist':
                return redirect()->route('psycho_dashboard');
                break;
            case 'patient':
                return redirect()->route('patient_dashboard');
                break;
            default:
                abort(403, 'Acceso denegado.');
                break;
        }
    })->name('dashboard');

    Route::delete('/delete-avatar/{user}', [UserController::class, 'deleteAvatar'])->where('user', '[0-9]+')->name('delete_avatar');

    /*PSICOLOGOS*/
    Route::get('/admin-detalle-usuario-psicologo/{psychologist}', [PsychologistController::class, 'show'])->name('admin_detalle_usuario_psicologo')->where('psychologist', '[0-9]+');
    /*PSICOLOGOS*/

    /*PACIENTES*/
    Route::get('/admin-detalle-usuario-paciente/{patient}', [PatientController::class, 'show'])->name('admin_detalle_usuario_paciente')->where('patient', '[0-9]+');

    Route::get('/admin-actualizar-paciente/{patient}', [PatientController::class, 'showUpdate'])->name('admin_actualizar_paciente')->where('patient', '[0-9]+');

    Route::put('/update-patient/{patient}', [PatientController::class, 'update'])->name('update_patient')->where('patient', '[0-9]+');
    /*PACIENTES*/
});

/**** PSYCHOLOGIST ****/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/psycho-dashboard', [PsychologistController::class, 'index'])->name('psycho_dashboard');
    Route::get('/pendiente', function () {
        return 'Pendiente';
    })->name('pendiente');
});

/**** ADMIN AND PSYCHOLOGIST ****/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::delete('/delete-account/{user}', [UserController::class, 'destroy'])->where('user', '[0-9]+')->name('delete_account');

    /*PSICOLOGOS*/
    Route::get('/admin-actualizar-psicologo/{psychologist}', [PsychologistController::class, 'showUpdate'])->name('admin_actualizar_psicologo')->where('psychologist', '[0-9]+');

    Route::put('/update-psychologist/{psychologist}', [PsychologistController::class, 'update'])->name('update_psychologist')->where('psychologist', '[0-9]+');
    /*PSICOLOGOS*/

    /*PACIENTES*/
    Route::get('/admin-registrar-paciente', function () {
        return view('admin.admin_registrar_paciente');
    })->name('admin_registrar_paciente');

    Route::post('/store-patient', [PatientController::class, 'store'])->name('store_patient');
    /*PACIENTES*/
});

/**** ADMIN ****/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin_dashboard');

    Route::get('/admin-usuarios', [UserController::class, 'findAll'])->name('admin_usuarios');

    /*PSICOLOGOS*/
    Route::get('/admin-registrar-psicologo', function () {
        return view('admin.admin_registrar_psicologo');
    })->name('admin_registrar_psicologo');

    Route::post('/store-psychologist', [PsychologistController::class, 'store'])->name('store_psychologist');
    /*PSICOLOGOS*/
});
