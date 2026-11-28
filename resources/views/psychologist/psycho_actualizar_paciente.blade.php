@extends('psychologist.psycho_layout')
@section('content')
    <script>
        document.querySelector('a[title="Pacientes"]').classList.add('active');
    </script>

    <!-- Encabezado superior -->
    <div class="top-header">
        <h1 class="h3 mb-0 fw-bold text-dark">Actualizar paciente</h1>
        <a class="profile-section text-dark logout-link"
            href="{{ route('admin_detalle_usuario_psicologo', $userAuth->psychologist->id) }}" title="{{ $userAuth->name }}"
            target="_self">
            <img src="{{ asset('storage/' . $userAuth->avatar_url) }}" alt="{{ $userAuth->name }}"
                class="profile-avatar shadow-sm image-responsive" />
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold" style="font-size: 0.9rem;">{{ $userAuth->name }}</span>
                <span class="text-secondary" style="font-size: 0.8rem;">Psicólog@</span>
            </div>
        </a>
    </div>

    <div class="form-card-full p-4 p-md-5 mb-5">
        <div class="mb-4">
            <h2 class="h5 fw-bold text-dark mb-1">Información del Paciente</h2>
            <p class="text-secondary small mb-0">Actualiza los campos de interés del paciente en SIPAC.</p>
        </div>

        <form id="actForm" action="{{ route('update_patient', ['patient' => $patient->id]) }}" method="post"
            enctype="multipart/form-data" novalidate autocomplete="off" class="needs-validation">
            @csrf
            @method('PUT')

            <input id="user_id" type="hidden" name="user_id" value="{{ $patient->user->id }}" />

            <div class="profile-section gap-4 mb-4 pb-2">
                <img id="avatar_preview" src="{{ asset('storage/' . $patient->user->avatar_url) }}" alt="Avatar Psicólogo"
                    class="profile-avatar shadow-sm image-responsive mx-0" />
                <div class="d-flex flex-column gap-2 align-items-start">
                    <input onchange="previewImage(event, 'avatar_preview')" type="file"
                        class="form-control form-control-sm btn-outline-custom" accept="image/png, image/jpeg"
                        name="avatar_url" value="" />
                    <span class="text-secondary small" style="font-size: 0.75rem;">Formatos aceptados: PNG, JPG. Máximo
                        2MB.</span>
                    @if ($patient->user->avatar_url != 'UploadFiles/default-avatar.png')
                        <button type="button" onclick="deleteAvatar('{{ $patient->user->id }}')"
                            class="btn-avatar-delete">Eliminar
                            Avatar</button>
                    @endif
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label for="full_name" class="custom-label">Nombre y apellidos</label>
                    <input id="full_name" type="text" class="form-control form-control-custom"
                        placeholder="Ingrese el nombre completo" name="full_name" required maxlength="255" minlength="5"
                        value="{{ $patient->user->full_name }}" />
                    <div class="invalid-feedback">
                        Ingresa un nombre completo válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="name" class="custom-label">Nombre de usuario (recuerda guardarlo)</label>
                    <input id="name" type="text" class="form-control form-control-custom"
                        placeholder="Usuario para inicio de sesión" name="name" required maxlength="255" minlength="5"
                        value="{{ $patient->user->name }}" />
                    <div class="invalid-feedback">
                        Ingresa un nombre de usuario válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="phone_number" class="custom-label">Teléfono</label>
                    <input id="phone_number" type="tel" class="form-control form-control-custom"
                        placeholder="10 dígitos numéricos" name="phone_number" required maxlength="12" minlength="10"
                        pattern="^[0-9]{10,12}$" value="{{ $patient->user->phone_number }}" />
                    <div class="invalid-feedback">
                        Ingresa un número de teléfono válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="is_active" class="custom-label">Activo en el sistema</label>
                    <select class="form-control form-select text-dark" id="is_active" name="is_active" required>
                        <option value="1" @selected($patient->user->is_active)>Si</option>
                        <option value="0" @selected(!$patient->user->is_active)>No</option>
                    </select>
                    <div class="invalid-feedback">
                        Selecciona si el paciente está activo en el sistema.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="curp" class="custom-label">CURP</label>
                    <input id="curp" type="text" class="form-control form-control-custom text-uppercase"
                        placeholder="Clave Única de Registro de Población" name="curp" required maxlength="18"
                        minlength="18" value="{{ $patient->user->curp }}" />
                    <div class="invalid-feedback">
                        Ingresa un CURP válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="home_address" class="custom-label">Domicilio</label>
                    <input id="home_address" type="text" class="form-control form-control-custom"
                        placeholder="Calle, número, colonia, alcaldía o municipio" name="home_address" required
                        minlength="5" maxlength="5000" value="{{ $patient->user->home_address }}" />
                    <div class="invalid-feedback">
                        Ingresa un domicilio válido.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="birth_date" class="custom-label">Fecha de cumpleaños</label>
                    <input id="birth_date" type="date" name="birth_date"
                        class="form-control form-control-custom text-dark" required
                        value="{{ $patient->birth_date->format('Y-m-d') }}" />
                    <div class="invalid-feedback">
                        Selecciona la fecha de nacimiento.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="gender" class="custom-label">Género</label>
                    <select class="form-control form-select text-dark" id="gender" name="gender" required>
                        <option value="masculino" @selected($patient->gender == 'masculino')>Masculino</option>
                        <option value="femenino" @selected($patient->gender == 'femenino')>Femenino</option>
                        <option value="no binario" @selected($patient->gender == 'no binario')>No binario</option>
                        <option value="prefiero no decir" @selected($patient->gender == 'prefiero no decir')>Prefiero no decir</option>
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

            @if (!$patient->emergency_contacts->isEmpty())
                @foreach ($patient->emergency_contacts as $contact)
                    <form
                        class="emergency-contact-block needs-validation d-flex justify-content-between gap-3 align-items-center existing"
                        novalidate autocomplete="off" id="emergencyContactForm_{{ $contact->id }}" action=""
                        method="post" enctype="application/x-www-form-urlencoded">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label for="nameEmergencyContact_{{ $contact->id }}"
                                    class="form-label custom-label">Nombre
                                    y
                                    apellidos</label>
                                <input type="text" class="form-control form-control-custom"
                                    id="nameEmergencyContact_{{ $contact->id }}"
                                    name="nameEmergencyContact_{{ $contact->id }}"
                                    placeholder="Ingresa el nombre completo" required minlength="5" maxlength="255"
                                    value="{{ $contact->name }}" />
                                <div class="invalid-feedback">
                                    Ingresa un nombre completo válido.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="relationshipEmergencyContact_{{ $contact->id }}"
                                    class="form-label">Parentesco</label>
                                <select class="form-select text-secondary"
                                    id="relationshipEmergencyContact_{{ $contact->id }}"
                                    name="relationshipEmergencyContact_{{ $contact->id }}" required>
                                    <option value="">Selecciona un parentesco...</option>
                                    <option value="padre" @selected($contact->relationship === 'padre')>Padre</option>
                                    <option value="madre" @selected($contact->relationship === 'madre')>Madre</option>
                                    <option value="hermano(a)" @selected($contact->relationship === 'hermano(a)')>Hermano/a</option>
                                    <option value="tio(a)" @selected($contact->relationship === 'tio(a)')>Tio/a</option>
                                    <option value="primo(a)" @selected($contact->relationship === 'primo(a)')>Primo/a</option>
                                    <option value="amigo(a)" @selected($contact->relationship === 'amigo(a)')>Amigo/a</option>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona un parentesco válido.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="emailEmergencyContact_{{ $contact->id }}" class="form-label">Correo
                                    Electrónico</label>
                                <input type="email" class="form-control form-control-custom"
                                    id="emailEmergencyContact_{{ $contact->id }}"
                                    name="emailEmergencyContact_{{ $contact->id }}" placeholder="example@domain.com"
                                    maxlength="255" value="{{ $contact->email ?? '' }}" />
                                <div class="invalid-feedback">
                                    Ingresa un correo electrónico válido.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="phone_numberEmergencyContact_{{ $contact->id }}"
                                    class="form-label">Teléfono</label>
                                <input type="tel" class="form-control form-control-custom"
                                    id="phone_numberEmergencyContact_{{ $contact->id }}"
                                    name="phone_numberEmergencyContact_{{ $contact->id }}"
                                    placeholder="10 a 12 dígitos numéricos" required minlength="10" maxlength="12"
                                    pattern="^[0-9]{10,12}$" value="{{ $contact->phone_number }}" />
                                <div class="invalid-feedback">
                                    Ingresa un número de teléfono válido.
                                </div>
                            </div>

                            <div class="col-12 mt-3 form-check text-start mb-4 ms-2">
                                <label class="form-check-label" for="is_primary_{{ $contact->id }}"
                                    style="color: #475569; font-size: 0.85rem;">
                                    Este contacto es el principal para emergencias
                                </label>
                                <input class="form-check-input" type="checkbox" value="is-primary"
                                    id="is_primary_{{ $contact->id }}" @checked($contact->is_primary) />
                                <div class="invalid-feedback">
                                    Selecciona si el contacto es el principal para emergencias.
                                </div>
                            </div>
                        </div>

                        <button onclick="removeEmergencyContact({{ $contact->id }})" type="button"
                            class="btn-remove-contact" title="Eliminar contacto">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
                    </form>
                @endforeach
            @endif
        </div>

        <!-- Botones de Acción -->
        <div class="form-actions border-top border-secondary-subtle pt-4 mt-0">
            <a href="{{ route('admin_detalle_usuario_paciente', ['patient' => $patient->id]) }}" target="_self"
                title="Cancelar" class="btn btn-cancel">Cancelar</a>
            <button
                onclick="patientCreateOrUpdateFormSubmit('{{ route('update_patient', ['patient' => $patient->id]) }}')"
                id="submit" type="button" class="btn btn-custom-red px-4 py-2 rounded-3 shadow-sm"
                value="Registrar Paciente">
                Guardar cambios
            </button>
        </div>

        @if (session('message'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('message') }}
            </div>
        @endif

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
