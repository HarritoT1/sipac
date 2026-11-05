@extends('admin.admin_layout')
@section('content')
    <script>
        document.querySelector('a[title="Registrar Psicólogo"]').classList.add('active');
    </script>

    <div class="top-header">
        <h1 class="h3 mb-0 fw-bold text-dark">Registrar Psicólogo</h1>
        <div class="profile-section">
            <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Avatar Administrador"
                class="profile-avatar shadow-sm image-responsive" />
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold" style="font-size: 0.9rem;">Administrador</span>
                <span class="text-secondary" style="font-size: 0.8rem;">Perfil</span>
            </div>
        </div>
    </div>

    <div class="top-header">
        <h1 class="h3 mb-0 fw-bold text-dark">Registrar Paciente</h1>
        <div class="profile-section">
            <div class="profile-badge-avatar">AD</div>
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold text-dark" style="font-size: 0.95rem;">Administrador</span>
                <span class="text-muted" style="font-size: 0.8rem;">Perfil</span>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-xl-10">
            <div class="custom-card p-4 p-md-5">

                <div class="mb-4">
                    <h4 class="fw-bold text-dark mb-1">Información del Paciente</h4>
                    <p class="text-muted small">Completa los campos obligatorios para dar de alta al paciente en SIPAC.</p>
                </div>

                <!-- Cargar Avatar -->
                <div class="d-flex align-items-center gap-3 mb-4 pb-2">
                    <div class="avatar-upload-box">
                        <i class="bi bi-person"></i>
                    </div>
                    <div>
                        <button type="button" class="btn btn-outline-custom btn-sm">Subir Avatar</button>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">Formatos aceptados: PNG, JPG. Máximo
                            2MB.</div>
                    </div>
                </div>

                <!-- Formulario de Registro -->
                <form class="needs-validation" novalidate>
                    <div class="row g-3">

                        <!-- Nombre y apellidos -->
                        <div class="col-md-6">
                            <label for="fullName" class="form-label">Nombre y apellidos</label>
                            <input type="text" class="form-control" id="fullName"
                                placeholder="Karina Sayuri Díaz Martínez" required />
                            <div class="invalid-feedback">Ingresa el nombre y apellidos.</div>
                        </div>

                        <!-- Nombre de usuario -->
                        <div class="col-md-6">
                            <label for="username" class="form-label">Nombre de usuario (recuerda guardarlo)</label>
                            <input type="text" class="form-control" id="username" placeholder="Moonieex" required />
                            <div class="invalid-feedback">El nombre de usuario es obligatorio.</div>
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email"
                                placeholder="af.giraldo@psicogestion.com" required />
                            <div class="invalid-feedback">Ingresa un correo electrónico válido.</div>
                        </div>

                        <!-- Teléfono -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="phone" placeholder="5588374683" required />
                            <div class="invalid-feedback">Ingresa un número telefónico.</div>
                        </div>

                        <!-- Contraseña -->
                        <div class="col-md-6">
                            <label for="password" class="form-label">Contraseña (recuerda guardarla)</label>
                            <input type="password" class="form-control" id="password" placeholder="••••••••••••"
                                required />
                            <div class="invalid-feedback">Ingresa una contraseña.</div>
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="col-md-6">
                            <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="••••••••••••"
                                required />
                            <div class="invalid-feedback">Confirma la contraseña.</div>
                        </div>

                        <!-- CURP -->
                        <div class="col-md-6">
                            <label for="curp" class="form-label">CURP</label>
                            <input type="text" class="form-control" id="curp" placeholder="CATHO31574HMREEFFA"
                                required />
                            <div class="invalid-feedback">Ingresa una CURP válida.</div>
                        </div>

                        <!-- Domicilio -->
                        <div class="col-md-6">
                            <label for="address" class="form-label">Domicilio</label>
                            <input type="text" class="form-control" id="address"
                                placeholder="Calle Margaritas, CDMX, C.P. 54777" required />
                            <div class="invalid-feedback">Ingresa el domicilio.</div>
                        </div>

                        <!-- Fecha de cumpleaños -->
                        <div class="col-md-6">
                            <label for="birthDate" class="form-label">Fecha de cumpleaños</label>
                            <input type="date" class="form-control" id="birthDate" required />
                            <div class="invalid-feedback">Selecciona la fecha de nacimiento.</div>
                        </div>

                        <!-- Género -->
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Género</label>
                            <select class="form-select" id="gender" required>
                                <option value="" disabled>Selecciona un género...</option>
                                <option value="Masculino" selected>Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                            <div class="invalid-feedback">Selecciona el género.</div>
                        </div>

                    </div>

                    <!-- Contactos de Emergencia -->
                    <div class="border-top mt-4 pt-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h5 class="emergency-section-title mb-0">Agregue los contactos de emergencia del paciente</h5>
                            <button type="button" class="btn-add-contact" title="Agregar otro contacto">
                                <i class="bi bi-plus-circle-fill"></i>
                            </button>
                        </div>
                        <p class="text-muted small mb-3">Se recomienda por lo menos agregar uno.</p>

                        <div class="row g-3 align-items-center">

                            <div class="col-md-6">
                                <label for="emergencyName" class="form-label">Nombre y apellidos</label>
                                <input type="text" class="form-control" id="emergencyName"
                                    placeholder="Juan Manuel Díaz Cruz" />
                            </div>

                            <div class="col-md-6">
                                <label for="relationship" class="form-label">Parentesco</label>
                                <select class="form-select" id="relationship">
                                    <option value="Padre" selected>Padre</option>
                                    <option value="Madre">Madre</option>
                                    <option value="Tutor">Tutor / Tutora</option>
                                    <option value="Cónyuge">Cónyuge / Pareja</option>
                                    <option value="Hermano(a)">Hermano(a)</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="emergencyEmail" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="emergencyEmail"
                                    placeholder="af.giraldo@psicogestion.com" />
                            </div>

                            <div class="col-md-6">
                                <label for="emergencyPhone" class="form-label">Teléfono</label>
                                <div class="d-flex align-items-center gap-2">
                                    <input type="tel" class="form-control" id="emergencyPhone"
                                        placeholder="5588374683" />
                                    <button type="button" class="btn-remove-contact" title="Eliminar contacto">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="form-check form-switch d-flex align-items-center gap-2 ps-0">
                                    <label class="form-check-label fw-bold text-dark small me-2" for="isPrimaryContact">
                                        Es el contacto principal del paciente:
                                    </label>
                                    <input class="form-check-input ms-0 mt-0" type="checkbox" role="switch"
                                        id="isPrimaryContact" checked />
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Botón Registrar -->
                    <div class="d-flex justify-content-end mt-4 pt-2">
                        <button class="btn btn-custom-primary" type="submit">Registrar Paciente</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
//PENDING
