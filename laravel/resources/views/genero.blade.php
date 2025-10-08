@extends('base.app')

@section('title', 'Géneros')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold mb-0"><i class="bi bi-gender-ambiguous"></i> Géneros</h2>
    <button class="btn btn-primary" id="btnNuevo"><i class="bi bi-plus-lg"></i> Nuevo</button>
  </div>

  <div id="alerta" class="alert d-none"></div>
  <div id="loader" class="text-center my-5">
    <div class="spinner-border text-primary"></div><p class="mt-2">Cargando géneros...</p>
  </div>

  <div class="table-responsive shadow-sm d-none" id="tablaContainer">
    <table class="table table-striped align-middle" id="tablaGeneros">
      <thead class="table-primary"><tr><th>ID</th><th>Nombre</th><th class="text-center">Acciones</th></tr></thead><tbody></tbody>
    </table>
  </div>

  <div class="d-flex justify-content-between mt-3 flex-wrap">
    <input type="text" id="filtro" class="form-control w-auto" placeholder="Filtrar...">
    <nav><ul class="pagination pagination-sm" id="paginacion"></ul></nav>
  </div>
</div>

<div class="modal fade" id="modalGenero" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header bg-primary text-white">
      <h5 class="modal-title" id="modalTitle">Nuevo Género</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
      <form id="formGenero">
        <input type="hidden" id="generoId">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" id="nombre" class="form-control" required>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      <button class="btn btn-primary" id="btnGuardar">Guardar</button>
    </div>
  </div></div>
</div>

<script>
document.addEventListener('DOMContentLoaded',async()=>{
  const apiBase='http://localhost:8080/api/';
  const token=localStorage.getItem('token');
  if(!token)return location='/login';
  const tabla=document.querySelector('#tablaGeneros tbody'),filtro=document.getElementById('filtro'),
        alerta=document.getElementById('alerta'),loader=document.getElementById('loader'),tablaContainer=document.getElementById('tablaContainer');
  let generos=[],paginaActual=1,porPagina=10;
  function alertMsg(m,t='success'){alerta.className=`alert alert-${t}`;alerta.textContent=m;alerta.classList.remove('d-none');setTimeout(()=>alerta.classList.add('d-none'),3000);}
  async function cargar(){loader.classList.remove('d-none');tablaContainer.classList.add('d-none');
    try{const res=await fetch(`${apiBase}generos`,{headers:{'Authorization':`Bearer ${token}`}});
      generos=await res.json();render();loader.classList.add('d-none');tablaContainer.classList.remove('d-none');
    }catch{alertMsg('Error al cargar','danger');loader.classList.add('d-none');}}
  function render(){const f=filtro.value.toLowerCase();
    const filtrados=generos.filter(g=>g.nombre.toLowerCase().includes(f));
    const ini=(paginaActual-1)*porPagina;const pag=filtrados.slice(ini,ini+porPagina);
    tabla.innerHTML=pag.map(g=>`<tr><td>${g.id}</td><td>${g.nombre}</td><td class='text-center'>
      <button class='btn btn-sm btn-outline-success me-2 btnEditar' data-id='${g.id}'><i class='bi bi-pencil'></i></button>
      <button class='btn btn-sm btn-outline-danger btnEliminar' data-id='${g.id}'><i class='bi bi-trash'></i></button></td></tr>`).join('');
    const total=Math.ceil(filtrados.length/porPagina);const paginacion=document.getElementById('paginacion');
    paginacion.innerHTML='';for(let i=1;i<=total;i++){const li=document.createElement('li');
      li.className=`page-item ${i===paginaActual?'active':''}`;li.innerHTML=`<a class='page-link' href='#'>${i}</a>`;
      li.addEventListener('click',e=>{e.preventDefault();paginaActual=i;render();});paginacion.appendChild(li);}
  }
  filtro.addEventListener('input',render);
  document.getElementById('btnNuevo').addEventListener('click',()=>{document.getElementById('formGenero').reset();document.getElementById('generoId').value='';
    document.getElementById('modalTitle').textContent='Nuevo Género';new bootstrap.Modal('#modalGenero').show();});
  document.getElementById('btnGuardar').addEventListener('click',async()=>{
    const id=document.getElementById('generoId').value;const nombre=document.getElementById('nombre').value.trim();
    if(!nombre)return alertMsg('Campo obligatorio','warning');
    const method=id?'PUT':'POST';const url=id?`${apiBase}generos/${id}`:`${apiBase}generos`;
    const res=await fetch(url,{method,headers:{'Content-Type':'application/json','Authorization':`Bearer ${token}`},body:JSON.stringify({nombre})});
    if(res.ok){await cargar();bootstrap.Modal.getInstance(document.getElementById('modalGenero')).hide();alertMsg('Guardado exitosamente');}
    else alertMsg('Error','danger');
  });
  document.addEventListener('click',e=>{
    if(e.target.closest('.btnEditar')){const id=e.target.closest('.btnEditar').dataset.id;const g=generos.find(x=>x.id==id);
      document.getElementById('generoId').value=g.id;document.getElementById('nombre').value=g.nombre;
      document.getElementById('modalTitle').textContent='Editar Género';new bootstrap.Modal('#modalGenero').show();}
  });
  document.addEventListener('click',async e=>{
    if(e.target.closest('.btnEliminar')){if(confirm('¿Eliminar?')){const id=e.target.closest('.btnEliminar').dataset.id;
      await fetch(`${apiBase}generos/${id}`,{method:'DELETE',headers:{'Authorization':`Bearer ${token}`}});
      await cargar();alertMsg('Eliminado');}}
  });
  await cargar();
});
</script>
@endsection
