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
      <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
      <link href="{{ asset('css/globalstyles.css') }}" rel="stylesheet" />
      <script src="{{ asset('js/globalscripts.js') }}"></script>
      <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/" />
      <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.2/font/bootstrap-icons.min.css">

      <!-- Styles -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
      <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">

      <!-- Scripts -->
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  </head>

  <body>
      <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
          <symbol id="list" viewBox="0 0 16 16">
              <path fill-rule="evenodd"
                  d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z">
              </path>
          </symbol>
      </svg>

      <header class="navbar navbar-light bg-white d-md-none border-bottom p-3">
          <a href="" class="brand-logo p-0 m-0 gap-3" style='height: 40px;'>
              <i class="bi bi-heart-pulse-fill d-block" style='transform: translateY(-2px);'></i> SIPAC
          </a>
          <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas"
              data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-label="Abrir menú">
              <svg class="bi" aria-hidden="true">
                  <use xlink:href="#list"></use>
              </svg>
          </button>
      </header>

      <nav id="sidebarMenu" class="sidebar offcanvas-md offcanvas-start position-fixed bg-white"
          style="background-color: #ffffff !important;" tabindex="-1">
          <div class="offcanvas-header d-md-none pb-0 mb-3">
              <a href="" class="brand-logo p-0 m-0 gap-3" style='height: 40px;'>
                  <i class="bi bi-heart-pulse-fill d-block" style='transform: translateY(-2px);'></i> SIPAC
              </a>
              <button type="button" class="shadow-none bg-transparent ms-auto border-0" data-bs-dismiss="offcanvas"
                  data-bs-target="#sidebarMenu" aria-label="Cerrar" style='z-index: 1000;'>
                  <i class="bi bi-x" style='color: var(--main-color); font-size: 2rem;'></i>
              </button>
          </div>

          <a href="" class="brand-logo d-none d-md-flex gap-3" style='height: 40px;'>
              <i class="bi bi-heart-pulse-fill d-block" style='transform: translateY(-2px);'></i> SIPAC
          </a>

          <ul class="nav flex-column mb-auto w-100">
              <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="" target="_self" title="Inicio">
                      <i class="bi bi-house"></i> Inicio
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="" target="_self" title="Usuarios">
                      <i class="bi bi-people"></i> Usuarios
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="" target="_self" title="Registrar Psicólogo">
                      <i class="bi bi-person-plus"></i> Registrar Psicólogo
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="" target="_self" title="Registrar Paciente">
                      <i class="bi bi-person-add"></i> Registrar Paciente
                  </a>
              </li>
          </ul>

          <!-- Botón Cerrar Sesión -->
          <div class="sidebar-footer w-100">
              <form id="logout" method="POST" enctype="application/x-www-form-urlencoded"
                  class="logout-link needs-validation" novalidate autocomplete="off" action="">
                  @csrf
                  <button type="submit"
                      class='bg-transparent border-0 shadow-none w-100 d-flex align-items-center gap-3 text-2xl text-dark fw-semibold'>
                      <i class="bi bi-box-arrow-left" style='transform: translateY(-6px);'></i> Cerrar Sesión
                  </button>
              </form>
          </div>
      </nav>

      <!-- CONTENIDO PRINCIPAL -->
      <main class="main-content-layout w-100 px-3 px-md-4 py-3">
          @yield('content')
      </main>
      <!-- CONTENIDO PRINCIPAL -->

      <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
      <script type="text/javascript">
          document.addEventListener('DOMContentLoaded', asigListenersOfSubmitForms);
      </script>
  </body>

  </html>
