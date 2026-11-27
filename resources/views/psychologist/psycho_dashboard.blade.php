@extends('psychologist.psycho_layout')
@section('content')
    <script>
        document.querySelector('a[title="Inicio"]').classList.add('active');
    </script>

    <!-- Encabezado superior -->
    <div class="top-header">
        <h1 class="h3 mb-0 fw-bold text-dark">Inicio</h1>
        <a class="profile-section text-dark logout-link" href="{{ route('pendiente') }}" title="{{ $userAuth->name }}"
            target="_self">
            <img src="{{ asset('storage/' . $userAuth->avatar_url) }}" alt="{{ $userAuth->name }}"
                class="profile-avatar shadow-sm image-responsive" />
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold" style="font-size: 0.9rem;">{{ $userAuth->name }}</span>
                <span class="text-secondary" style="font-size: 0.8rem;">Psicólog@</span>
            </div>
        </a>
    </div>

    <div class="welcome-banner d-flex justify-content-between align-items-center shadow-sm">
        <h2 class="m-0 fw-bold fs-4">¡Bienvenid@ de nuevo, Dr. {{ $userAuth->full_name }}!</h2>
        <div class="bg-white rounded-circle d-flex justify-content-center align-items-center shadow-sm"
            style="width: 48px; height: 48px; color: var(--main-color); flex-shrink: 0;">
            <i class="bi bi-stars fs-4" style='transform: translate(-3px, -7px)'></i>
        </div>
    </div>

    <h5 class="fw-bold mb-4" style="font-size: 1.5rem;">Flujo de Citas del Día</h5>

    <div class="row g-3 mb-4">

        @if (!$beforeAppointment && !$actualAppointment && !$nextAppointment)
            <div class="alert alert-primary text-center mb-0 p-4" role="alert">
                <i class="bi bi-info-circle-fill"></i>
                Estimado Dr. {{ $userAuth->full_name }}, no tienes citas programadas, por favor agrega citas.
            </div>
        @else
            <div class="col-12 col-md-4">
                @if ($beforeAppointment)
                    <div class="flow-card h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="flow-header-tag">CITA ANTERIOR</span>
                                <span
                                    class="status-badge {{ $beforeAppointment->modality === 'in_person' ? 'type-badge-presencial' : 'type-badge-virtual' }}"
                                    style="width:40%;">{{ $modality[$beforeAppointment->modality] }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">{{ $beforeAppointment->patient->user->full_name }}
                                    </h6>
                                    <p class="text-secondary my-2" style="font-size: 1rem;">Fecha:
                                        {{ $beforeAppointment?->scheduled_at->locale('es')->format('d/m/Y H:i') }}
                                    </p>
                                </div>

                                <img src="{{ asset('storage/' . $beforeAppointment->patient->user->avatar_url) }}"
                                    alt="{{ $beforeAppointment->patient->user->name }}"
                                    class="profile-avatar shadow-sm image-responsive mx-0" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <span class="status-badge {{ $statusColors[$beforeAppointment->status] }}"
                                style="width:40%;">{{ $status[$beforeAppointment->status] }}</span>
                            <a href="#" class="link-detail">Ver Detalles</a>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info d-flex justify-content-center align-items-center gap-2 mb-0 p-4 h-100"
                        role="alert">
                        <i class="bi bi-info-circle-fill" style="transform: translate(-2px, -5px)"></i> No existen citas
                        previas.
                    </div>
                @endif
            </div>

            <div class="col-12 col-md-4">
                @if ($actualAppointment)
                    <div class="flow-card active-cita h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="flow-header-tag">CITA ACTUAL</span>
                                <span
                                    class="status-badge {{ $actualAppointment->modality === 'in_person' ? 'type-badge-presencial' : 'type-badge-virtual' }}"
                                    style="width:40%;">{{ $modality[$actualAppointment->modality] }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">{{ $actualAppointment->patient->user->full_name }}
                                    </h6>
                                    <p class="text-secondary my-2" style="font-size: 1rem;">Fecha:
                                        {{ $actualAppointment?->scheduled_at->locale('es')->format('d/m/Y H:i') }}</p>
                                </div>

                                <img src="{{ asset('storage/' . $actualAppointment->patient->user->avatar_url) }}"
                                    alt="{{ $actualAppointment->patient->user->name }}"
                                    class="profile-avatar shadow-sm image-responsive mx-0" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <span class="status-badge {{ $statusColors[$actualAppointment->status] }}"
                                style="width:40%;">{{ $status[$actualAppointment->status] }}</span>
                            <a href="#" class="link-detail">Ver Detalles</a>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info d-flex justify-content-center align-items-center gap-2 mb-0 p-4 h-100"
                        role="alert">
                        <i class="bi bi-info-circle-fill" style="transform: translate(-2px, -5px)"></i> No tienes citas
                        programadas.
                    </div>
                @endif
            </div>

            <div class="col-12 col-md-4">
                @if ($nextAppointment)
                    <div class="flow-card h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="flow-header-tag">PRÓXIMA CITA</span>
                                <span
                                    class="status-badge {{ $nextAppointment->modality === 'in_person' ? 'type-badge-presencial' : 'type-badge-virtual' }}"
                                    style="width:40%;">{{ $modality[$nextAppointment->modality] }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">{{ $nextAppointment->patient->user->full_name }}
                                    </h6>
                                    <p class="text-secondary my-2" style="font-size: 1rem;">Fecha:
                                        {{ $nextAppointment?->scheduled_at->locale('es')->format('d/m/Y H:i') }}</p>
                                </div>

                                <img src="{{ asset('storage/' . $nextAppointment->patient->user->avatar_url) }}"
                                    alt="{{ $nextAppointment->patient->user->name }}"
                                    class="profile-avatar shadow-sm image-responsive mx-0" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <span class="status-badge {{ $statusColors[$nextAppointment->status] }}"
                                style="width:40%;">{{ $status[$nextAppointment->status] }}</span>
                            <a href="#" class="link-detail">Ver Detalles</a>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info d-flex justify-content-center align-items-center mb-0 gap-2 p-4 h-100"
                        role="alert">
                        <i class="bi bi-info-circle-fill" style="transform: translate(-2px, -5px)"></i> No tienes citas
                        programadas posteriores a la actual.
                    </div>
                @endif
            </div>
        @endif

    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div>
                    <p class="text-secondary mb-1" style="font-size: 0.85rem;">Citas canceladas</p>
                    <h3 class="fw-bold mb-0" style="font-size: 2.1rem;">{{ $cancelledAppointments }}</h3>
                </div>
                <div class="stat-icon-wrapper icon-canceladas">
                    <i class="bi bi-calendar" style="transform: translate(-3px, -7px)"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div>
                    <p class="text-secondary mb-1" style="font-size: 0.85rem;">Citas completadas</p>
                    <h3 class="fw-bold mb-0" style="font-size: 2.1rem;">{{ $completedAppointments }}</h3>
                </div>
                <div class="stat-icon-wrapper icon-completadas">
                    <i class="bi bi-calendar-check" style="transform: translate(-3px, -7px)"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div>
                    <p class="text-secondary mb-1" style="font-size: 0.85rem;">Citas pendientes</p>
                    <h3 class="fw-bold mb-0" style="font-size: 2.1rem;">{{ $pendingAppointments }}</h3>
                </div>
                <div class="stat-icon-wrapper icon-pendientes">
                    <i class="bi bi-calendar-week" style="transform: translate(-3px, -7px)"></i>
                </div>
            </div>
        </div>
    </div>


    @if ($lastSession)
        <div class="custom-card p-4 mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0" style="font-size: 1rem;">Detalles de la Última Sesión Registrada</h5>
                <a href="{{ route('pendiente') }}" target="_self" class="link-detail">Ver detalle de la sesión</a>
            </div>

            <div class="d-flex align-items-center flex-wrap gap-4">
                <img src="{{ asset('storage/' . $lastSession->appointment->patient->user->avatar_url) }}"
                    alt="{{ $lastSession->appointment->patient->user->name }}"
                    class="profile-avatar shadow-sm image-responsive mx-0" />

                <div class="flex-fill" style="min-width: 160px;">
                    <small class="text-secondary d-block" style="font-size: 0.75rem;">Paciente</small>
                    <span class="fw-bold text-dark"
                        style="font-size: 0.95rem;">{{ $lastSession->appointment->patient->user->full_name }}</span>
                </div>

                <div class="flex-fill" style="min-width: 160px;">
                    <small class="text-secondary d-block" style="font-size: 0.75rem;">Fecha y Hora</small>
                    <span class="text-dark"
                        style="font-size: 0.9rem;">{{ $lastSession->appointment->scheduled_at->locale('es')->format('d/m/Y H:i') }}</span>
                </div>

                <div class="flex-fill" style="min-width: 250px;">
                    <small class="text-secondary d-block" style="font-size: 0.75rem;">Diagnóstico</small>
                    <span class="text-dark text-truncate d-block" style="font-size: 0.9rem;">
                        {{ mb_strimwidth($lastSession->diagnosis, 0, 45, '...', 'UTF-8') }}
                    </span>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-primary text-center mb-0 p-4" role="alert">
            <i class="bi bi-info-circle-fill"></i>
            Estimado Dr. {{ $userAuth->full_name }}, usted no cuenta con registros de sesiones, por favor agrega sesiones.
        </div>
    @endif
@endsection
