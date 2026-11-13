<!doctype html>
<html lang="es" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="SIPAC - Sistema de Atención Psicológica Comunitaria" />
    <meta name="author" content="Ing. Karina Sayuri Diaz Martinez" />
    <link rel="icon" href="{{ asset('img/logo_without_back.png') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Importante -->

    <title>{{ config('app.name', 'SIPAC') }}</title>

    <script src="{{ asset('js/color-modes.js') }}"></script>
    <script src="{{ asset('js/globalscripts.js') }}"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link href="{{ asset('css/globalstyles.css') }}" rel="stylesheet" />

    <style>
        @media(min-width: 576px) {
            main {
                max-width: 450px !important;
                width: 100% !important;
            }
        }

        @media(max-width: 575.98px) {
            main {
                max-width: 325px !important;
                width: 100% !important;
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center py-4"
    style="background-image: var(--background-color-login) !important; min-height: 100vh; margin: 0;">

    <main class="text-center"
        style="background-color: #ffffff; padding: 2.5rem 2rem; border-radius: 16px; box-shadow: 0px 10px 30px rgba(0,0,0,0.3);">
        <form id="login" action="{{ route('auth.login') }}" method="post"
            enctype="application/x-www-form-urlencoded" class="needs-validation" novalidate autocomplete="off">
            @csrf

            <img class="mb-2 image-responsive" src="{{ asset('img/logo.png') }}" alt="Logo SIPAC" width="48"
                height="48" />

            <h1 class="h4 mb-1 fw-bold" style="color: #991B1B;">SIPAC</h1>
            <p class="mb-4" style="color: #475569; font-size: 0.85rem;">Sistema de Atención Psicológica Comunitaria
            </p>

            <!-- Campo Usuario -->
            <div class="mb-3 text-start">
                <label for="name" class="form-label fw-bold small" style="color: #1e293b; font-size: 0.8rem;">Nombre
                    de
                    usuario</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de usuario"
                    style="background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 0.9rem;" required
                    maxlength="255" value="" />

                <div class="invalid-feedback">
                    Ingresa un usuario válido.
                </div>
            </div>

            <!-- Campo Contraseña -->
            <div class="mb-4 text-start position-relative">
                <label for="password" class="form-label fw-bold small"
                    style="color: #1e293b; font-size: 0.8rem;">Contraseña</label>
                <input type="password" name="password" class="form-control border-end-0 shadow-none m-0" id="password"
                    placeholder="••••••••••••••••••"
                    style="background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 0.9rem; padding: 0.6rem 0.75rem; border-radius: 6px !important;"
                    required maxlength="255" value="" />
                <span onclick="togglePassword()">
                    <img src="{{ asset('img/eye.png') }}" alt="toggle_pass" class="imageResponsive"
                        style="width: 1.2rem; position: absolute; top: 50%; right: 20px; cursor: pointer; border-radius: 100%; background-color: transparent;">
                </span>
                <div class="invalid-feedback">
                    Ingresa una contraseña válida.
                </div>
            </div>

            <!-- Recordar sesión -->
            <div class="form-check text-start mb-4">
                <input class="form-check-input" type="checkbox" name="remember_token" value="remember-me"
                    id="rememberMe" />
                <label class="form-check-label" for="rememberMe" style="color: #475569; font-size: 0.85rem;">
                    Acuérdate de mí
                </label>
            </div>

            <!-- Botón Iniciar Sesión -->
            <button class="btn w-100 py-2 fw-bold text-white shadow-sm" type="submit"
                style="background-color: #991B1B; border: none; border-radius: 6px;">
                Iniciar Sesión
            </button>

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

            <!-- Olvidé mi contraseña -->
            <div class="mt-4">
                <a href="{{ route('request_email') }}" class="fw-bold small"
                    style="color: #991B1B !important; text-decoration: none;">Olvidé
                    mi
                    contraseña</a>
            </div>
        </form>
    </main>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', asigListenersOfSubmitForms);
    </script>
</body>

</html>
