<!doctype html>
<html lang="es" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="SIPAC - Sistema de Atención Psicológica Comunitaria" />
    <meta name="author" content="Ing. Karina Sayuri Diaz Martinez" />
    <link rel="icon" href="{{ asset('img/logo_without_back.png') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Importante -->

    <title>{{ config('app.name', 'SIPAC') }}</title>

    <script src="{{ asset('js/globalscripts.js') }}"></script>
    <script src="{{ asset('js/color-modes.js') }}"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sign-in.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/globalstyles.css') }}" rel="stylesheet" />

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

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

<body class="d-flex align-items-center py-4"
    style="background: var(--background-color-login, linear-gradient(135deg, #7c1a22 0%, #1a0826 100%)) !important; min-height: 100vh;">

    <main class="form-signin w-100 m-auto text-center"
        style="background-color: #ffffff; padding: 2.5rem 2rem; border-radius: 12px; box-shadow: 0px 10px 30px rgba(0,0,0,0.3); max-width: 400px;">
        <form id="newPasswordForm" action="" method="post" enctype="application/x-www-form-urlencoded"
            class="needs-validation" autocomplete="off" novalidate>
            @csrf
            @method('PUT')

            <img class="mb-2" src="{{ asset('img/logo.PNG') }}" alt="SIPAC Logo" width="48" height="48" />


            <h1 class="h4 mb-1 fw-bold" style="color: var(--main-color, #9b1d20);">SIPAC</h1>
            <p class="mb-3" style="color: var(--text-gray, #6c757d); font-size: 0.85rem;">Sistema de Atención
                Psicológica Comunitaria</p>


            <h2 class="h6 mb-4 fw-bold text-dark">Recuperación de contraseña</h2>


            <div class="mb-3 text-start">
                <label for="password" class="form-label fw-bold small" style="color: #1e293b; font-size: 0.8rem;">Nueva
                    contraseña</label>
                <input type="text" class="form-control" id="password" placeholder="............"
                    style="background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 0.9rem;" required
                    maxlength="255" value="" />
                <div class="valid-feedback" id="password_valid_feedback">
                    Contraseña válida.
                </div>
                <div class="invalid-feedback" id="password_invalid_feedback">
                    Ingresa una contraseña válida.
                </div>
            </div>


            <div class="mb-4 text-start">
                <label for="confirm_password" class="form-label fw-bold small"
                    style="color: #1e293b; font-size: 0.8rem;">Confirma tu nueva contraseña</label>
                <input type="text" class="form-control" id="confirm_password" placeholder="............"
                    style="background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 0.9rem;" required
                    maxlength="255" value="" />
                <div class="valid-feedback" id="confirm_password_valid_feedback">
                    Contraseña válida.
                </div>
                <div class="invalid-feedback" id="confirm_password_invalid_feedback">
                    Las contraseñas no coinciden.
                </div>
            </div>

            <button id="submit" class="btn w-100 py-2 fw-bold" type="submit"
                style="background-color: var(--main-color, #9b1d20); color: white;">
                Actualizar contraseña
            </button>
        </form>
    </main>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            asigListenersOfSubmitForms();
            document.getElementById('password')?.addEventListener('input', matchPasswords);
            document.getElementById('confirm_password')?.addEventListener('input', matchPasswords);
        });
    </script>
</body>

</html>
