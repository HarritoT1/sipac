<!doctype html>
<html lang="es" data-bs-theme="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Actualizar Paciente SIPAC - Tláhuac" />
  <title>Actualizar Paciente · SIPAC</title>


  <script src="../js/color-modes.js"></script>
  <link href="../css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
  <link href="../css/globalstyles.css" rel="stylesheet" />
</head>

<body>
 
  <header class="navbar navbar-light bg-white d-md-none border-bottom p-3">
    <a href="inicio.html" class="brand-logo p-0 m-0">
      <i class="bi bi-heart-pulse-fill"></i> SIPAC
    </a>
    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-label="Abrir menú">
      <span class="navbar-toggler-icon"></span>
    </button>
  </header>

  <div class="d-flex">
   
    <nav id="sidebarMenu" class="sidebar offcanvas-md offcanvas-start position-fixed bg-white" style="background-color: #ffffff !important;" tabindex="-1">
      <div class="offcanvas-header d-md-none pb-0">
        <a href="inicio.html" class="brand-logo p-0 m-0">
          <i class="bi bi-heart-pulse-fill"></i> SIPAC
        </a>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Cerrar"></button>
      </div>


      <a href="inicio.html" class="brand-logo d-none d-md-flex">
        <i class="bi bi-heart-pulse-fill"></i> SIPAC
      </a>

      <!-- Lista de Navegación -->
      <ul class="nav flex-column mb-auto w-100">
        <li class="nav-item">
          <a class="nav-link" href="inicio.html">
            <i class="bi bi-house"></i> Inicio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="usuarios.html">
            <i class="bi bi-people"></i> Usuarios
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registrar-psicologo.html">
            <i class="bi bi-person-plus"></i> Registrar Psicólogo
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registrar-paciente.html">
            <i class="bi bi-person-add"></i> Registrar Paciente
          </a>
        </li>
      </ul>

      <!-- Botón Cerrar Sesión -->
      <div class="sidebar-footer w-100">
        <a href="index.html" class="logout-link">
          <i class="bi bi-box-arrow-left"></i> Cerrar Sesión
        </a>
      </div>
    </nav>

    <main class="main-content-layout w-100 px-3 px-md-5 py-3">
      

      <div class="top-header">
        <h1 class="h4 mb-0 fw-bold text-dark">Actualizar Paciente</h1>
        <div class="profile-section">
          <div class="profile-badge-avatar">AD</div>
          <div class="d-flex flex-column lh-1">
            <span class="fw-bold text-dark" style="font-size: 0.95rem;">Administrador</span>
            <span class="text-muted" style="font-size: 0.8rem;">Perfil</span>
          </div>
        </div>
      </div>

      <!-- Tarjeta del Formulario -->
      <div class="form-card p-4 p-md-5 mx-auto">
        <h2 class="form-card-title">Información del Paciente</h2>
        <p class="form-card-subtitle">Actualiza los campos de interés del paciente en SIPAC.</p>

        <!-- Edición de Avatar -->
        <div class="avatar-upload-container">
          <div class="avatar-placeholder-circle">
            <i class="bi bi-person"></i>
          </div>
          <div class="avatar-actions-group">
            <button type="button" class="btn-avatar-change">Cambiar Avatar</button>
            <p class="avatar-format-hint">Formatos aceptados: PNG, JPG. Máximo 2MB.</p>
            <button type="button" class="btn-avatar-delete">Eliminar Avatar</button>
          </div>
        </div>

        <form>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="custom-label">Nombre y apellidos</label>
              <input type="text" class="form-control-custom" value="Karina Sayuri Díaz Martínez" />
            </div>
            <div class="col-md-6">
              <label class="custom-label">Nombre de usuario</label>
              <input type="text" class="form-control-custom" value="Mooniieex" />
            </div>

            <div class="col-md-6">
              <label class="custom-label">Teléfono</label>
              <input type="text" class="form-control-custom" value="5588374683" />
            </div>
            <div class="col-md-6">
              <label class="custom-label">Activo en el sistema</label>
              <select class="form-select-custom">
                <option value="si" selected>Sí</option>
                <option value="no">No</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="custom-label">CURP</label>
              <input type="text" class="form-control-custom" value="CATH031674HMREEFFA" />
            </div>
            <div class="col-md-6">
              <label class="custom-label">Domicilio</label>
              <input type="text" class="form-control-custom" value="Calle Margaritas, CDMX, C.P. 54777" />
            </div>

            <div class="col-md-6">
              <label class="custom-label">Fecha de cumpleaños</label>
              <input type="date" class="form-control-custom" value="2003-11-11" />
            </div>
            <div class="col-md-6">
              <label class="custom-label">Género</label>
              <select class="form-select-custom">
                <option value="femenino" selected>Femenino</option>
                <option value="masculino">Masculino</option>
                <option value="otro">Otro</option>
              </select>
            </div>
          </div>

          <!-- Contactos de Emergencia -->
          <div class="section-emergency-header">
            <div>
              <h3 class="form-card-title mb-1" style="font-size: 0.95rem;">Agregue los contactos de emergencia del paciente</h3>
              <p class="text-muted mb-0" style="font-size: 0.8rem;">Se recomienda por lo menos agregar uno.</p>
            </div>
            <button type="button" class="btn-add-circle" title="Agregar contacto">
              <i class="bi bi-plus-circle-fill"></i>
            </button>
          </div>

          <!-- Contacto 1 -->
          <div class="emergency-contact-block border-bottom pb-4 mb-4">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="custom-label">Nombre y apellidos</label>
                <input type="text" class="form-control-custom" value="Juan Manuel Díaz Cruz" />
              </div>
              <div class="col-md-6">
                <label class="custom-label">Parentesco</label>
                <select class="form-select-custom">
                  <option value="padre" selected>Padre</option>
                  <option value="madre">Madre</option>
                  <option value="amigo">Amigo(a)</option>
                  <option value="otro">Otro</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="custom-label">Correo Electrónico</label>
                <input type="email" class="form-control-custom" value="af.giraldo@psicogestion.com" />
              </div>
              <div class="col-md-6">
                <label class="custom-label">Teléfono</label>
                <div class="d-flex align-items-center gap-2">
                  <input type="text" class="form-control-custom" value="5588374683" />
                  <button type="button" class="btn-delete-contact" title="Eliminar contacto">
                    <i class="bi bi-x-circle-fill"></i>
                  </button>
                </div>
              </div>

              <div class="col-12 mt-2">
                <div class="d-flex align-items-center gap-3">
                  <span class="custom-label mb-0">Es el contacto principal del paciente:</span>
                  <div class="form-check form-switch m-0 p-0 d-flex align-items-center">
                    <input class="form-check-input form-check-input-custom ms-0" type="checkbox" role="switch" checked />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Contacto 2 -->
          <div class="emergency-contact-block">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="custom-label">Nombre y apellidos</label>
                <input type="text" class="form-control-custom" value="Jesus Pérez Olín" />
              </div>
              <div class="col-md-6">
                <label class="custom-label">Parentesco</label>
                <select class="form-select-custom">
                  <option value="amigo" selected>Amigo(a)</option>
                  <option value="padre">Padre</option>
                  <option value="madre">Madre</option>
                  <option value="otro">Otro</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="custom-label">Correo Electrónico</label>
                <input type="email" class="form-control-custom" value="jesusito@gmail.com" />
              </div>
              <div class="col-md-6">
                <label class="custom-label">Teléfono</label>
                <div class="d-flex align-items-center gap-2">
                  <input type="text" class="form-control-custom" value="5596863214" />
                  <button type="button" class="btn-delete-contact" title="Eliminar contacto">
                    <i class="bi bi-x-circle-fill"></i>
                  </button>
                </div>
              </div>

              <div class="col-12 mt-2">
                <div class="d-flex align-items-center gap-3">
                  <span class="custom-label mb-0">Es el contacto principal del paciente:</span>
                  <div class="form-check form-switch m-0 p-0 d-flex align-items-center">
                    <input class="form-check-input form-check-input-custom ms-0" type="checkbox" role="switch" />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Acciones de guardado -->
          <div class="form-actions border-top pt-4">
            <a href="usuarios.html" class="btn btn-cancel">Cancelar</a>
            <button type="submit" class="btn btn-save">Guardar cambios</button>
          </div>
        </form>

      </div>

    </main>
  </div>

  <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>