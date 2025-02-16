@extends('layouts.app')

@section('title', 'Lista de Cargos')

@section('content')
<div class="d-flex justify-content-between">
    <h2>Lista de Cargos</h2>
    <a href="{{ route('cargos.create') }}" class="btn btn-success">+ Agregar Cargo</a>
</div>

<table class="table table-hover mt-3">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Nombre del Cargo</th>
            <th>Empleados Asociados</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cargos as $cargo)
            <tr>
                <td>{{ $cargo->id }}</td>
                <td>{{ $cargo->nombre }}</td>
                <td>{{ $cargo->empleados->count() }}</td>
                <td>
                    <a href="{{ route('cargos.edit', $cargo) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('cargos.destroy', $cargo) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este cargo?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
