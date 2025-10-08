<header class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="/">Tecnologías Sinergia</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}"><i class="bi bi-house"></i> Inicio</a></li>
        <li class="nav-item"><a href="/pacientes" class="nav-link {{ request()->is('pacientes') ? 'active' : '' }}"><i class="bi bi-person-vcard"></i> Pacientes</a></li>
        <li class="nav-item"><a href="/usuarios" class="nav-link"><i class="bi bi-people"></i> Usuarios</a></li>
        <li class="nav-item"><a href="/departamentos" class="nav-link"><i class="bi bi-building"></i> Departamentos</a></li>
        <li class="nav-item"><a href="/municipios" class="nav-link"><i class="bi bi-geo-alt"></i> Municipios</a></li>
        <li class="nav-item"><a href="/tipos-documento" class="nav-link"><i class="bi bi-file-earmark-text"></i> Tipos Documento</a></li>
        <button id="btnLogout" class="btn btn-outline-danger btn-sm">
        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
      </button>
      </ul>
    </div>
  </div>
</header>
