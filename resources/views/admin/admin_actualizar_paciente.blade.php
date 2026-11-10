@extends('admin.admin_layout')
@section('content')
    <script>
        document.querySelector('a[title="Usuarios"]').classList.add('active');
    </script>

    <div class="top-header">
        <h1 class="h3 mb-0 fw-bold text-dark">Actualizar Paciente</h1>
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
            <p class="text-secondary small mb-0">Actualiza los campos de interés del paciente en SIPAC.</p>
        </div>

        <form id="actForm" action="" method="post" enctype="multipart/form-data" novalidate autocomplete="off"
            class="needs-validation">
            @csrf
            @method('PUT')
            <div class="profile-section gap-4 mb-4 pb-2">
                <img id="avatar_preview" src="{{ asset('img/default-avatar.png') }}" alt="Avatar Psicólogo"
                    class="profile-avatar shadow-sm image-responsive mx-0" />
                <div class="d-flex flex-column gap-2 align-items-start">
                    <input onchange="previewImage(event, 'avatar_preview')" type="file"
                        class="form-control form-control-sm btn-outline-custom" accept="image/png, image/jpeg"
                        name="avatar_url" value="" />
                    <span class="text-secondary small" style="font-size: 0.75rem;">Formatos aceptados: PNG, JPG. Máximo
                        2MB.</span>
                    <button type="button" onclick="deleteAvatar('8')" class="btn-avatar-delete">Eliminar
                        Avatar</button>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label for="full_name" class="custom-label">Nombre y apellidos</label>
                    <input id="full_name" type="text" class="form-control form-control-custom"
                        placeholder="Ingrese el nombre completo" name="full_name" required maxlength="255" value="" />
                    <div class="invalid-feedback">
                        Ingresa un nombre completo válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="name" class="custom-label">Nombre de usuario (recuerda guardarlo)</label>
                    <input id="name" type="text" class="form-control form-control-custom"
                        placeholder="Usuario para inicio de sesión" name="name" required maxlength="255"
                        value="" />
                    <div class="invalid-feedback">
                        Ingresa un nombre de usuario válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="phone_number" class="custom-label">Teléfono</label>
                    <input id="phone_number" type="tel" class="form-control form-control-custom"
                        placeholder="10 dígitos numéricos" name="phone_number" required maxlength="20" value="" />
                    <div class="invalid-feedback">
                        Ingresa un número de teléfono válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="is_active" class="custom-label">Activo en el sistema</label>
                    <select class="form-control form-select text-secondary" id="is_active" name="is_active" required>
                        <option value="true" @selected(true)>Si</option>
                        <option value="false" @selected(false)>No</option>
                    </select>
                    <div class="invalid-feedback">
                        Selecciona si el paciente está activo en el sistema.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="curp" class="custom-label">CURP</label>
                    <input id="curp" type="text" class="form-control form-control-custom"
                        placeholder="Clave Única de Registro de Población" name="curp" required maxlength="18"
                        minlength="18" value="" />
                    <div class="invalid-feedback">
                        Ingresa un CURP válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="home_address" class="custom-label">Domicilio</label>
                    <input id="home_address" type="text" class="form-control form-control-custom"
                        placeholder="Calle, número, colonia, alcaldía o municipio" name="home_address" required
                        value="" />
                    <div class="invalid-feedback">
                        Ingresa un domicilio válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="birth_date" class="custom-label">Fecha de cumpleaños</label>
                    <input id="birth_date" type="date" name="birth_date"
                        class="form-control form-control-custom text-secondary" required value="" />
                    <div class="invalid-feedback">
                        Selecciona la fecha de nacimiento.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="gender" class="custom-label">Género</label>
                    <select class="form-control form-select text-secondary" id="gender" name="gender" required>
                        <option value="masculino" @selected('masculino' == 'masculino')>Masculino</option>
                        <option value="femenino" @selected('femenino' == 'femenino')>Femenino</option>
                        <option value="no binario" @selected('no binario' == 'no binario')>No binario</option>
                        <option value="prefiero no decir" @selected('prefiero no decir' == 'prefiero no decir')>Prefiero no decir</option>
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

            <form
                class="emergency-contact-block needs-validation d-flex justify-content-between gap-3 align-items-center existing"
                novalidate="" autocomplete="off" id="emergencyContactForm_{{ 8 }}" action=""
                method="post" enctype="application/x-www-form-urlencoded">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <label for="nameEmergencyContact_{{ 8 }}" class="form-label custom-label">Nombre y
                            apellidos</label>
                        <input type="text" class="form-control form-control-custom"
                            id="nameEmergencyContact_{{ 8 }}" name="nameEmergencyContact_{{ 8 }}"
                            placeholder="Ingresa el nombre completo" required maxlength="255"
                            value="{{ 'Juan Pérez' }}">
                        <div class="invalid-feedback">
                            Ingresa un nombre completo válido.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="relationshipEmergencyContact_{{ 8 }}"
                            class="form-label">Parentesco</label>
                        <select class="form-select text-secondary" id="relationshipEmergencyContact_{{ 8 }}"
                            name="relationshipEmergencyContact_{{ 8 }}" required>
                            <option value="padre" @selected('padre' == 'padre')>Padre</option>
                            <option value="madre" @selected('madre' == 'madre')>Madre</option>
                            <option value="hermano(a)" @selected('hermano(a)' == 'hermano(a)')>Hermano/a</option>
                            <option value="tio(a)" @selected('tio(a)' == 'tio(a)')>Tio/a</option>
                            <option value="primo(a)" @selected('primo(a)' == 'primo(a)')>Primo/a</option>
                            <option value="amigo(a)" @selected('amigo(a)' == 'amigo(a)')>Amigo/a</option>
                        </select>
                        <div class="invalid-feedback">
                            Selecciona un parentesco válido.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="emailEmergencyContact_{{ 8 }}" class="form-label">Correo
                            Electrónico</label>
                        <input type="email" class="form-control form-control-custom"
                            id="emailEmergencyContact_{{ 8 }}"
                            name="emailEmergencyContact_{{ 8 }}" placeholder="example@domain.com"
                            maxlength="255" value="{{ 'I6sY4@example.com' }}">
                        <div class="invalid-feedback">
                            Ingresa un correo electrónico válido.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="phone_numberEmergencyContact_{{ 8 }}" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control form-control-custom"
                            id="phone_numberEmergencyContact_{{ 8 }}"
                            name="phone_numberEmergencyContact_{{ 8 }}" placeholder="10 dígitos numéricos"
                            required maxlength="20" value="{{ 3355667788 }}">
                        <div class="invalid-feedback">
                            Ingresa un número de teléfono válido.
                        </div>
                    </div>

                    <div class="col-12 mt-3 form-check text-start mb-4 ms-2">
                        <label class="form-check-label" for="is_primary_{{ 8 }}"
                            style="color: #475569; font-size: 0.85rem;">
                            Este contacto es el principal para emergencias
                        </label>
                        <input class="form-check-input" type="checkbox" value="is-primary"
                            id="is_primary_{{ 8 }}" @checked(true)>
                    </div>
                </div>

                <button onclick="removeEmergencyContact(8)" type="button" class="btn-remove-contact"
                    title="Eliminar contacto">
                    <i class="bi bi-x-circle-fill"></i>
                </button>
            </form>
        </div>

        <!-- Botones de Acción -->
        <div class="form-actions border-top border-secondary-subtle pt-4 mt-0">
            <a href="{{ route('admin_detalle_usuario_paciente', ['id' => 8]) }}" target="_self" title="Cancelar"
                class="btn btn-cancel">Cancelar</a>
            <button onclick="patientCreateOrUpdateFormSubmit()" id="submit" type="submit"
                class="btn btn-custom-red px-4 py-2 rounded-3 shadow-sm" value="Registrar Paciente">
                Guardar cambios
            </button>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mt-3" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
