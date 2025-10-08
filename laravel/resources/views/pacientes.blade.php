@extends('base.app')

@section('title', 'Pacientes')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold mb-0"><i class="bi bi-person-vcard"></i> Pacientes</h2>
    <button class="btn btn-primary" id="btnNuevo"><i class="bi bi-plus-lg"></i> Nuevo</button>
  </div>

  <div id="alerta" class="alert d-none"></div>

  <div id="loader" class="text-center my-5">
    <div class="spinner-border text-primary"></div>
    <p class="mt-2">Cargando pacientes...</p>
  </div>

  <div class="table-responsive shadow-sm d-none" id="tablaContainer">
    <table class="table table-striped align-middle" id="tablaPacientes">
      <thead class="table-primary">
        <tr>
          <th>ID</th>
          <th>Nombre completo</th>
          <th>Correo</th>
          <th>Tipo Doc</th>
          <th>N° Doc</th>
          <th>Género</th>
          <th>Municipio</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <div class="d-flex justify-content-between mt-3 flex-wrap">
    <input type="text" id="filtro" class="form-control w-auto" placeholder="Filtrar por nombre...">
    <nav><ul class="pagination pagination-sm" id="paginacion"></ul></nav>
  </div>
</div>

<div class="modal fade" id="modalPaciente" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalTitle">Nuevo Paciente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formPaciente" novalidate>
          <input type="hidden" id="pacienteId">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="tipo_documento_id" class="form-label">Tipo Documento</label>
              <input type="number" id="tipo_documento_id" class="form-control" required>
              <div class="invalid-feedback">Ingrese un tipo de documento válido.</div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="numero_documento" class="form-label">Número Documento</label>
              <input type="text" id="numero_documento" class="form-control" required minlength="5" maxlength="20">
              <div class="invalid-feedback">Ingrese un número de documento válido (solo números, mínimo 5 dígitos).</div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="nombre1" class="form-label">Primer Nombre</label>
              <input type="text" id="nombre1" class="form-control" required pattern="[A-Za-z\s]+">
              <div class="invalid-feedback">El nombre solo debe contener letras.</div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="apellido1" class="form-label">Primer Apellido</label>
              <input type="text" id="apellido1" class="form-control" required pattern="[A-Za-z\s]+">
              <div class="invalid-feedback">El apellido solo debe contener letras.</div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="genero_id" class="form-label">Género</label>
              <input type="number" id="genero_id" class="form-control" required>
              <div class="invalid-feedback">Seleccione un género válido.</div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="municipio_id" class="form-label">Municipio ID</label>
              <input type="number" id="municipio_id" class="form-control" required>
              <div class="invalid-feedback">Ingrese un municipio válido.</div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="correo" class="form-label">Correo</label>
              <input type="email" id="correo" class="form-control" required>
              <div class="invalid-feedback">Ingrese un correo válido.</div>
            </div>
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
document.addEventListener('DOMContentLoaded', async()=>{
  const apiBase='http://localhost:8080/api/';
  const token=localStorage.getItem('token');
  if(!token)return window.location='/login';
  const tabla=document.querySelector('#tablaPacientes tbody');
  const filtro=document.getElementById('filtro');
  const alerta=document.getElementById('alerta');
  const loader=document.getElementById('loader');
  const tablaContainer=document.getElementById('tablaContainer');
  let pacientes=[],paginaActual=1,porPagina=10;

  function alertMsg(m,t='success'){
    alerta.className=`alert alert-${t}`;
    alerta.textContent=m;
    alerta.classList.remove('d-none');
    setTimeout(()=>alerta.classList.add('d-none'),3000);
  }

  async function cargarPacientes(){
    loader.classList.remove('d-none');tablaContainer.classList.add('d-none');
    try{
      const res=await fetch(`${apiBase}pacientes`,{headers:{'Authorization':`Bearer ${token}`}});
      pacientes=await res.json();renderTabla();loader.classList.add('d-none');tablaContainer.classList.remove('d-none');
    }catch{alertMsg('Error al cargar','danger');loader.classList.add('d-none');}
  }

  function renderTabla(){
    const f=filtro.value.toLowerCase();
    const filtrados=pacientes.filter(p=>(p.nombre1+' '+p.apellido1).toLowerCase().includes(f));
    const inicio=(paginaActual-1)*porPagina;const pag=filtrados.slice(inicio,inicio+porPagina);
    tabla.innerHTML=pag.map(p=>`
      <tr><td>${p.id}</td><td>${p.nombre1} ${p.apellido1}</td><td>${p.correo}</td>
      <td>${p.tipo_documento_id}</td><td>${p.numero_documento}</td>
      <td>${p.genero_id}</td><td>${p.municipio_id}</td>
      <td class='text-center'>
        <button class='btn btn-sm btn-outline-success me-2 btnEditar' data-id='${p.id}'><i class='bi bi-pencil'></i></button>
        <button class='btn btn-sm btn-outline-danger btnEliminar' data-id='${p.id}'><i class='bi bi-trash'></i></button>
      </td></tr>`).join('');
    renderPag(filtrados.length);
  }

  function renderPag(t){
    const total=Math.ceil(t/porPagina);
    const paginacion=document.getElementById('paginacion');
    paginacion.innerHTML='';
    for(let i=1;i<=total;i++){
      const li=document.createElement('li');
      li.className=`page-item ${i===paginaActual?'active':''}`;
      li.innerHTML=`<a class='page-link' href='#'>${i}</a>`;
      li.addEventListener('click',e=>{e.preventDefault();paginaActual=i;renderTabla();});
      paginacion.appendChild(li);
    }
  }

  filtro.addEventListener('input',renderTabla);

  document.getElementById('btnNuevo').addEventListener('click',()=>{
    document.getElementById('formPaciente').reset();
    document.querySelectorAll('.form-control').forEach(i=>i.classList.remove('is-invalid'));
    document.getElementById('pacienteId').value='';
    document.getElementById('modalTitle').textContent='Nuevo Paciente';
    new bootstrap.Modal('#modalPaciente').show();
  });

  function validarFormulario(){
    let valido=true;
    const correo=document.getElementById('correo');
    const doc=document.getElementById('numero_documento');
    document.querySelectorAll('#formPaciente input[required]').forEach(i=>{
      if(!i.value.trim()){i.classList.add('is-invalid');valido=false;}
      else i.classList.remove('is-invalid');
    });
    if(!/^\d{5,20}$/.test(doc.value)){doc.classList.add('is-invalid');valido=false;}
    if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo.value)){correo.classList.add('is-invalid');valido=false;}
    return valido;
  }

  document.getElementById('btnGuardar').addEventListener('click',async()=>{
    if(!validarFormulario())return alertMsg('Verifica los campos','warning');
    const id=document.getElementById('pacienteId').value;
    const datos={
      tipo_documento_id:document.getElementById('tipo_documento_id').value,
      numero_documento:document.getElementById('numero_documento').value,
      nombre1:document.getElementById('nombre1').value,
      apellido1:document.getElementById('apellido1').value,
      genero_id:document.getElementById('genero_id').value,
      municipio_id:document.getElementById('municipio_id').value,
      correo:document.getElementById('correo').value
    };
    const method=id?'PUT':'POST';
    const url=id?`${apiBase}pacientes/${id}`:`${apiBase}pacientes`;
    const res=await fetch(url,{method,headers:{'Content-Type':'application/json','Authorization':`Bearer ${token}`},body:JSON.stringify(datos)});
    if(res.ok){
      await cargarPacientes();
      bootstrap.Modal.getInstance(document.getElementById('modalPaciente')).hide();
      alertMsg('Guardado exitosamente');
    }else alertMsg('Error al guardar','danger');
  });

  document.addEventListener('click',e=>{
    if(e.target.closest('.btnEditar')){
      const id=e.target.closest('.btnEditar').dataset.id;
      const p=pacientes.find(x=>x.id==id);
      document.getElementById('pacienteId').value=p.id;
      document.getElementById('tipo_documento_id').value=p.tipo_documento_id;
      document.getElementById('numero_documento').value=p.numero_documento;
      document.getElementById('nombre1').value=p.nombre1;
      document.getElementById('apellido1').value=p.apellido1;
      document.getElementById('genero_id').value=p.genero_id;
      document.getElementById('municipio_id').value=p.municipio_id;
      document.getElementById('correo').value=p.correo;
      document.getElementById('modalTitle').textContent='Editar Paciente';
      new bootstrap.Modal('#modalPaciente').show();
    }
  });

  document.addEventListener('click',async e=>{
    if(e.target.closest('.btnEliminar')){
      if(confirm('¿Eliminar este paciente?')){
        const id=e.target.closest('.btnEliminar').dataset.id;
        await fetch(`${apiBase}pacientes/${id}`,{method:'DELETE',headers:{'Authorization':`Bearer ${token}`}});
        await cargarPacientes();
        alertMsg('Paciente eliminado');
      }
    }
  });

  await cargarPacientes();
});
</script>
@endsection
