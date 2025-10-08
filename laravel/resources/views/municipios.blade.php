@extends('base.app')

@section('title', 'Municipios')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold mb-0"><i class="bi bi-geo-alt"></i> Municipios</h2>
    <button class="btn btn-primary" id="btnNuevo"><i class="bi bi-plus-lg"></i> Nuevo</button>
  </div>

  <div id="alerta" class="alert d-none"></div>

  <div id="loader" class="text-center my-5">
    <div class="spinner-border text-primary" role="status"></div>
    <p class="mt-2">Cargando municipios...</p>
  </div>

  <div class="table-responsive shadow-sm d-none" id="tablaContainer">
    <table class="table table-striped align-middle" id="tablaMunicipios">
      <thead class="table-primary">
        <tr>
          <th class="sortable" data-campo="id">ID <i class="bi bi-arrow-down-up"></i></th>
          <th class="sortable" data-campo="nombre">Nombre <i class="bi bi-arrow-down-up"></i></th>
          <th class="sortable" data-campo="departamento_id">Departamento ID <i class="bi bi-arrow-down-up"></i></th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <div class="d-flex justify-content-between mt-3 flex-wrap">
    <div class="mb-2">
      <input type="text" id="filtro" class="form-control" placeholder="Filtrar por nombre...">
    </div>
    <nav>
      <ul class="pagination pagination-sm" id="paginacion"></ul>
    </nav>
  </div>
</div>

<div class="modal fade" id="modalMunicipio" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalTitle">Nuevo Municipio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formMunicipio">
          <input type="hidden" id="municipioId">
          <div class="mb-3">
            <label for="departamento_id" class="form-label">Departamento ID</label>
            <input type="number" id="departamento_id" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" class="form-control" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
  const apiBase = 'http://localhost:8080/api/';
  const token = localStorage.getItem('token');
  if (!token) return window.location.href = '/login';

  const tabla = document.querySelector('#tablaMunicipios tbody');
  const filtro = document.getElementById('filtro');
  const alerta = document.getElementById('alerta');
  const loader = document.getElementById('loader');
  const tablaContainer = document.getElementById('tablaContainer');
  let municipios = [];
  let paginaActual = 1;
  const porPagina = 10;
  let ordenCampo = 'id';
  let ordenAsc = true;

  function mostrarAlerta(msg, tipo='success') {
    alerta.className = `alert alert-${tipo}`;
    alerta.textContent = msg;
    alerta.classList.remove('d-none');
    setTimeout(() => alerta.classList.add('d-none'), 3000);
  }

  async function cargarMunicipios() {
    loader.classList.remove('d-none');
    tablaContainer.classList.add('d-none');
    try {
      const res = await fetch(`${apiBase}municipios`, {
        headers: { 'Authorization': `Bearer ${token}` }
      });
      municipios = await res.json();
      renderTabla();
      loader.classList.add('d-none');
      tablaContainer.classList.remove('d-none');
    } catch {
      mostrarAlerta('Error al cargar municipios', 'danger');
      loader.classList.add('d-none');
    }
  }

  function renderTabla() {
    const filtroTexto = filtro.value.toLowerCase();
    let filtrados = municipios.filter(m => m.nombre?.toLowerCase().includes(filtroTexto));

    filtrados = filtrados.sort((a,b)=>{
      const valA=a[ordenCampo]?.toString().toLowerCase();
      const valB=b[ordenCampo]?.toString().toLowerCase();
      if(valA<valB) return ordenAsc?-1:1;
      if(valA>valB) return ordenAsc?1:-1;
      return 0;
    });

    const inicio = (paginaActual - 1) * porPagina;
    const paginados = filtrados.slice(inicio, inicio + porPagina);

    tabla.innerHTML = paginados.map(m => `
      <tr>
        <td>${m.id}</td>
        <td>${m.nombre}</td>
        <td>${m.departamento_id}</td>
        <td class="text-center">
          <button class="btn btn-sm btn-outline-success me-2 btnEditar" data-id="${m.id}">
            <i class="bi bi-pencil"></i>
          </button>
          <button class="btn btn-sm btn-outline-danger btnEliminar" data-id="${m.id}">
            <i class="bi bi-trash"></i>
          </button>
        </td>
      </tr>`).join('');
    renderPaginacion(filtrados.length);
  }

  function renderPaginacion(total) {
    const totalPaginas = Math.ceil(total / porPagina);
    const paginacion = document.getElementById('paginacion');
    paginacion.innerHTML = '';
    for (let i = 1; i <= totalPaginas; i++) {
      const li = document.createElement('li');
      li.className = `page-item ${i === paginaActual ? 'active' : ''}`;
      li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
      li.addEventListener('click', e => {
        e.preventDefault();
        paginaActual = i;
        renderTabla();
      });
      paginacion.appendChild(li);
    }
  }

  filtro.addEventListener('input', renderTabla);
  document.querySelectorAll('.sortable').forEach(th => {
    th.addEventListener('click', () => {
      const campo = th.dataset.campo;
      if (ordenCampo === campo) ordenAsc = !ordenAsc;
      else { ordenCampo = campo; ordenAsc = true; }
      renderTabla();
    });
  });

  document.getElementById('btnNuevo').addEventListener('click', () => {
    document.getElementById('formMunicipio').reset();
    document.getElementById('municipioId').value = '';
    document.getElementById('modalTitle').textContent = 'Nuevo Municipio';
    new bootstrap.Modal('#modalMunicipio').show();
  });

  document.getElementById('btnGuardar').addEventListener('click', async () => {
    const id = document.getElementById('municipioId').value;
    const nombre = document.getElementById('nombre').value.trim();
    const departamento_id = document.getElementById('departamento_id').value;
    if (!nombre) return mostrarAlerta('El nombre es obligatorio', 'warning');

    const method = id ? 'PUT' : 'POST';
    const url = id ? `${apiBase}municipios/${id}` : `${apiBase}municipios`;

    try {
      const res = await fetch(url, {
        method,
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify({ nombre, departamento_id })
      });
      if (res.ok) {
        await cargarMunicipios();
        bootstrap.Modal.getInstance(document.getElementById('modalMunicipio')).hide();
        mostrarAlerta('Guardado exitosamente');
      } else mostrarAlerta('Error al guardar', 'danger');
    } catch {
      mostrarAlerta('Error al guardar', 'danger');
    }
  });

  document.addEventListener('click', e => {
    if (e.target.closest('.btnEditar')) {
      const id = e.target.closest('.btnEditar').dataset.id;
      const m = municipios.find(m => m.id == id);
      document.getElementById('municipioId').value = m.id;
      document.getElementById('nombre').value = m.nombre;
      document.getElementById('departamento_id').value = m.departamento_id;
      document.getElementById('modalTitle').textContent = 'Editar Municipio';
      new bootstrap.Modal('#modalMunicipio').show();
    }
  });

  document.addEventListener('click', async e => {
    if (e.target.closest('.btnEliminar')) {
      if (confirm('¿Eliminar este municipio?')) {
        const id = e.target.closest('.btnEliminar').dataset.id;
        await fetch(`${apiBase}municipios/${id}`, {
          method: 'DELETE',
          headers: { 'Authorization': `Bearer ${token}` }
        });
        await cargarMunicipios();
        mostrarAlerta('Municipio eliminado');
      }
    }
  });

  await cargarMunicipios();
});
</script>
@endsection
