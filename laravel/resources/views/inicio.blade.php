@extends('base.app')

@section('title', 'Inicio')

@section('content')
<div class="container py-4">
  <div class="text-center mb-5">
    <h2 class="fw-bold mb-3">Bienvenido al Panel de Control</h2>
    <p>Selecciona una opción del menú o de las tarjetas para gestionar los módulos del sistema.</p>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-person-vcard display-5 text-primary mb-3"></i>
          <h5>Pacientes</h5>
          <p>Administra los registros de pacientes.</p>
          <a href="/pacientes" class="btn btn-outline-primary btn-sm">Ver módulo</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-people display-5 text-primary mb-3"></i>
          <h5>Usuarios</h5>
          <p>Gestión de cuentas del sistema.</p>
          <a href="/usuarios" class="btn btn-outline-primary btn-sm">Ver módulo</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-building display-5 text-primary mb-3"></i>
          <h5>Departamentos</h5>
          <p>Administra los departamentos registrados.</p>
          <a href="/departamentos" class="btn btn-outline-primary btn-sm">Ver módulo</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-geo-alt display-5 text-primary mb-3"></i>
          <h5>Municipios</h5>
          <p>Gestiona los municipios por departamento.</p>
          <a href="/municipios" class="btn btn-outline-primary btn-sm">Ver módulo</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-file-earmark-text display-5 text-primary mb-3"></i>
          <h5>Tipos Documento</h5>
          <p>Gestión de los tipos de identificación.</p>
          <a href="/tipos-documento" class="btn btn-outline-primary btn-sm">Ver módulo</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-gender-ambiguous display-5 text-primary mb-3"></i>
          <h5>Género</h5>
          <p>Configura los géneros disponibles.</p>
          <a href="/genero" class="btn btn-outline-primary btn-sm">Ver módulo</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-journal-text display-5 text-primary mb-3"></i>
          <h5>Resolución Conocimientos</h5>
          <p>Respuesta a los ejercicios de conocimientos basicos.</p>
          <a href="/resolucion-conocimientos" class="btn btn-outline-primary btn-sm">Ver módulo</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-gear display-5 text-primary mb-3"></i>
          <h5>Configuración</h5>
          <p>Administra parámetros generales del sistema.</p>
          <a href="/configuracion" class="btn btn-outline-primary btn-sm">Ver módulo</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
