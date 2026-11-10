@extends('admin.admin_layout')
@section('content')
    <script>
        document.querySelector('a[title="Usuarios"]').classList.add('active');
    </script>

    <!-- Encabezado superior -->
    <div class="top-header">
        <h1 class="h3 mb-0 fw-bold text-dark">Detalle del Paciente</h1>
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
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="custom-card p-4 text-center">
                <img src="https://ui-avatars.com/api/?name=Carlos+Mendoza&background=random" alt="Avatar Psicólogo"
                    class="profile-avatar shadow-sm image-responsive mb-3 border border-5 border-secondary"
                    style="width: 120px; height: 120px;" />

                <h4 class="fw-bold text-dark mb-1">Sayuri Díaz Martínez</h4>
                <p class="text-secondary mb-3" style="font-size: 0.85rem;">Moonlleex</p>

                <div class="d-flex justify-content-center gap-2 mb-2">
                    <span class="badge-custom badge-paciente">Paciente</span>
                    <span class="badge-custom badge-inactivo">No activo</span>
                </div>

                <div class="stats-container">
                    <div class="stat-box">
                        <div class="stat-number" style="color: #000;">12</div>
                        <div class="stat-label" style="color: #000;">Citas Totales</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-box">
                        <div class="stat-number text-dark" style="color: #000;">24 Oct</div>
                        <div class="stat-label text-dark" style="color: #000;">Última Cita</div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="mt-auto px-2 pb-2">
                    <a href="{{ route('admin_actualizar_paciente', ['id' => 8]) }}" title="Editar Perfil" target="_self"
                        class="btn btn-outline-edit mb-3">
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

        <div class="col-xl-8 col-lg-7 d-flex flex-column gap-4">
            <!-- Datos Personales -->
            <div class="custom-card p-4">
                <h5 class="section-title">Datos Personales</h5>
                <div class="row gy-3">
                    <div class="col-sm-6">
                        <div class="field-label">Correo Electrónico</div>
                        <div class="field-value">sofia.m@gmail.com</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="field-label">Teléfono</div>
                        <div class="field-value">558837468</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="field-label">Fecha de Nacimiento</div>
                        <div class="field-value">14 de Abril de 1995</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="field-label">Género</div>
                        <div class="field-value">Femenino</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="field-label">Domicilio</div>
                        <div class="field-value">Calle 45 #12-89, CDMX</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="field-label">CURP</div>
                        <div class="field-value">CAHTG032524HMCRRRA6</div>
                    </div>
                </div>
            </div>

            <!-- Contactos de Emergencia -->
            <div class="custom-card p-4">
                <h5 class="section-title">Contactos de Emergencia</h5>
                <div class="table-responsive">
                    <table class="custom-table mb-0">
                        <thead>
                            <tr class="bg-light">
                                <th>Nombre</th>
                                <th>Parentesco</th>
                                <th>Número</th>
                                <th>Correo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-semibold">Juan Manuel Díaz</td>
                                <td>Padre</td>
                                <td>5588375896</td>
                                <td>juanmd@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Luisa Martínez</td>
                                <td>Madre</td>
                                <td>5569863214</td>
                                <td>Ninguno</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Últimas Citas Programadas -->
            <div class="custom-card p-4">
                <h5 class="section-title">Últimas 5 Citas Programadas</h5>
                <div class="table-responsive">
                    <table class="custom-table mb-0">
                        <thead>
                            <tr class="bg-light">
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Psicólogo</th>
                                <th class="text-end">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>24 Oct 2026</td>
                                <td>10:00 AM</td>
                                <td>Dr. Jose Luis Romo</td>
                                <td class="text-end">
                                    <span class="badge-custom  badge-completada">Completada</span>
                                </td>
                            </tr>
                            <tr>
                                <td>10 Nov 2026</td>
                                <td>11:30 AM</td>
                                <td>Dr. Jose Luis Romo</td>
                                <td class="text-end">
                                    <span class="badge-custom  badge-programada">Programada</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
