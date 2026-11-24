<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="SIPAC - Sistema de Atención Psicológica Comunitaria" />
    <meta name="author" content="Ing. Karina Sayuri Diaz Martinez" />
    <link rel="icon" href="{{ asset('img/logo_without_back.png') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Importante -->

    <title>{{ config('app.name', 'SIPAC') }}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/cover/" />
    <script src="{{ asset('js/color-modes.js') }}"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <meta name="theme-color" content="#712cf9" />
    <link href="{{ asset('css/cover.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/globalstyles.css') }}" rel="stylesheet" />

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: #0000001a;
            border: solid rgba(0, 0, 0, 0.15);
            border-width: 1px 0;
            box-shadow:
                inset 0 0.5em 1.5em #0000001a,
                inset 0 0.125em 0.5em #00000026;
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -0.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .bi {
            width: 1em;
            height: 1em;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>
</head>

<body class="d-flex h-100 text-center text-bg-dark align-items-center justify-content-center">
    <div class="cover-container d-flex w-100 h-100 p-3 flex-column justify-content-center">
        <main class="px-3">
            <h1>Ups! Para acceder a esta página debes verificar tu correo electronico</h1>
            <p class="lead">
                Si necesitas volver a recibir el correo de verificación, haz click en el siguiente enlace:
            </p>
            <p class="lead">
                @if (!session('message'))
                    <form id="verificationForm" action="{{ route('verification.send') }}" method="POST" novalidate
                        autocomplete="off" enctype="application/x-www-form-urlencoded" class="needs-validation">@csrf
                        <button type="submit" class="btn btn-lg btn-light fw-bold border-white bg-white">
                            Reenviar correo de verificación
                        </button>
                    </form>
                @endif
            </p>

            @if (session('message'))
                <div class="alert alert-success mt-4" role="alert">
                    {{ session('message') }}
                </div>
            @endif
        </main>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" class="astro-vvvwv3sm"></script>
</body>

</html>
