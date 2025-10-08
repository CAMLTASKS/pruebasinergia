@extends('base.app')

@section('title', 'Inicio')

@section('content')
<div class="container py-4">
  <div class="text-center mb-5">
    <h2 class="fw-bold mb-3">Bienvenido al Panel de Control</h2>
    <center>
      <img src="https://sinergiaonline.com/wp-content/uploads/2025/03/logo-color-sinergia@2x.png" alt="">
    </center>
    <p>Aqui podras ver y administrar cada uno de los modulos solicitados en la prueba, de acuerdo a ello por este medio podras tambien ver la respuesta a las preguntas de la prueba tecnica para facilidad.</p>
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


  </div>
</div>
@endsection
