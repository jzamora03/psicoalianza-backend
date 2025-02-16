@extends('layouts.app')

@section('title', 'Nuevo Empleado')

@section('content')
<h2>Agregar Nuevo Empleado</h2>

<form action="{{ route('empleados.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <label>Nombres</label>
            <input type="text" name="nombres" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label>Apellidos</label>
            <input type="text" name="apellidos" class="form-control" required>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label>Identificación</label>
            <input type="text" name="identificacion" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control">
        </div>
        <div class="col-md-6">
            <label>País de Nacimiento</label>
            <select name="pais_id" id="pais" class="form-control">
                <option value="">Seleccione un país</option>
                @foreach($paises as $pais)
                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label>Ciudad de Nacimiento</label>
            <select name="ciudad_id" id="ciudad" class="form-control" required>
                <option value="">Seleccione un país primero</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>Cargos</label>
            <select name="cargos[]" class="form-control" multiple>
                @foreach($cargos as $cargo)
                    <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
</form>


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
    .then(response => {
        console.log("Respuesta cruda:", response);
        return response.text(); // <-- Cambiar a text() temporalmente para ver qué devuelve
    })
    .then(text => {
        console.log("Texto recibido:", text); // <-- Imprime la respuesta en consola
        return JSON.parse(text); // <-- Luego lo convierte a JSON
    })
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

@endsection
