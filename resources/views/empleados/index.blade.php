@extends('layouts.app')

@section('title', 'Lista de Empleados')

@section('content')
<div class="mb-4" style="max-width: 100%; margin: 0 auto;">
    <h2 class="mb-4">Empleados</h2>
    <div class="d-flex justify-content-between mb-4">
        <div>
            <span class="me-3" style="cursor: pointer; font-weight: 500; color: rgb(69, 48, 218)">
                <i class="fas fa-trash me-2"></i> Borrar selección
            </span>
            <span class="me-3" style="cursor: pointer; font-weight: 500; color: rgb(69, 48, 218)">
                <i class="fas fa-download me-2"></i> Descargar datos
            </span>
        </div>
        <button type="button" class="btn btn-outline-primary shadow-sm" 
        style="border-radius: 18px;" data-bs-toggle="modal" data-bs-target="#modalAgregarEmpleado">
        <i class="fa fa-user-plus" aria-hidden="true"></i> <b>Agregar</b>
        </button>
        {{-- <a href="{{ route('empleados.create') }}" class="btn btn-outline-primary shadow-sm" style="border-radius: 18px;"  data-bs-toggle="modal" data-bs-target="#agregarEmpleadoModal">
            <i class="fa fa-user-plus" aria-hidden="true"></i> <b>Agregar</b>
        </a> --}}
    </div>

    <div class="table-responsive" style="overflow-x: auto; border-radius: 15px;">
        <table class="table table-hover text-center align-middle shadow-sm">
            <thead style="background-color: #1D3557; color: #ffffff;">
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Nombre Completo
                        <div><input type="text" class="form-control form-control-sm mt-2  border-secondary" style="border-radius: 10px; text-align: center;" placeholder="🔍 Buscar"></div>
                    </th>
                    <th>Identificación
                        <div><input type="text" class="form-control form-control-sm mt-2  border-secondary" style="border-radius: 10px; text-align: center;" placeholder="🔍 Buscar"></div>
                    </th>
                    <th>Teléfono
                        <div><input type="text" class="form-control form-control-sm mt-2  border-secondary" style="border-radius: 10px; text-align: center;" placeholder="🔍 Buscar"></div>
                    </th>
                    <th>Dirección
                        <div><input type="text" class="form-control form-control-sm mt-2  border-secondary" style="border-radius: 10px; text-align: center;" placeholder="🔍 Buscar"></div>
                    </th>
                    <th>Ciudad
                        <div><input type="text" class="form-control form-control-sm mt-2  border-secondary" style="border-radius: 10px; text-align: center;" placeholder="🔍 Buscar"></div>
                    </th>
                    <th>Cargos
                        <div><input type="text" class="form-control form-control-sm mt-2  border-secondary" style="border-radius: 10px; text-align: center;" placeholder="🔍 Buscar"></div>
                    </th>
                    <th>Jefe Asignado
                        <div><input type="text" class="form-control form-control-sm mt-2  border-secondary" style="border-radius: 10px; text-align: center;" placeholder="🔍 Buscar"></div>
                    </th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                    <tr class="bg-light" style="border-radius: 1px solid #dee2e6;">
                        <td><input type="checkbox"></td>
                        <td class="text-start text-break">{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
                        <td class="text-break">{{ $empleado->identificacion }}</td>
                        <td class="text-break">{{ $empleado->telefono }}</td>
                        <td class="text-break">{{ $empleado->direccion }}</td>
                        <td class="text-break">{{ $empleado->ciudad->nombre }}</td>
                        <td class="text-break">
                            @foreach($empleado->cargos as $cargo)
                                <span class="badge bg-secondary bg-primary m-1">{{ $cargo->nombre }}</span>
                            @endforeach
                        </td>
                        <td class="text-break">
                            @if($empleado->cargos->contains('nombre', 'Presidente') || is_null($empleado->jefe))
                                <span class="badge bg-secondary">N/A</span>
                            @else
                                {{ $empleado->jefe->nombres }} {{ $empleado->jefe->apellidos }}
                            @endif
                        </td>
                        <td class="d-flex justify-content-center align-items-center flex-wrap gap-2" style="height: 100%;">
                            <a href="#" 
                                class="btn btn-edit" 
                                style="min-width: 50px; color: rgb(69, 48, 218);" 
                                data-id="{{ $empleado->id }}"
                                data-nombres="{{ $empleado->nombres }}"
                                data-apellidos="{{ $empleado->apellidos }}"
                                data-identificacion="{{ $empleado->identificacion }}"
                                data-telefono="{{ $empleado->telefono }}"
                                data-direccion="{{ $empleado->direccion }}"
                                data-pais-id="{{ $empleado->pais_id }}"
                                data-ciudad-id="{{ $empleado->ciudad_id }}"
                                data-jefe-id="{{ $empleado->jefe ? $empleado->jefe->id : '' }}"
                                data-cargos='@json($empleado->cargos->pluck("id"))'
                                data-es-presidente="{{ $empleado->cargos->contains('nombre', 'Presidente') ? 'true' : 'false' }}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                            <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn" style="min-width: 50px; color: rgb(69, 48, 218);" onclick="return confirm('¿Eliminar este empleado?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mt-3">
    <div>
        Mostrando {{ $empleados->firstItem() }} - {{ $empleados->lastItem() }} 
        de {{ $empleados->total() }} resultados
    </div>
    {{ $empleados->links() }}
</div>

<!-- MODAL PARA EDITAR EMPLEADO -->
<div class="modal fade" id="modalEditarEmpleado" tabindex="-1" aria-labelledby="modalEditarEmpleadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-white">
           <h5 class="modal-title" id="modalEditarEmpleadoLabel">Editar Empleado</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
           <form id="formEditarEmpleado" method="POST">
             @csrf
             @method('PUT')
             
             <div class="row">
                <div class="col-md-6">
                   <label>Nombres</label>
                   <input type="text" name="nombres" id="edit_nombres" class="form-control" style="border-radius: 18px;" required>
                </div>
                <div class="col-md-6">
                   <label>Apellidos</label>
                   <input type="text" name="apellidos" id="edit_apellidos" class="form-control" style="border-radius: 18px;"required>
                </div>
             </div>
             
             <div class="row mt-3">
                <div class="col-md-6">
                   <label>Identificación</label>
                   <input type="text" name="identificacion" id="edit_identificacion" class="form-control" style="border-radius: 18px;" required>
                </div>
                <div class="col-md-6">
                   <label>Teléfono</label>
                   <input type="text" name="telefono" id="edit_telefono" class="form-control" style="border-radius: 18px;" required>
                </div>
             </div>
             
             <div class="row mt-3">
                <div class="col-md-6">
                   <label>País</label>
                   <select name="pais_id" id="edit_pais" class="form-control" style="border-radius: 18px;" required>
                      <option value="">Seleccione un país</option>
                      @foreach($paises as $pais)
                        <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                      @endforeach
                   </select>
                </div>
                <div class="col-md-6">
                   <label>Ciudad</label>
                   <select name="ciudad_id" id="edit_ciudad" class="form-control" style="border-radius: 18px;" required>
                      <option value="">Seleccione una ciudad</option>
                   </select>
                </div>
             </div>
             
             <div class="row mt-3">
                <div class="col-md-6">
                   <label>Dirección</label>
                   <input type="text" name="direccion" id="edit_direccion" class="form-control" style="border-radius: 18px;" required>
                </div>
             </div>

         
             
             <div class="form-group mt-3">
                <label for="edit_jefe_id">Asignar jefe</label>
                <select name="jefe_id" id="edit_jefe_id" class="form-control" style="border-radius: 18px;">
                   <option value="">Seleccione un Jefe </option>
                   @foreach ($jefes as $jefe)
                     @if (!$jefe->cargos->contains('nombre', 'Presidente'))
                        <option value="{{ $jefe->id }}">
                            {{ $jefe->nombres }} {{ $jefe->apellidos }}
                        </option>
                     @endif
                   @endforeach
                </select>
             </div>
             
             <div class="row mt-3">
                <div class="col-md-12">
                   <label>Cargos</label>
                   <select name="cargos[]" id="edit_cargos" class="form-control" style="border-radius: 18px;" multiple required>
                     @foreach($cargos as $cargo)
                        <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                     @endforeach
                   </select>
                </div>
             </div>
             
             <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-secondary" style="border-radius: 18px;">Actualizar</button>
                <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal" style="border-radius: 18px;">Cancelar</button>
             </div>
           </form>
        </div>
      </div>
    </div>
  </div>

 <!-- MODAL PARA AGREGAR UN NUEVO EMPLEADO -->
<div class="modal fade" id="modalAgregarEmpleado" tabindex="-1" aria-labelledby="modalAgregarEmpleadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="modalAgregarEmpleadoLabel">Nuevo empleado</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('empleados.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <label>Nombres</label>
                            <input type="text" name="nombres" class="form-control" style="border-radius: 18px;" required>
                        </div>
                        <div class="col-md-6">
                            <label>Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" style="border-radius: 18px;" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Identificación</label>
                            <input type="text" name="identificacion" class="form-control" style="border-radius: 18px;" required>
                        </div>
                        <div class="col-md-6">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control" style="border-radius: 18px;">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Dirección</label>
                            <input type="text" name="direccion" class="form-control" style="border-radius: 18px;">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="jefe_id">Asignar jefe</label>
                            <select name="jefe_id" id="jefe_id" class="form-control" style="border-radius: 18px;">
                                <option value="">Seleccione un Jefe</option>
                                @foreach ($jefes as $jefe)
                                    @if (!$jefe->cargos->contains('nombre', 'Presidente'))
                                        <option value="{{ $jefe->id }}">
                                            {{ $jefe->nombres }} {{ $jefe->apellidos }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Ciudad de Nacimiento</label>
                            <select name="ciudad_id" id="ciudad" class="form-control" style="border-radius: 18px;" required>
                                <option value="">Seleccione un país primero</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>País de Nacimiento</label>
                            <select name="pais_id" id="pais" class="form-control" style="border-radius: 18px;" required>
                                <option value="">Seleccione un país</option>
                                @foreach($paises as $pais)
                                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="cargos">Asignar Cargos</label>
                        <select name="cargos[]" id="cargos" class="form-control" style="border-radius: 18px;" multiple>
                            @foreach ($cargos as $cargo)
                                <option value="{{ $cargo->id }}">
                                    {{ $cargo->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Puedes seleccionar más de un cargo manteniendo presionada la tecla Ctrl (Cmd en Mac).</small>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-secondary text-white" style="border-radius: 18px;">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('pais').addEventListener('change', function() {
        let paisId = this.value;
        let ciudadSelect = document.getElementById('ciudad');

        if (!paisId) {
            ciudadSelect.innerHTML = '<option value="">Seleccione un país primero</option>';
            return;
        }

        ciudadSelect.innerHTML = '<option value="">Cargando...</option>';

        fetch(`/api/ciudades/${paisId}`)
            .then(response => response.json())
            .then(data => {
                ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                data.forEach(ciudad => {
                    ciudadSelect.innerHTML += `<option value="${ciudad.id}">${ciudad.nombre}</option>`;
                });
            })
            .catch(error => {
                console.error("Error cargando ciudades:", error);
                ciudadSelect.innerHTML = '<option value="">Error al cargar ciudades</option>';
            });
    });
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
          const editButtons = document.querySelectorAll('.btn-edit');

          const modalEl = document.getElementById('modalEditarEmpleado');
          const modalEditar = new bootstrap.Modal(modalEl);
        
          editButtons.forEach(button => {
            button.addEventListener('click', function(e) {
              e.preventDefault();

              const id             = this.getAttribute('data-id');
              const nombres        = this.getAttribute('data-nombres');
              const apellidos      = this.getAttribute('data-apellidos');
              const identificacion = this.getAttribute('data-identificacion');
              const telefono       = this.getAttribute('data-telefono');
              const direccion      = this.getAttribute('data-direccion');
              const paisId         = this.getAttribute('data-pais-id');
              const ciudadId       = this.getAttribute('data-ciudad-id');
              const jefeId         = this.getAttribute('data-jefe-id');
              const cargos         = JSON.parse(this.getAttribute('data-cargos'));
              
              // Saber si es Presidente
              const esPresidente   = this.getAttribute('data-es-presidente') === 'true';
        
              document.getElementById('edit_nombres').value = nombres;
              document.getElementById('edit_apellidos').value = apellidos;
              document.getElementById('edit_identificacion').value = identificacion;
              document.getElementById('edit_telefono').value = telefono;
              document.getElementById('edit_direccion').value = direccion;
        
              const editPais = document.getElementById('edit_pais');
              editPais.value = paisId;
        
              const editCiudad = document.getElementById('edit_ciudad');
              if (paisId) {
                editCiudad.innerHTML = '<option value="">Cargando...</option>';
                fetch(`/api/ciudades/${paisId}`)
                    .then(response => response.json())
                    .then(data => {
                        editCiudad.innerHTML = '<option value="">Seleccione una ciudad</option>';
                        data.forEach(ciudad => {
                            const option = document.createElement('option');
                            option.value = ciudad.id;
                            option.textContent = ciudad.nombre;
                            editCiudad.appendChild(option);
                        });
                        editCiudad.value = ciudadId;
                    })
                    .catch(error => {
                        console.error("Error al cargar ciudades:", error);
                        editCiudad.innerHTML = '<option value="">Error al cargar ciudades</option>';
                    });
              } else {
                editCiudad.innerHTML = '<option value="">Seleccione un país primero</option>';
              }
        
              const editJefe = document.getElementById('edit_jefe_id');
              editJefe.value = jefeId;
        
              const editCargos = document.getElementById('edit_cargos');
              Array.from(editCargos.options).forEach(option => option.selected = false);
              cargos.forEach(cargoId => {
                const option = editCargos.querySelector(`option[value="${cargoId}"]`);
                if(option) option.selected = true;
              });
    
              if (esPresidente) {
                editJefe.addEventListener('change', function() {
                    if (editJefe.value !== '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Acción no permitida',
                        text: 'No se puede asignar un jefe a un Presidente.'
                    }).then(() => {
                        editJefe.value = '';
                        modalEditar.hide();
                    });
                    }
                }, { once: true });
                }
        
              // Actualizar la ruta del formulario
              const form = document.getElementById('formEditarEmpleado');
              form.action = `/empleados/${id}`;
        
              // Mostrar el modal
              const modalEl = document.getElementById('modalEditarEmpleado');
              const modalEditar = new bootstrap.Modal(modalEl);
              modalEditar.show();
            });
          });
        });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection 
