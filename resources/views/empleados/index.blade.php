@extends('layouts.app')

@section('title', 'Lista de Empleados')

@section('content')
<div class="d-flex justify-content-between">
    <h2>Lista de Empleados</h2>
    <a href="{{ route('empleados.create') }}" class="btn btn-success">+ Agregar Empleado</a>
</div>

<table class="table table-hover mt-3">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Identificación</th>
            <th>Teléfono</th>
            <th>Ciudad</th>
            <th>Cargos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
                <td>{{ $empleado->identificacion }}</td>
                <td>{{ $empleado->telefono }}</td>
                <td>{{ $empleado->ciudad->nombre }}</td>
                <td>
                    @foreach($empleado->cargos as $cargo)
                        <span class="badge bg-info">{{ $cargo->nombre }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este empleado?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
