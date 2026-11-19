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
                    <img src="{{ asset('storage/' . $psychologist->user->avatar_url) }}"
                        alt="{{ $psychologist->user->name }}"
                        class="profile-avatar shadow-sm image-responsive mb-3 border border-5 border-secondary"
                        style="width: 120px; height: 120px;" />

                    <h4 class="fw-bold text-dark mb-1">{{ $psychologist->user->full_name }}</h4>
                    <p class="text-secondary mb-3" style="font-size: 0.9rem;">{{ $psychologist->user->name }}</p>

                    <div class="d-flex justify-content-center gap-2 mb-2">
                        <span class="badge-custom badge-psicologo">Psicólogo</span>
                        <span
                            class="badge-custom {{ $psychologist->user->is_active ? 'badge-activo' : 'badge-inactivo' }}">{{ $psychologist->user->is_active ? 'Activo' : 'Inactivo' }}</span>
                    </div>
                </div>

                <div class="stats-container">
                    <div class="stat-box">
                        <div class="stat-number">{{ $number_appointments }}</div>
                        <div class="stat-label">Citas Totales</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-box">
                        <div class="stat-number">{{ $number_sessions }}</div>
                        <div class="stat-label">Sesiones Totales</div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="mt-auto px-2 pb-2">
                    <a href="{{ route('admin_actualizar_psicologo', ['psychologist' => $psychologist->id]) }}"
                        title="Editar Perfil" target="_self" class="btn btn-outline-edit mb-3">
                        <i class="bi bi-pencil-square me-2"></i>Editar Perfil
                    </a>
                    <form id="destroy_{{ $psychologist->user->id }}" method="POST"
                        enctype="application/x-www-form-urlencoded"
                        action="{{ route('delete_account', ['user' => $psychologist->user->id]) }}"
                        class="needs-validation" novalidate autocomplete="off">
                        @csrf
                        @method('DELETE')

                        <button type="button" class='btn btn-outline-delete' title="Eliminar"
                            onclick="askBeforeDelete('{{ 'destroy_' . $psychologist->user->id }}')">
                            <i class="bi bi-trash me-2"></i>Eliminar Cuenta
                        </button>
                    </form>
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
        </div>

        <!-- Expediente -->
        <div class="col-xl-8 col-lg-7">
            <div class="custom-card p-4 p-md-5 h-100">
                <h5 class="fw-bold text-dark mb-4 pb-2">Expediente Personal & Profesional</h5>

                <div class="row detail-row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="detail-label">Correo electrónico</div>
                        <div class="detail-value">{{ $psychologist->user->email }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Teléfono de contacto</div>
                        <div class="detail-value">{{ $psychologist->user->phone_number }}</div>
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="detail-label">Fecha de registro</div>
                        <div class="detail-value">
                            {{ $psychologist->created_at->locale('es')->isoFormat('D [de] MMMM, YYYY') }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">CURP</div>
                        <div class="detail-value text-uppercase">{{ $psychologist->user->curp }}</div>
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="detail-label">Domicilio</div>
                        <div class="detail-value">{{ $psychologist->user->home_address }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Número de licencia (Cédula profesional)</div>
                        <div class="detail-value text-uppercase">{{ $psychologist->professional_license }}</div>
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="detail-label">Tarifa de consulta</div>
                        <div class="detail-value">{{ $psychologist->consultation_fee }} MXN</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-label">Años de experiencia</div>
                        <div class="detail-value">{{ $psychologist->years_experience }} AÑOS</div>
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-12">
                        <div class="detail-label">Especialidad Médica</div>
                        <div class="detail-value specialty text-uppercase">{{ $specialities }}</div>
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-12">
                        <div class="detail-label">Trayectoria profesional</div>
                        <div class="detail-value">{{ $psychologist->professional_bio ?? 'Sin descripción.' }}</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
