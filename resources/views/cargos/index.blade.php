@extends('layouts.app')

@section('title', 'Lista de Cargos')

@section('content')
<div class="mb-4" style="max-width: 100%; margin: 0 auto;">
    <h2 class="mb-4">Cargos</h2>
    <div class="d-flex justify-content-between mb-4">
        <div>
            <span class="me-3" style="cursor: pointer; font-weight: 500; color: rgb(69, 48, 218)">
                <i class="fas fa-download me-2"></i> Descargar datos
            </span>
        </div>
        {{-- <a href="{{ route('cargos.create') }}" class="btn btn-outline-primary shadow-sm" style="border-radius: 18px;">
            <i class="fa fa-plus" aria-hidden="true"></i> <b>Agregar</b>
        </a> --}} 
        <button type="button" class="btn btn-outline-primary shadow-sm" style="border-radius: 18px;" data-bs-toggle="modal" data-bs-target="#modalAgregarCargo">
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
                                   style="border-radius: 10px; text-align: center;" placeholder="🔍 Buscar">
                        </div>
                    </th>
                    <th>Nombre del Cargo
                        <div>
                            <input type="text" class="form-control form-control-sm mt-2 border-secondary" 
                                   style="border-radius: 10px; text-align: center;" placeholder="🔍 Buscar">
                        </div>
                    </th>
                    <th>Empleados Asociados
                        <div>
                            <input type="text" class="form-control form-control-sm mt-2 border-secondary" 
                                   style="border-radius: 10px; text-align: center;" placeholder="🔍 Buscar">
                        </div>
                    </th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($cargos as $cargo)
                    <tr class="bg-light">
                        <td>{{ $cargo->id }}</td>
                        <td>{{ $cargo->nombre }}</td>
                        <td>{{ $cargo->empleados->count() }}</td>
                        <td class="d-flex justify-content-center align-items-center flex-wrap gap-2" style="height: 100%;">
                            <a href="#"
                            class="btn btn-edit"
                            style="min-width: 50px; color: rgb(69, 48, 218);"
                            data-id="{{ $cargo->id }}"
                            data-nombre="{{ $cargo->nombre }}">
                             <i class="fa fa-pencil" aria-hidden="true"></i>
                         </a>
                            <form action="{{ route('cargos.destroy', $cargo) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <a class="btn" style="min-width: 50px; color:rgb(69, 48, 218);" 
                                   onclick="return confirm('¿Eliminar este cargo?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL PARA AGREGAR UN NUEVO CARGO -->
<div class="modal fade" id="modalAgregarCargo" tabindex="-1" aria-labelledby="modalAgregarCargoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="modalAgregarCargoLabel">Nuevo Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cargos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Nombre del Cargo</label>
                        <input type="text" name="nombre" class="form-control" style="border-radius: 18px;" required>
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

<!-- MODAL PARA EDITAR CARGO -->
<div class="modal fade" id="modalEditarCargo" tabindex="-1" aria-labelledby="modalEditarCargoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="modalEditarCargoLabel">Editar Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarCargo" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label>Nombre del Cargo</label>
                        <input type="text" name="nombre" id="edit_cargo_nombre" class="form-control" style="border-radius: 18px;" required>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary" style="border-radius: 18px;">Actualizar</button>
                        <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal" style="border-radius: 18px;">Cancelar</button>
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
            
                document.getElementById('edit_cargo_nombre').value = nombre;
                
                const form = document.getElementById('formEditarCargo');
                form.action = `/cargos/${id}`;
                
                const modalEl = document.getElementById('modalEditarCargo');
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            });
        });
    });
    </script>
    

@endsection
