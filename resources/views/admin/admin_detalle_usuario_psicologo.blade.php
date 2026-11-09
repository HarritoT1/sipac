@extends('admin.admin_layout')
@section('content')
    <script>
        document.querySelector('a[title="Usuarios"]').classList.add('active');
    </script>

    <!-- Encabezado superior -->
    <div class="top-header">
        <h1 class="h3 mb-0 fw-bold text-dark">Detalle del psicólogo</h1>
        <div class="profile-section">
            <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Avatar Administrador"
                class="profile-avatar shadow-sm image-responsive" />
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold" style="font-size: 0.9rem;">Administrador</span>
                <span class="text-secondary" style="font-size: 0.8rem;">Perfil</span>
            </div>
        </div>
    </div>

    <div class="row gx-4 mb-5 align-items-start">
        <div class="col-xl-4 col-lg-5 mb-4 mb-lg-0">
            <div class="custom-card p-4 text-center h-100 d-flex flex-column">
                <div class="mt-2">
                    <img src="https://ui-avatars.com/api/?name=Carlos+Mendoza&background=random" alt="Avatar Psicólogo"
                        class="profile-avatar shadow-sm image-responsive mb-3 border border-5 border-secondary"
                        style="width: 120px; height: 120px;" />

                    <h4 class="fw-bold text-dark mb-1">Dr. Carlos Mendoza</h4>
                    <p class="text-secondary mb-3" style="font-size: 0.9rem;">CarlosMz</p>

                    <div class="d-flex justify-content-center gap-2 mb-2">
                        <span class="badge-custom badge-psicologo">Psicólogo</span>
                        <span class="badge-custom badge-status-active">Activo</span>
                    </div>
                </div>

                <div class="stats-container">
                    <div class="stat-box">
                        <div class="stat-number">42</div>
                        <div class="stat-label">Citas Totales</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-box">
                        <div class="stat-number">39</div>
                        <div class="stat-label">Sesiones Totales</div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="mt-auto px-2 pb-2">
                    <a href="#" title="Editar Perfil" target="_self" class="btn btn-outline-edit mb-3">
                        <i class="bi bi-pencil-square me-2"></i>Editar Perfil
                    </a>
                    <form id="destroy" method="POST" enctype="application/x-www-form-urlencoded" action=""
                        class="needs-validation" novalidate autocomplete="off">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class='btn btn-outline-delete'>
                            <i class="bi bi-trash me-2"></i>Eliminar Cuenta
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Expediente -->
        <div class="col-xl-8 col-lg-7">
            <div class="custom-card p-4 p-md-5 h-100">
                <h5 class="fw-bold text-dark mb-4 pb-2">Expediente Personal & Profesional</h5>

                <div class="row detail-row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="detail-label">Correo electrónico</div>
                        <div class="detail-value">carlos.mendoza@psicogestion.com</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Teléfono de contacto</div>
                        <div class="detail-value">5588374683</div>
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="detail-label">Fecha de registro</div>
                        <div class="detail-value">12 de Marzo, 2022</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">CURP</div>
                        <div class="detail-value">CATH254856HMMJJA4</div>
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="detail-label">Domicilio</div>
                        <div class="detail-value">CALLE BUGAMBILIAS, CDMX, C.P. 56888</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Número de licencia (Cédula profesional)</div>
                        <div class="detail-value">L-36FHGSSWE-5</div>
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="detail-label">Tarifa de consulta</div>
                        <div class="detail-value">80.50 MXN</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Años de experiencia</div>
                        <div class="detail-value">2 AÑOS</div>
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-12">
                        <div class="detail-label">Especialidad Médica</div>
                        <div class="detail-value specialty">Ansiedad / Depresión / Terapia de pareja / Adolescentes / Duelo
                            / Adicciones</div>
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-12">
                        <div class="detail-label">Trayectoria profesional</div>
                        <div class="detail-value">Llevo 10 años de experiencia en el área clínica comunitaria atendiendo
                            familias y jóvenes...</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
