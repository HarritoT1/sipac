@extends('admin.admin_layout')
@section('content')
    <script>
        document.querySelector('a[title="Usuarios"]').classList.add('active');
    </script>

    <div class="top-header">
        <h1 class="h3 mb-0 fw-bold text-dark">Usuarios</h1>
        <div class="profile-section">
            <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Avatar Administrador"
                class="profile-avatar shadow-sm image-responsive" />
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold" style="font-size: 0.9rem;">Administrador</span>
                <span class="text-secondary" style="font-size: 0.8rem;">Perfil</span>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h2 class="h5 fw-bold mb-1 text-dark">Listado de Usuarios Registrados</h2>
            <p class="text-secondary mb-0 small">Administra cuentas de psicólogos y pacientes.</p>
        </div>
        <div class="dropdown" data-bs-theme="light">
            <button class="btn btn-custom-red px-4 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2 dropdown-toggle"
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-plus-lg text-white"></i> Registrar Usuario
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" target="_self" href="{{ route('admin_registrar_psicologo') }}"
                        title="Registrar Psicólogo">Psicólogo</a></li>
                <li><a class="dropdown-item" target="_self" href="{{ route('admin_registrar_paciente') }}"
                        title="Registrar Paciente">Paciente</a></li>
            </ul>
        </div>
    </div>

    <!-- Filtros y Búsqueda -->
    <form id="filterForm" action="{{ route('admin_usuarios') }}" method="get" enctype="application/x-www-form-urlencoded"
        novalidate autocomplete="off" class="needs-validation">
        @csrf
        <div class="p-3 mb-4 bg-white rounded-3 shadow-sm border border-light">
            <div class="row g-3 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white text-secondary border-end-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" data-bs-theme="light" class="form-control border-start-0 border-secondary"
                            name="nameOrEmail" id="nameOrEmail" placeholder="Buscar por nombre o email..." maxlength="255"
                            value="{{ request('nameOrEmail', '') }}" />
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white text-secondary border-end-0 small">Rol:</span>
                        <select class="form-select border-start-0 ps-1 text-secondary border-secondary" name="rol_id"
                            id="rol_id" style="cursor: pointer;">
                            <option value="">Todos</option>
                            <option value="2" @selected(request('rol_id') === '2')>Psicólogo</option>
                            <option value="3" @selected(request('rol_id') === '3')>Paciente</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white text-secondary border-end-0 small">Estado:</span>
                        <select class="form-select border-start-0 text-secondary ps-1 border-secondary" name="is_active"
                            id="is_active" style="cursor: pointer;">
                            <option value="">Todos</option>
                            <option value="1" @selected(request('is_active') === '1')>Activo</option>
                            <option value="0" @selected(request('is_active') === '0')>Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-custom-red w-100 shadow-sm fw-bold"
                        onclick="document.getElementById('page').value = 1; document.getElementById('filterForm').requestSubmit();">Buscar</button>
                </div>
            </div>
        </div>
    </form>

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

    @empty($users->items())
        <div class="alert alert-info" role="alert">
            No se encontraron usuarios que coincidan con los criterios de búsqueda.
        </div>
    @else
        <div class="table-card mb-5">
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0" data-bs-theme="light" id="usersTable">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 70px;">Avatar</th>
                            <th scope="col">Nombre Completo</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Rol</th>
                            <th scope="col" class="text-center">Estado</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <img class="bg-secondary rounded-circle image-responsive"
                                        src="{{ asset('storage/' . $user->avatar_url) }}" alt="{{ $user->name }}"
                                        style="width: 36px; height: 36px;" />
                                </td>
                                <td class="fw-bold">{{ $user->full_name }}</td>
                                <td class="text-secondary">{{ $user->email }}</td>
                                <td class="text-center"><span
                                        class="status-badge {{ $user->role->slug === 'psychologist' ? 'badge-psicologo' : 'badge-paciente' }}">{{ $user->role->rol_name }}</span>
                                </td>
                                <td class="text-center"><span
                                        class="status-badge {{ $user->is_active ? 'badge-activo' : 'badge-inactivo' }}">{{ $user->is_active ? 'Activo' : 'Inactivo' }}</span>
                                </td>
                                <td>
                                    <div class="text-center row row-cols-1 row-cols-md-2 justify-content-center g-1">
                                        <a class="btn btn-sm btn-light text-secondary" title="Ver detalle"
                                            href="{{ $user->role->slug === 'psychologist' ? route('admin_detalle_usuario_psicologo', ['id' => $user->id]) : route('admin_detalle_usuario_paciente', ['id' => $user->id]) }}"
                                            target="_self"><i class="bi bi-eye-fill"></i></a>
                                        <form method="POST" action="" enctype="application/x-www-form-urlencoded"
                                            class="needs-validation" novalidate autocomplete="off">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-light text-danger w-100" title="Eliminar"
                                                type="submit"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-between align-items-center p-3 border-top flex-wrap gap-3">
                <span class="text-secondary small">Mostrando {{ ($users->currentPage() - 1) * 6 + 1 }} a
                    {{ $users->currentPage() * 6 > $users->total() ? $users->total() : $users->currentPage() * 6 }} de
                    {{ $users->total() }}
                    usuarios resultantes</span>
                <div class="btn-group">
                    <input id="page" type="hidden" name="page" value="{{ $users->currentPage() }}"
                        form="filterForm" />
                    <button onclick="changePage(-1, {{ $users->lastPage() }})" type="button"
                        class="btn btn-sm btn-outline-secondary px-3 bg-white" @disabled($users->onFirstPage())>Anterior</button>
                    <button onclick="changePage(1, {{ $users->lastPage() }})" type="button"
                        class="btn btn-sm btn-outline-secondary px-3 bg-white" @disabled(!$users->hasMorePages())>Siguiente</button>
                </div>
            </div>
        </div>
    @endempty

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const tabla = document.getElementById('usersTable');

            if (tabla) {
                tabla.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        })
    </script>
@endsection
