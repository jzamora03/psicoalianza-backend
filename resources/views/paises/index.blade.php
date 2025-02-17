@extends('layouts.app')

@section('title', 'Lista de Países')

@section('content')
<div class="mb-4" style="max-width: 100%; margin: 0 auto;">
    <h2 class="mb-4">Países</h2>
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
                style="border-radius: 18px;" data-bs-toggle="modal" data-bs-target="#modalAgregarPais">
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
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paises as $pais)
                    <tr class="bg-light">
                        <td>{{ $pais->id }}</td>
                        <td>{{ $pais->nombre }}</td>
                        <td class="d-flex justify-content-center align-items-center gap-2">
                            <a href="#" class="btn-edit" 
                               style="color: rgb(69, 48, 218); text-decoration: none; font-size: 1.2rem;" 
                               data-id="{{ $pais->id }}"
                               data-nombre="{{ $pais->nombre }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <form action="{{ route('paises.destroy', $pais) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" 
                                        style="background: none; border: none; padding: 0; color: rgb(69, 48, 218); font-size: 1.2rem;"
                                        onclick="return confirm('¿Eliminar este país?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $paises->links() }}
    </div>
</div>

<!-- MODAL PARA AGREGAR UN NUEVO PAÍS -->
<div class="modal fade" id="modalAgregarPais" tabindex="-1" aria-labelledby="modalAgregarPaisLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="modalAgregarPaisLabel">Nuevo País</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('paises.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Nombre del País</label>
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

<!-- MODAL PARA EDITAR PAÍS -->
<div class="modal fade" id="modalEditarPais" tabindex="-1" aria-labelledby="modalEditarPaisLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="modalEditarPaisLabel">Editar País</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarPais" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Nombre del País</label>
                        <input type="text" name="nombre" id="edit_pais_nombre" class="form-control" style="border-radius: 18px;" required>
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
            
            document.getElementById('edit_pais_nombre').value = nombre;
            
            const form = document.getElementById('formEditarPais');
            form.action = `/paises/${id}`;
            
            const modalEl = document.getElementById('modalEditarPais');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        });
    });
});
</script>
@endsection
