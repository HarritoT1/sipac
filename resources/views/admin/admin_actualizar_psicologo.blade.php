@extends('admin.admin_layout')
@section('content')
    <script>
        document.querySelector('a[title="Usuarios"]').classList.add('active');
    </script>

    <div class="top-header">
        <h1 class="h3 mb-0 fw-bold text-dark">Actualizar Psicólogo</h1>
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
            <h2 class="h5 fw-bold text-dark mb-1">Información del Profesional</h2>
            <p class="text-secondary small mb-0">Actualiza los campos de interés del psicólogo en
                SIPAC.</p>
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

                <div class="col-6">
                    <label class="custom-label">Especialidad</label>
                    <select class="form-control form-select text-secondary" id="specialty"
                        data-placeholder="Selecciona minimo una opción" name="specialty[]" required multiple>
                        <option value="ansiedad" @selected('ansiedad' == 'ansiedad')>ansiedad</option>
                        <option value="depresión" @selected('depresión' == 'depresión')>depresión</option>
                        <option value="terapia de pareja" @selected('terapia de pareja' == 'terapia de pareja')>terapia de pareja</option>
                        <option value="adolescentes" @selected('adolescentes' == 'adolescentes')>adolescentes</option>
                        <option value="terapia familiar" @selected('terapia familiar' == 'terapia familiar')>terapia familiar</option>
                        <option value="duelo" @selected('duelo' == 'duelo')>duelo</option>
                        <option value="adicciones" @selected('adicciones' == 'adicciones')>adicciones</option>
                    </select>

                    <div class="invalid-feedback">
                        Selecciona al menos una especialidad.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="is_active" class="custom-label">Activo en el sistema</label>
                    <select class="form-control form-select text-secondary" id="is_active" name="is_active" required>
                        <option value="true" @selected(true)>Si</option>
                        <option value="false" @selected(false)>No</option>
                    </select>
                    <div class="invalid-feedback">
                        Selecciona si el psicólogo está activo en el sistema.
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
                    <label for="professional_license" class="custom-label">Número de Licencia (cédula profesional)</label>
                    <input id="professional_license" type="text" class="form-control form-control-custom"
                        placeholder="Ej. L-9923415-COL" name="professional_license" required maxlength="15"
                        value="" />
                    <div class="invalid-feedback">
                        Ingresa un número de licencia válido.
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
                    <label for="years_experience" class="custom-label">Años de experiencia</label>
                    <input id="years_experience" type="number" class="form-control form-control-custom" placeholder="0"
                        step="1" name="years_experience" value="" min="0" max="50" required />
                    <div class="invalid-feedback">
                        Ingresa un número válido de años de experiencia.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="consultation_fee" class="custom-label">Tarifa de consulta (MXN)</label>
                    <input id="consultation_fee" type="number" step="0.01" class="form-control form-control-custom"
                        placeholder="250.00" name="consultation_fee" value="" min="0" max="9999.99" />
                    <div class="invalid-feedback">
                        Ingresa una tarifa válida.
                    </div>
                </div>

                <div class="col-12">
                    <label for="professional_bio" class="custom-label">Agrega una descripción de tu trayectoria
                        profesional</label>
                    <textarea id="professional_bio" class="form-control form-control-custom" rows="3"
                        placeholder="Resumen curricular o enfoque terapéutico..." name="professional_bio">
                    </textarea>
                    <div class="invalid-feedback">
                        Ingresa una descripción válida.
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="form-actions border-top border-secondary-subtle pt-4 mt-5">
                <a href="{{ route('admin_detalle_usuario_psicologo', ['id' => 8]) }}" target="_self" title="Cancelar"
                    class="btn btn-cancel">Cancelar</a>
                <button id="submit" type="submit" class="btn btn-custom-red px-4 py-2 rounded-3 shadow-sm">Guardar
                    cambios</button>
            </div>
        </form>

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

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function() {
                $('#specialty').select2({
                    theme: 'bootstrap-5',
                    width: '100%',
                    placeholder: 'Selecciona minimo una opción',
                    allowClear: true
                });
            });
        });
    </script>
@endsection
