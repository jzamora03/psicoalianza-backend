@extends('layouts.app')

@section('title', 'Lista de Ciudades')

@section('content')
<div class="mb-4" style="max-width: 100%; margin: 0 auto;">
    <h2 class="mb-4">Ciudades</h2>
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
                style="border-radius: 18px;" data-bs-toggle="modal" data-bs-target="#modalAgregarCiudad">
            <i class="fa fa-plus" aria-hidden="true"></i> <b>Agregar</b>
        </button>
    </div>

    <div class="table-responsive" style="overflow-x: auto; border-radius: 15px;">
        <table class="table table-hover text-center align-middle shadow-sm">
            <thead style="background-color: #1D3557; color: #ffffff;">
                <tr>
                    <th>ID
                        <div>
                            <input type="text" class="form-control form-control-sm mt-2 border-secondary" 
                                   placeholder="🔍 Buscar" style="border-radius: 10px; text-align: center;">
                        </div>
                    </th>
                    <th>Nombre
                        <div>
                            <input type="text" class="form-control form-control-sm mt-2 border-secondary" 
                                   placeholder="🔍 Buscar" style="border-radius: 10px; text-align: center;">
                        </div>
                    </th>
                    <th>País
                        <div>
                            <input type="text" class="form-control form-control-sm mt-2 border-secondary" 
                                   placeholder="🔍 Buscar" style="border-radius: 10px; text-align: center;">
                        </div>
                    </th>
                    <th>Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ciudades as $ciudad)
                    <tr class="bg-light">
                        <td>{{ $ciudad->id }}</td>
                        <td>{{ $ciudad->nombre }}</td>
                        <td>{{ $ciudad->pais->nombre ?? 'Sin País' }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning btn-edit"
                               data-id="{{ $ciudad->id }}"
                               data-nombre="{{ $ciudad->nombre }}"
                               data-pais_id="{{ $ciudad->pais_id }}">
                                Editar
                            </a>
                            <form action="{{ route('ciudades.destroy', $ciudad) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('¿Eliminar esta ciudad?')">
                                    Eliminar
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
        Mostrando {{ $ciudades->firstItem() }} - {{ $ciudades->lastItem() }} 
        de {{ $ciudades->total() }} resultados
    </div>
    {{ $ciudades->links() }}
</div>

<!-- MODAL PARA AGREGAR UNA NUEVA CIUDAD -->
<div class="modal fade" id="modalAgregarCiudad" tabindex="-1" aria-labelledby="modalAgregarCiudadLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="modalAgregarCiudadLabel">Nueva Ciudad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ciudades.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" style="border-radius: 18px;" required>
                        </div>
                        <div class="col-md-6">
                            <label>País</label>
                            <select name="pais_id" class="form-control" style="border-radius: 18px;" required>
                                <option value="">Seleccione un país</option>
                                @foreach ($paises as $pais)
                                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary" style="border-radius: 18px;">Guardar</button>
                        <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal" style="border-radius: 18px;">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA EDITAR CIUDAD -->
<div class="modal fade" id="modalEditarCiudad" tabindex="-1" aria-labelledby="modalEditarCiudadLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="modalEditarCiudadLabel">Editar Ciudad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarCiudad" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nombre</label>
                            <input type="text" name="nombre" id="edit_ciudad_nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>País</label>
                            <select name="pais_id" id="edit_ciudad_pais" class="form-control" required>
                                <option value="">Seleccione un país</option>
                                @foreach($paises as $pais)
                                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-edit');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            const nombre = this.getAttribute('data-nombre');
            const pais_id = this.getAttribute('data-pais_id');
            
            document.getElementById('edit_ciudad_nombre').value = nombre;
            document.getElementById('edit_ciudad_pais').value = pais_id;
            
            const form = document.getElementById('formEditarCiudad');
            form.action = `/ciudades/${id}`;
            
            const modalEl = document.getElementById('modalEditarCiudad');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        });
    });
});
</script>
@endsection
