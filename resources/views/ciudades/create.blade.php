@extends('layouts.app')

@section('title', 'Crear Ciudad')

@section('content')
<h2>Crear Nueva Ciudad</h2>

<form action="{{ route('ciudades.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nombre de la Ciudad</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>País</label>
        <select name="pais_id" class="form-control" required>
            <option value="">Seleccione un país</option>
            @foreach($paises as $pais)
                <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
</form>
@endsection
