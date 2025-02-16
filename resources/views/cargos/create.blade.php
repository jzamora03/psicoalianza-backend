@extends('layouts.app')

@section('title', 'Nuevo Cargo')

@section('content')
<h2>Agregar Nuevo Cargo</h2>

<form action="{{ route('cargos.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nombre del Cargo</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('cargos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
