<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/', [UserController::class, 'authenticate'])->name('auth.login');

Route::post('/logout', [UserController::class, 'disauthenticate'])->name('auth.logout')->middleware('auth');

/**** GENERA USER ****/

Route::get('/request-email', function () {
    return view('general.request_email');
})->name('request_email');

Route::get('/change-password', function () {
    return view('general.change_password');
})->name('change_password');

Route::middleware(['auth'])->group(function () {
    Route::delete('/delete-account/{user}', [UserController::class, 'destroy'])->where('user', '[0-9]+')->name('delete_account');

    Route::delete('/delete-avatar/{user}', [UserController::class, 'deleteAvatar'])->where('user', '[0-9]+')->name('delete_avatar');
});

/**** ADMIN ****/

Route::middleware(['auth'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin_dashboard');

    Route::get('/admin-usuarios', [UserController::class, 'findAll'])->name('admin_usuarios');

    Route::get('/admin-registrar-psicologo', function () {
        return view('admin.admin_registrar_psicologo');
    })->name('admin_registrar_psicologo');

    Route::get('/admin-registrar-paciente', function () {
        return view('admin.admin_registrar_paciente');
    })->name('admin_registrar_paciente');

    Route::get('/admin-registrar-paciente', function () {
        return view('admin.admin_registrar_paciente');
    })->name('admin_registrar_paciente');

    /*PSICOLOGOS*/
    Route::get('/admin-detalle-usuario-psicologo/{psychologist}', [PsychologistController::class, 'show'])->name('admin_detalle_usuario_psicologo')->where('psychologist', '[0-9]+');

    Route::post('/store-psychologist', [PsychologistController::class, 'store'])->name('store_psychologist');

    Route::get('/admin-actualizar-psicologo/{psychologist}', [PsychologistController::class, 'showUpdate'])->name('admin_actualizar_psicologo')->where('psychologist', '[0-9]+');

    Route::put('/update-psychologist/{psychologist}', [PsychologistController::class, 'update'])->name('update_psychologist')->where('psychologist', '[0-9]+');
    /*PSICOLOGOS*/

    Route::get('/admin-detalle-usuario-paciente/{patient}', [PatientController::class, 'show'])->name('admin_detalle_usuario_paciente')->where('patient', '[0-9]+');

    Route::get('/admin-actualizar-paciente/{patient}', function ($id) {
        return view('admin.admin_actualizar_paciente');
    })->name('admin_actualizar_paciente')->where('patient', '[0-9]+');
});
