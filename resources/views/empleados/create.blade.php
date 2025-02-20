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

        <div class="form-group mt-3">
            <label for="cargos">Asignar Cargos</label>
            <select name="cargos[]" id="cargos" class="form-control" multiple>
                @foreach ($cargos as $cargo)
                    <option value="{{ $cargo->id }}"
                        @if(isset($empleado) && $empleado->cargos->contains($cargo->id)) selected @endif>
                        {{ $cargo->nombre }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Puedes seleccionar más de un cargo manteniendo presionada la tecla Ctrl (Cmd en Mac).</small>
        </div>
    </div>

    <div class="form-group mt-3">
        <label for="jefe_id">Asignar jefe</label>
        <select name="jefe_id" id="jefe_id" class="form-control">
            <option value="">-- Seleccione un Jefe --</option>
            @foreach ($jefes as $jefe)
                @if (!$jefe->cargos->contains('nombre', 'Presidente'))
                    <option value="{{ $jefe->id }}" {{ old('jefe_id') == $jefe->id ? 'selected' : '' }}>
                        {{ $jefe->nombres }} {{ $jefe->apellidos }}
                    </option>
                @endif
            @endforeach
        </select>
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
        return response.text(); 
    })
    .then(text => {
        console.log("Texto recibido:", text);
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
