@extends('base.app')

@section('title', 'Usuarios')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold mb-0"><i class="bi bi-people"></i> Usuarios</h2>
    <button class="btn btn-primary" id="btnNuevo"><i class="bi bi-plus-lg"></i> Nuevo</button>
  </div>

  <div id="alerta" class="alert d-none"></div>

  <div id="loader" class="text-center my-5">
    <div class="spinner-border text-primary" role="status"></div>
    <p class="mt-2">Cargando usuarios...</p>
  </div>

  <div class="table-responsive shadow-sm d-none" id="tablaContainer">
    <table class="table table-striped align-middle" id="tablaUsuarios">
      <thead class="table-primary">
        <tr>
          <th class="sortable" data-campo="id">ID <i class="bi bi-arrow-down-up"></i></th>
          <th class="sortable" data-campo="name">Nombre <i class="bi bi-arrow-down-up"></i></th>
          <th class="sortable" data-campo="email">Correo <i class="bi bi-arrow-down-up"></i></th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <div class="d-flex justify-content-between mt-3 flex-wrap">
    <div class="mb-2">
      <input type="text" id="filtro" class="form-control" placeholder="Filtrar por nombre o correo...">
    </div>
    <nav>
      <ul class="pagination pagination-sm" id="paginacion"></ul>
    </nav>
  </div>
</div>

<div class="modal fade" id="modalUsuario" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalTitle">Nuevo Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formUsuario">
          <input type="hidden" id="usuarioId">
          <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" id="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" id="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" id="password" class="form-control" required>
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

  const tabla = document.querySelector('#tablaUsuarios tbody');
  const filtro = document.getElementById('filtro');
  const alerta = document.getElementById('alerta');
  const loader = document.getElementById('loader');
  const tablaContainer = document.getElementById('tablaContainer');
  let usuarios = [];
  let paginaActual = 1;
  const porPagina = 10;
  let ordenCampo = 'id';
  let ordenAsc = true;

  function mostrarAlerta(msg, tipo='success'){
    alerta.className=`alert alert-${tipo}`; alerta.textContent=msg;
    alerta.classList.remove('d-none'); setTimeout(()=>alerta.classList.add('d-none'),3000);
  }

  async function cargarUsuarios(){
    loader.classList.remove('d-none'); tablaContainer.classList.add('d-none');
    try{
      const res = await fetch(`${apiBase}usuarios`, { headers:{'Authorization':`Bearer ${token}`}});
      usuarios = await res.json(); renderTabla(); loader.classList.add('d-none'); tablaContainer.classList.remove('d-none');
    }catch{mostrarAlerta('Error al cargar usuarios','danger'); loader.classList.add('d-none');}
  }

  function renderTabla(){
    const filtroTexto=filtro.value.toLowerCase();
    let filtrados=usuarios.filter(u=>u.name?.toLowerCase().includes(filtroTexto)||u.email?.toLowerCase().includes(filtroTexto));
    filtrados=filtrados.sort((a,b)=>{
      const A=a[ordenCampo]?.toString().toLowerCase(); const B=b[ordenCampo]?.toString().toLowerCase();
      if(A<B)return ordenAsc?-1:1; if(A>B)return ordenAsc?1:-1; return 0;
    });
    const inicio=(paginaActual-1)*porPagina; const paginados=filtrados.slice(inicio,inicio+porPagina);
    tabla.innerHTML=paginados.map(u=>`
      <tr>
        <td>${u.id}</td><td>${u.name}</td><td>${u.email}</td>
        <td class="text-center">
          <button class="btn btn-sm btn-outline-success me-2 btnEditar" data-id="${u.id}"><i class="bi bi-pencil"></i></button>
          <button class="btn btn-sm btn-outline-danger btnEliminar" data-id="${u.id}"><i class="bi bi-trash"></i></button>
        </td>
      </tr>`).join('');
    renderPaginacion(filtrados.length);
  }

  function renderPaginacion(total){
    const totalPaginas=Math.ceil(total/porPagina);
    const paginacion=document.getElementById('paginacion');
    paginacion.innerHTML='';
    for(let i=1;i<=totalPaginas;i++){
      const li=document.createElement('li');
      li.className=`page-item ${i===paginaActual?'active':''}`;
      li.innerHTML=`<a class="page-link" href="#">${i}</a>`;
      li.addEventListener('click',e=>{e.preventDefault(); paginaActual=i; renderTabla();});
      paginacion.appendChild(li);
    }
  }

  filtro.addEventListener('input',renderTabla);
  document.querySelectorAll('.sortable').forEach(th=>th.addEventListener('click',()=>{const c=th.dataset.campo;if(ordenCampo===c)ordenAsc=!ordenAsc;else{ordenCampo=c;ordenAsc=true;}renderTabla();}));

  document.getElementById('btnNuevo').addEventListener('click',()=>{
    document.getElementById('formUsuario').reset();
    document.getElementById('usuarioId').value='';
    document.getElementById('modalTitle').textContent='Nuevo Usuario';
    new bootstrap.Modal('#modalUsuario').show();
  });

  document.getElementById('btnGuardar').addEventListener('click',async()=>{
    const id=document.getElementById('usuarioId').value;
    const name=document.getElementById('name').value.trim();
    const email=document.getElementById('email').value.trim();
    const password=document.getElementById('password').value.trim();
    if(!name||!email||!password)return mostrarAlerta('Todos los campos son obligatorios','warning');
    const method=id?'PUT':'POST';
    const url=id?`${apiBase}usuarios/${id}`:`${apiBase}usuarios`;
    const body=id?{name,email}:{name,email,password};
    try{
      const res=await fetch(url,{method,headers:{'Content-Type':'application/json','Authorization':`Bearer ${token}`},body:JSON.stringify(body)});
      if(res.ok){await cargarUsuarios(); bootstrap.Modal.getInstance(document.getElementById('modalUsuario')).hide(); mostrarAlerta('Guardado exitosamente');}
      else mostrarAlerta('Error al guardar','danger');
    }catch{mostrarAlerta('Error al guardar','danger');}
  });

  document.addEventListener('click',e=>{
    if(e.target.closest('.btnEditar')){
      const id=e.target.closest('.btnEditar').dataset.id;
      const u=usuarios.find(x=>x.id==id);
      document.getElementById('usuarioId').value=u.id;
      document.getElementById('name').value=u.name;
      document.getElementById('email').value=u.email;
      document.getElementById('password').value='';
      document.getElementById('modalTitle').textContent='Editar Usuario';
      new bootstrap.Modal('#modalUsuario').show();
    }
  });

  document.addEventListener('click',async e=>{
    if(e.target.closest('.btnEliminar')){
      if(confirm('¿Eliminar este usuario?')){
        const id=e.target.closest('.btnEliminar').dataset.id;
        await fetch(`${apiBase}usuarios/${id}`,{method:'DELETE',headers:{'Authorization':`Bearer ${token}`}});
        await cargarUsuarios(); mostrarAlerta('Usuario eliminado');
      }
    }
  });

  await cargarUsuarios();
});
</script>
@endsection
