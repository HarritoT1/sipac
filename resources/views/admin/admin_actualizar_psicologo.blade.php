<!doctype html>
<html lang="es" data-bs-theme="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Actualizar Psicólogo SIPAC - Tláhuac" />
  <title>Actualizar Psicólogo · SIPAC</title>


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
        <h1 class="h4 mb-0 fw-bold text-dark">Actualizar Psicólogo</h1>
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
        <h2 class="form-card-title">Información del Profesional</h2>
        <p class="form-card-subtitle">Actualiza los campos de interés del psicólogo en SIPAC.</p>

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
              <input type="text" class="form-control-custom" value="Doc. Juan Manuel Solís" />
            </div>
            <div class="col-md-6">
              <label class="custom-label">Nombre de usuario (recuerda guardarlo)</label>
              <input type="text" class="form-control-custom" value="JuanMaSolis" />
            </div>

            <div class="col-md-6">
              <label class="custom-label">Especialidad</label>
              <div class="specialty-badge-box">
                <div>
                  <span class="specialty-tag">✕ Ansiedad</span>
                  <span class="specialty-tag">✕ Depresión</span>
                </div>
                <i class="bi bi-chevron-down text-muted" style="font-size: 0.85rem;"></i>
              </div>
            </div>
            <div class="col-md-6">
              <label class="custom-label">Activo en el sistema</label>
              <select class="form-select-custom">
                <option value="si" selected>Sí</option>
                <option value="no">No</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="custom-label">Teléfono</label>
              <input type="text" class="form-control-custom" value="558837468" />
            </div>
            <div class="col-md-6">
              <label class="custom-label">Número de Licencia (cédula profesional)</label>
              <input type="text" class="form-control-custom" value="L-9823415-COL" />
            </div>

            <div class="col-md-6">
              <label class="custom-label">CURP</label>
              <input type="text" class="form-control-custom" value="CATH041E031215HGRRR" />
            </div>
            <div class="col-md-6">
              <label class="custom-label">Domicilio</label>
              <input type="text" class="form-control-custom" value="Calle Bugambilias. Colonia Lomas. CDMX." />
            </div>

            <div class="col-md-6">
              <label class="custom-label">Años de experiencia</label>
              <input type="number" class="form-control-custom" value="1" />
            </div>
            <div class="col-md-6">
              <label class="custom-label">Tarifa de consulta</label>
              <input type="text" class="form-control-custom" value="250.00" />
            </div>

            <div class="col-12">
              <label class="custom-label">Agrega una descripción de tu trayectoria profesional</label>
              <input type="text" class="form-control-custom" value="Llevo una trayectoria..." />
            </div>

          </div>

          <!-- Acciones de guardado -->
          <div class="form-actions">
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