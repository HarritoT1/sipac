@extends('admin.admin_layout')
@section('content')
    <script>
        document.querySelector('a[title="Inicio"]').classList.add('active');
    </script>

    <!-- Encabezado superior -->
    <div class="top-header">
        <h1 class="h3 mb-0 fw-bold text-dark">Inicio</h1>
        <div class="profile-section">
            <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Avatar Administrador"
                class="profile-avatar shadow-sm image-responsive" />
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold" style="font-size: 0.9rem;">Administrador</span>
                <span class="text-secondary" style="font-size: 0.8rem;">Perfil</span>
            </div>
        </div>
    </div>

    <!-- Banner de bienvenida -->
    <div class="d-flex justify-content-between align-items-center welcome-banner shadow-sm">
        <h2 class="m-0 fw-bold fs-4">¡Bienvenido de nuevo, Administrador!</h2>
        <div class="bg-white rounded-circle d-flex justify-content-center align-items-center shadow-sm"
            style="width: 48px; height: 48px; color: var(--main-color);">
            <i class="bi bi-stars fs-4" style='transform: translate(-3px, -7px)'></i>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        <div class="col">
            <div class="card h-100 p-3 custom-card">
                <div class="card-body p-1 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary fw-semibold mb-1" style="font-size: 0.9rem;">Usuarios Totales</p>
                        <h3 class="fw-bold text-dark mb-1" style="font-size: 2rem;">1,248</h3>
                        <small class="text-secondary" style="font-size: 0.75rem;">+ 12 usuarios nuevos este
                            mes</small>
                    </div>

                    <i class="bi bi-people fs-2 bg-gradient rounded-circle d-flex justify-content-center align-items-center shadow-sm"
                        style="width: 48px; height: 48px; color: var(--main-color); background-color:  #a9a8a842;"></i>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 p-3 custom-card">
                <div class="card-body p-1 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary fw-semibold mb-1" style="font-size: 0.9rem;">Usuarios Activos</p>
                        <h3 class="fw-bold text-dark mb-1" style="font-size: 2rem;">982</h3>
                        <small class="text-secondary" style="font-size: 0.75rem;">92% de la base total</small>
                    </div>

                    <i class="bi bi-person-check text-success fs-2 bg-gradient rounded-circle d-flex justify-content-center align-items-center shadow-sm"
                        style="width: 48px; height: 48px; background-color:  #a9a8a842;"></i>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 p-3 custom-card">
                <div class="card-body p-1 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary fw-semibold mb-1" style="font-size: 0.9rem;">Usuarios Inactivos</p>
                        <h3 class="fw-bold text-dark mb-1" style="font-size: 2rem;">266</h3>
                        <small class="text-secondary" style="font-size: 0.75rem;">18% de la base total</small>
                    </div>

                    <i class="bi bi-person-dash fs-2 text-warning bg-gradient rounded-circle d-flex justify-content-center align-items-center shadow-sm"
                        style="width: 48px; height: 48px; background-color:  #a9a8a842;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- ultimos usuarios -->
        <div class="col-lg-6">
            <div class="custom-card p-4 h-100">
                <h5 class="table-title">Últimos 5 Usuarios creados</h5>
                <div class="table-responsive">
                    <table class="table custom-table table-borderless align-middle mb-0 table-light">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2">Avatar & Nombre</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 40px;">
                                    <img class="bg-secondary rounded-circle image-responsive" src="" alt="username"
                                        style="width: 36px; height: 36px;" />
                                </td>
                                <td>
                                    <div class="fw-bold">Dr. Carlos Mendoza</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">carlos@psicogestion.com
                                    </div>
                                </td>
                                <td>Psicólogo</td>
                                <td><span class="status-badge badge-activo">Activo</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="bg-secondary rounded-circle image-responsive" src="" alt="username"
                                        style="width: 36px; height: 36px;" />
                                </td>
                                <td>
                                    <div class="fw-bold">Sofia Martínez</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">sofia.m@gmail.com</div>
                                </td>
                                <td>Paciente</td>
                                <td><span class="status-badge badge-activo">Activo</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="bg-secondary rounded-circle image-responsive" src="" alt="username"
                                        style="width: 36px; height: 36px;" />
                                </td>
                                <td>
                                    <div class="fw-bold">Dra. Lucía Torres</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">lucia@psicogestion.com
                                    </div>
                                </td>
                                <td>Psicólogo</td>
                                <td><span class="status-badge badge-inactivo">Inactivo</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="bg-secondary rounded-circle image-responsive" src="" alt="username"
                                        style="width: 36px; height: 36px;" />
                                </td>
                                <td>
                                    <div class="fw-bold">Mateo Díaz</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">mateo.diaz@gmail.com</div>
                                </td>
                                <td>Paciente</td>
                                <td><span class="status-badge badge-activo">Activo</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="bg-secondary rounded-circle image-responsive" src="" alt="username"
                                        style="width: 36px; height: 36px;" />
                                </td>
                                <td>
                                    <div class="fw-bold">Fernanda Gómez</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">fer.gomez@gmail.com</div>
                                </td>
                                <td>Paciente</td>
                                <td><span class="status-badge badge-inactivo">Inactivo</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ultimas Citas -->
        <div class="col-lg-6">
            <div class="custom-card p-4 h-100">
                <h5 class="table-title">Últimas 5 Citas registradas</h5>
                <div class="table-responsive">
                    <table class="table custom-table table-borderless align-middle mb-0 table-light"
                        style="background-color: #0c7bea !important;">
                        <thead>
                            <tr>
                                <th scope="col">Paciente</th>
                                <th scope="col">Psicólogo</th>
                                <th scope="col">Fecha/Hora</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">Sofia Martínez</td>
                                <td class="text-secondary">Dr. Carlos Mendoza</td>
                                <td>
                                    <div class="fw-bold" style="font-size: 0.8rem;">24 Oct</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">10:00 AM</div>
                                </td>
                                <td><span class="status-badge badge-activo">Completada</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Mateo Díaz</td>
                                <td class="text-secondary">Dr. Carlos Mendoza</td>
                                <td>
                                    <div class="fw-bold" style="font-size: 0.8rem;">24 Oct</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">11:30 AM</div>
                                </td>
                                <td><span class="status-badge badge-activo">Completada</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Andrés Castro</td>
                                <td class="text-secondary">Dra. Lucía Torres</td>
                                <td>
                                    <div class="fw-bold" style="font-size: 0.8rem;">25 Oct</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">09:00 AM</div>
                                </td>
                                <td><span class="status-badge badge-programada">Programada</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Valeria Ruiz</td>
                                <td class="text-secondary">Dra. Lucía Torres</td>
                                <td>
                                    <div class="fw-bold" style="font-size: 0.8rem;">25 Oct</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">03:00 PM</div>
                                </td>
                                <td><span class="status-badge badge-inactivo">Cancelada</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Clara Soto</td>
                                <td class="text-secondary">Dr. Carlos Mendoza</td>
                                <td>
                                    <div class="fw-bold" style="font-size: 0.8rem;">26 Oct</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">04:30 PM</div>
                                </td>
                                <td><span class="status-badge badge-inasistencia">Inasistencia</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
