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

    @if ($errors->any())
        <div class="alert alert-danger mt-3" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                        <h3 class="fw-bold text-dark mb-1" style="font-size: 2rem;">{{ $totalUsers }}</h3>
                        <small class="text-secondary" style="font-size: 0.75rem;">+{{ $newMonthUsers }} usuarios nuevos
                            este
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
                        <h3 class="fw-bold text-dark mb-1" style="font-size: 2rem;">{{ $totalActiveUsers }}</h3>
                        <small class="text-secondary" style="font-size: 0.75rem;">{{ $percentageActiveUsers }}% de la base
                            total</small>
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
                        <h3 class="fw-bold text-dark mb-1" style="font-size: 2rem;">{{ $totalInactiveUsers }}</h3>
                        <small class="text-secondary" style="font-size: 0.75rem;">{{ $percentageInactiveUsers }}% de la base
                            total</small>
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
                    @if ($lastFiveUsersCreated->isEmpty())
                        <div class="alert alert-info" role="alert">
                            Este mes no se han creado usuarios nuevos.
                        </div>
                    @else
                        <table class="table custom-table table-borderless align-middle mb-0 table-light">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">Avatar & Nombre</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col" style="text-align: center !important;">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lastFiveUsersCreated as $user)
                                    <tr>
                                        <td class="px-0" style="width: 60px;">
                                            <img class="bg-secondary rounded-circle image-responsive profile-avatar"
                                                src="{{ asset('storage/' . $user->avatar_url) }}" alt="{{ $user->name }}"
                                                style="width: 40px !important; height: 40px; !important" />
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $user->full_name }}</div>
                                            <div class="text-secondary" style="font-size: 0.75rem;">{{ $user->email }}
                                            </div>
                                        </td>
                                        <td>{{ $user->role->rol_name }}</td>
                                        <td><span
                                                class="status-badge {{ $user->is_active ? 'badge-activo' : 'badge-inactivo' }}">{{ $user->is_active ? 'Activo' : 'Inactivo' }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        <!-- ultimas Citas -->
        <div class="col-lg-6">
            <div class="custom-card p-4 h-100">
                <h5 class="table-title">Últimas 5 Citas registradas</h5>
                <div class="table-responsive">
                    @if ($lastFiveAppointmentsRegistered->isEmpty())
                        <div class="alert alert-info" role="alert">
                            Este mes no se han registrado citas nuevas.
                        </div>
                    @else
                        <table class="table custom-table table-borderless align-middle mb-0 table-light"
                            style="background-color: #0c7bea !important;">
                            <thead>
                                <tr>
                                    <th scope="col">Paciente</th>
                                    <th scope="col">Psicólogo</th>
                                    <th scope="col">Fecha/Hora</th>
                                    <th scope="col" style="text-align: center !important;">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lastFiveAppointmentsRegistered as $appointment)
                                    <tr>
                                        <td class="fw-bold">{{ $appointment->patient->user->full_name }}</td>
                                        <td class="text-secondary">{{ $appointment->psychologist->user->full_name }}</td>
                                        <td>
                                            <div class="fw-bold" style="font-size: 0.8rem;">
                                                {{ $appointment->scheduled_at->locale('es')->isoFormat('D MMM, YYYY') }}
                                            </div>
                                            <div class="text-secondary" style="font-size: 0.75rem;">
                                                {{ $appointment->scheduled_at->locale('es')->isoFormat('HH:mm') }}</div>
                                        </td>
                                        <td><span
                                                class="status-badge {{ $statusColors[$appointment->status] }}">{{ $status[$appointment->status] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
