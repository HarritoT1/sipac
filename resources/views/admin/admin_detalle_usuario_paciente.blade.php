<!doctype html>
<html lang="es" data-bs-theme="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Detalle de Paciente SIPAC - Tláhuac" />
  <title>Detalle del Paciente · SIPAC</title>

   
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

     
    <main class="main-content-layout w-100 px-3 px-md-4 py-3">
      
 
      <div class="top-header">
        <h1 class="h4 mb-0 fw-bold text-dark">Detalle del Paciente</h1>
        <div class="profile-section">
          <div class="profile-badge-avatar">AD</div>
          <div class="d-flex flex-column lh-1">
            <span class="fw-bold text-dark" style="font-size: 0.95rem;">Administrador</span>
            <span class="text-muted" style="font-size: 0.8rem;">Perfil</span>
          </div>
        </div>
      </div>

     
      <div class="row gx-4 mb-5 align-items-start">
        
  
        <div class="col-xl-4 col-lg-5 mb-4">
          <div class="custom-card p-4 text-center">
            
            <div class="profile-placeholder-large">
              <i class="bi bi-person"></i>
            </div>

            <h5 class="fw-bold text-dark mb-1">Sayuri Díaz Martínez</h5>
            <p class="text-muted mb-3" style="font-size: 0.85rem;">Moonlleex</p>
            
            <div class="d-flex justify-content-center gap-2 mb-2">
              <span class="badge-custom badge-role">Paciente</span>
              <span class="badge-custom badge-status-active">Activo</span>
            </div>

            
            <div class="stats-container">
              <div class="stat-box">
                <div class="stat-number">12</div>
                <div class="stat-label">Citas Totales</div>
              </div>
              <div class="stat-divider"></div>
              <div class="stat-box">
                <div class="stat-number">24 Oct</div>
                <div class="stat-label">Última Cita</div>
              </div>
            </div>

            <!-- Botones de Acción -->
            <div class="d-flex flex-column gap-2 pt-1">
              <button type="button" class="btn btn-action-edit">
                <i class="bi bi-pencil-square"></i>
                <span>Editar Perfil</span>
              </button>
              <button type="button" class="btn btn-action-delete">
                <i class="bi bi-trash"></i>
                <span>Eliminar Cuenta</span>
              </button>
            </div>

          </div>
        </div>

     
        <div class="col-xl-8 col-lg-7 d-flex flex-column gap-4">
          
          <!-- Datos Personales -->
          <div class="custom-card p-4">
            <h5 class="section-title">Datos Personales</h5>
            <div class="row gy-3">
              <div class="col-sm-6">
                <div class="field-label">Correo Electrónico</div>
                <div class="field-value">sofia.m@gmail.com</div>
              </div>
              <div class="col-sm-6">
                <div class="field-label">Teléfono</div>
                <div class="field-value">558837468</div>
              </div>
              <div class="col-sm-6">
                <div class="field-label">Fecha de Nacimiento</div>
                <div class="field-value">14 de Abril de 1995</div>
              </div>
              <div class="col-sm-6">
                <div class="field-label">Género</div>
                <div class="field-value">Femenino</div>
              </div>
              <div class="col-sm-6">
                <div class="field-label">Domicilio</div>
                <div class="field-value">Calle 45 #12-89, CDMX</div>
              </div>
              <div class="col-sm-6">
                <div class="field-label">CURP</div>
                <div class="field-value">CAHTG032524HMCRRRA6</div>
              </div>
            </div>
          </div>

          <!-- Contactos de Emergencia -->
          <div class="custom-card p-4">
            <h5 class="section-title">Contactos de Emergencia</h5>
            <div class="table-responsive">
              <table class="custom-table mb-0">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Parentesco</th>
                    <th>Número</th>
                    <th>Correo</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="fw-semibold">Juan Manuel Díaz</td>
                    <td>Padre</td>
                    <td>5588375896</td>
                    <td>juanmd@gmail.com</td>
                  </tr>
                  <tr>
                    <td class="fw-semibold">Luisa Martínez</td>
                    <td>Madre</td>
                    <td>5569863214</td>
                    <td>Ninguno</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Últimas Citas Programadas -->
          <div class="custom-card p-4">
            <h5 class="section-title">Últimas 5 Citas Programadas</h5>
            <div class="table-responsive">
              <table class="custom-table mb-0">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Psicólogo</th>
                    <th class="text-end">Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>24 Oct 2026</td>
                    <td>10:00 AM</td>
                    <td>Dr. Jose Luis Romo</td>
                    <td class="text-end">
                      <span class="badge-pill-status badge-pill-completed">Completada</span>
                    </td>
                  </tr>
                  <tr>
                    <td>10 Nov 2026</td>
                    <td>11:30 AM</td>
                    <td>Dr. Jose Luis Romo</td>
                    <td class="text-end">
                      <span class="badge-pill-status badge-pill-scheduled">Programada</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>

      </div>

    </main>
  </div>

  <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>