<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

/**** GENERAL ****/

Route::get('/request-email', function () {
    return view('general.request_email');
})->name('request_email');

Route::get('/change-password', function () {
    return view('general.change_password');
})->name('change_password');

/**** ADMIN ****/

Route::get('/admin-dashboard', function () {
    return view('admin.admin_dashboard');
})->name('admin_dashboard');

Route::get('/admin-usuarios', function () {
    return view('admin.admin_usuarios');
})->name('admin_usuarios');

Route::get('/admin-registrar-psicologo', function () {
    return view('admin.admin_registrar_psicologo');
})->name('admin_registrar_psicologo');

Route::get('/admin-registrar-paciente', function () {
    return view('admin.admin_registrar_paciente');
})->name('admin_registrar_paciente');

Route::get('/admin-registrar-paciente', function () {
    return view('admin.admin_registrar_paciente');
})->name('admin_registrar_paciente');

Route::get('/admin-detalle-usuario-psicologo/{id}', function ($id) {
    return view('admin.admin_detalle_usuario_psicologo');
})->name('admin_detalle_usuario_psicologo')->where('id', '[0-9]+');

Route::get('/admin-detalle-usuario-paciente/{id}', function ($id) {
    return view('admin.admin_detalle_usuario_paciente');
})->name('admin_detalle_usuario_paciente')->where('id', '[0-9]+');
