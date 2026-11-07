@extends('admin.admin_layout')
@section('content')
    <script>
        document.querySelector('a[title="Registrar Paciente"]').classList.add('active');
    </script>

    <div class="top-header">
        <h1 class="h3 mb-0 fw-bold text-dark">Registrar Paciente</h1>
        <div class="profile-section">
            <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Avatar Administrador"
                class="profile-avatar shadow-sm image-responsive" />
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold" style="font-size: 0.9rem;">Administrador</span>
                <span class="text-secondary" style="font-size: 0.8rem;">Perfil</span>
            </div>
        </div>
    </div>

    <div class="form-card-full p-4 p-md-5 mb-5">
        <div class="mb-4">
            <h2 class="h5 fw-bold text-dark mb-1">Información del Paciente</h2>
            <p class="text-secondary small mb-0">Completa los campos obligatorios para dar de alta al paciente en SIPAC.</p>
        </div>

        <form id="registerForm" action="" method="post" enctype="multipart/form-data" novalidate autocomplete="off"
            class="needs-validation">
            @csrf
            <div class="profile-section gap-4 mb-4 pb-2">
                <img id="avatar_preview" src="{{ asset('img/default-avatar.png') }}" alt="Avatar Psicólogo"
                    class="profile-avatar shadow-sm image-responsive mx-0" />
                <div class="d-flex flex-column gap-2 align-items-start">
                    <input onchange="previewImage(event, 'avatar_preview')" type="file"
                        class="form-control form-control-sm btn-outline-custom" accept="image/png, image/jpeg"
                        name="avatar_url" value="" />
                    <span class="text-secondary small" style="font-size: 0.75rem;">Formatos aceptados: PNG, JPG. Máximo
                        2MB.</span>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label for="full_name" class="custom-label">Nombre y apellidos</label>
                    <input id="full_name" type="text" class="form-control form-control-custom"
                        placeholder="Ingrese el nombre completo" name="full_name" required maxlength="255"
                        value="{{ old('full_name', '') }}" />
                    <div class="invalid-feedback">
                        Ingresa un nombre completo válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="name" class="custom-label">Nombre de usuario (recuerda guardarlo)</label>
                    <input id="name" type="text" class="form-control form-control-custom"
                        placeholder="Usuario para inicio de sesión" name="name" required maxlength="255"
                        value="{{ old('name', '') }}" />
                    <div class="invalid-feedback">
                        Ingresa un nombre de usuario válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="email" class="custom-label">Correo electrónico</label>
                    <input id="email" type="email" class="form-control form-control-custom"
                        placeholder="example@domain.com" name="email" required maxlength="255"
                        value="{{ old('email', '') }}" />
                    <div class="invalid-feedback">
                        Ingresa un correo electrónico válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="phone_number" class="custom-label">Teléfono</label>
                    <input id="phone_number" type="tel" class="form-control form-control-custom"
                        placeholder="10 dígitos numéricos" name="phone_number" required maxlength="20"
                        value="{{ old('phone_number', '') }}" />
                    <div class="invalid-feedback">
                        Ingresa un número de teléfono válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="password" class="custom-label">Contraseña</label>
                    <input id="password" type="text" class="form-control form-control-custom"
                        placeholder="Contraseña para inicio de sesión" name="password" required maxlength="255"
                        value="" />
                    <div class="valid-feedback" id="password_valid_feedback">
                        Contraseña válida.
                    </div>
                    <div class="invalid-feedback" id="password_invalid_feedback">
                        Ingresa una contraseña válida.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="confirm_password" class="custom-label">Confirmar Contraseña</label>
                    <input id="confirm_password" type="text" class="form-control form-control-custom"
                        placeholder="Confirma tu contraseña" name="confirm_password" required maxlength="255"
                        value="" />
                    <div class="valid-feedback" id="confirm_password_valid_feedback">
                        Contraseña válida.
                    </div>
                    <div class="invalid-feedback" id="confirm_password_invalid_feedback">
                        Las contraseñas no coinciden.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="curp" class="custom-label">CURP</label>
                    <input id="curp" type="text" class="form-control form-control-custom"
                        placeholder="Clave Única de Registro de Población" name="curp" required maxlength="18"
                        minlength="18" value="{{ old('curp', '') }}" />
                    <div class="invalid-feedback">
                        Ingresa un CURP válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="home_address" class="custom-label">Domicilio</label>
                    <input id="home_address" type="text" class="form-control form-control-custom"
                        placeholder="Calle, número, colonia, alcaldía o municipio" name="home_address" required
                        value="{{ old('home_address', '') }}" />
                    <div class="invalid-feedback">
                        Ingresa un domicilio válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="birth_date" class="custom-label">Fecha de cumpleaños</label>
                    <input id="birth_date" type="date" name="birth_date"
                        class="form-control form-control-custom text-secondary" required
                        value="{{ old('birth_date', '') }}" />
                    <div class="invalid-feedback">
                        Selecciona la fecha de nacimiento.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="gender" class="custom-label">Género</label>
                    <select class="form-control form-select text-secondary" id="gender" name="gender" required>
                        <option value="">Selecciona un género...</option>
                        <option value="masculino" @selected(old('gender') == 'masculino')>Masculino</option>
                        <option value="femenino" @selected(old('gender') == 'femenino')>Femenino</option>
                        <option value="no binario" @selected(old('gender') == 'no binario')>No binario</option>
                        <option value="prefiero no decir" @selected(old('gender') == 'prefiero no decir')>Prefiero no decir</option>
                    </select>
                    <div class="invalid-feedback">Selecciona el género.</div>
                </div>
            </div>
        </form>

        <!-- Sección Contactos de Emergencia -->
        <div class="border-top border-secondary-subtle mt-4 pt-4" id="emergencyContactsSection">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <h3 class="emergency-section-title mb-0">Agregue los contactos de emergencia del paciente</h3>
                <button onclick="addEmergencyContact()" type="button" class="btn-add-contact"
                    title="Agregar otro contacto">
                    <i class="bi bi-plus-circle-fill"></i>
                </button>
            </div>
            <p class="text-secondary small mb-3">Se recomienda por lo menos agregar uno.</p>
        </div>

        <!-- Botones de Acción -->
        <div class="form-actions border-top border-secondary-subtle pt-4 mt-0">
            <button onclick="patientCreateFormSubmit()" id="submit" type="submit"
                class="btn btn-custom-red px-4 py-2 rounded-3 shadow-sm" value="Registrar Paciente">
                Registrar Paciente
            </button>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('password')?.addEventListener('input', matchPasswords);
            document.getElementById('confirm_password')?.addEventListener('input', matchPasswords);
        });
    </script>
@endsection
