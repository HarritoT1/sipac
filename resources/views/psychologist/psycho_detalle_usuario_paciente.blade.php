@extends('psychologist.psycho_layout')
@section('content')
    <script>
        document.querySelector('a[title="Pacientes"]').classList.add('active');
    </script>

    <!-- Encabezado superior -->
    <div class="top-header">
        <h1 class="h3 mb-0 fw-bold text-dark">Detalle del paciente</h1>
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

    <div class="row gx-4 mb-5 align-items-start">
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="custom-card p-4 text-center">
                <img src="{{ asset('storage/' . $patient->user->avatar_url) }}" alt="Avatar Psicólogo"
                    class="profile-avatar shadow-sm image-responsive mb-3 border border-5 border-secondary"
                    style="width: 120px; height: 120px;" />

                <h4 class="fw-bold text-dark mb-1">{{ $patient->user->full_name }}</h4>
                <p class="text-secondary mb-3" style="font-size: 0.85rem;">{{ $patient->user->name }}</p>

                <div class="d-flex justify-content-center gap-2 mb-2">
                    <span class="badge-custom badge-paciente">Paciente</span>
                    <span
                        class="badge-custom {{ $patient->user->is_active ? 'badge-activo' : 'badge-inactivo' }}">{{ $patient->user->is_active ? 'Activo' : 'Inactivo' }}</span>
                </div>

                <div class="stats-container">
                    <div class="stat-box">
                        <div class="stat-number" style="color: #000;">{{ $number_appointments }}</div>
                        <div class="stat-label" style="color: #000;">Citas Totales</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-box">
                        <div class="stat-number text-dark" style="color: #000;">{{ $lastAppointmentDate }}</div>
                        <div class="stat-label text-dark" style="color: #000;">Última Cita</div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="mt-auto px-2 pb-2">
                    <a href="{{ route('admin_actualizar_paciente', ['patient' => $patient->id]) }}" title="Editar Perfil"
                        target="_self" class="btn btn-outline-edit mb-3">
                        <i class="bi bi-pencil-square me-2"></i>Editar Perfil
                    </a>
                    <form id="destroy_{{ $patient->user->id }}" method="POST" enctype="application/x-www-form-urlencoded"
                        action="{{ route('delete_account', ['user' => $patient->user->id]) }}" class="needs-validation"
                        novalidate autocomplete="off">
                        @csrf
                        @method('DELETE')

                        <button type="button" onclick="askBeforeDelete('destroy_{{ $patient->user->id }}')"
                            class='btn btn-outline-delete'>
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

        <div class="col-xl-8 col-lg-7 d-flex flex-column gap-4">
            <!-- Datos Personales -->
            <div class="custom-card p-4">
                <h5 class="section-title">Datos Personales</h5>
                <div class="row gy-3">
                    <div class="col-sm-6">
                        <div class="field-label">Correo Electrónico</div>
                        <div class="field-value">{{ $patient->user->email }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="field-label">Teléfono</div>
                        <div class="field-value">{{ $patient->user->phone_number }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="field-label">Fecha de Nacimiento</div>
                        <div class="field-value">
                            {{ $patient->birth_date->locale('es')->isoFormat('D [de] MMMM [del] YYYY') }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="field-label">Género</div>
                        <div class="field-value text-capitalize">{{ $patient->gender }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="field-label">Domicilio</div>
                        <div class="field-value">{{ $patient->user->home_address }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="field-label">CURP</div>
                        <div class="field-value text-uppercase">{{ $patient->user->curp }}</div>
                    </div>
                </div>
            </div>

            <!-- Contactos de Emergencia -->
            <div class="custom-card p-4">
                <h5 class="section-title">Contactos de Emergencia</h5>
                @if ($patient->emergency_contacts->isEmpty())
                    <div class="alert alert-info" role="alert">
                        Este paciente no tiene contactos de emergencia.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table custom-table mb-0" style="--bs-table-bg: transparent;">
                            <thead>
                                <tr class="bg-light">
                                    <th>Nombre</th>
                                    <th>Parentesco</th>
                                    <th>Número</th>
                                    <th>Correo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patient->emergency_contacts as $contact)
                                    <tr @if ($contact->is_primary) class="table-info" @endif>
                                        <td class="fw-semibold">{{ $contact->name }}</td>
                                        <td>{{ $contact->relationship }}</td>
                                        <td>{{ $contact->phone_number }}</td>
                                        <td>{{ $contact->email ?? 'Sin Correo Electrónico' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Últimas Citas Programadas -->
            <div class="custom-card p-4">
                <h5 class="section-title">Últimas 5 Citas Programadas</h5>
                @if ($lastFiveAppointments->isEmpty())
                    <div class="alert alert-info" role="alert">
                        Este paciente no tiene citas programadas.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="custom-table mb-0">
                            <thead>
                                <tr class="bg-light">
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Psicólogo</th>
                                    <th class="text-center">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lastFiveAppointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->scheduled_at->locale('es')->isoFormat('D MMM YYYY') }}</td>
                                        <td>{{ $appointment->scheduled_at->locale('es')->isoFormat('HH:mm') }}</td>
                                        <td>{{ $appointment->psychologist->user->full_name }}</td>
                                        <td>
                                            <span
                                                class="badge-custom {{ $statusColors[$appointment->status] }}">{{ $status[$appointment->status] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <a class="btn btn-custom-red px-4 py-2 rounded-3 shadow-sm ms-auto" style="display: inline !important;"
                target="_blank" href="{{ route('reporte_paciente', $patient->id) }}" title="Reporte del paciente">
                Generar reporte del paciente (.pdf)
            </a>
        </div>
    </div>
@endsection
