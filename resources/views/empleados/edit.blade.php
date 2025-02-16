@extends('layouts.app')

@section('title', 'Editar Empleado')

@section('content')
<h2>Editar Empleado</h2>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
    @csrf @method('PUT')
    
    <div class="row">
        <div class="col-md-6">
            <label>Nombres</label>
            <input type="text" name="nombres" class="form-control" value="{{ $empleado->nombres }}" required>
        </div>
        <div class="col-md-6">
            <label>Apellidos</label>
            <input type="text" name="apellidos" class="form-control" value="{{ $empleado->apellidos }}" required>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label>Identificación</label>
            <input type="text" name="identificacion" class="form-control" value="{{ $empleado->identificacion }}" required>
        </div>
        <div class="col-md-6">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ $empleado->telefono }}" required>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label>País</label>
            <select name="pais_id" class="form-control" required>
                @foreach($paises as $pais)
                    <option value="{{ $pais->id }}" {{ $empleado->pais_id == $pais->id ? 'selected' : '' }}>
                        {{ $pais->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label>Ciudad</label>
            <select name="ciudad_id" class="form-control" required>
                @foreach($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}" {{ $empleado->ciudad_id == $ciudad->id ? 'selected' : '' }}>
                        {{ $ciudad->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ $empleado->direccion }}" required>
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
    <div class="row mt-3">
        <div class="col-md-12">
            <label>Cargos</label>
            <select name="cargos[]" class="form-control" multiple required>
                @foreach($cargos as $cargo)
                    <option value="{{ $cargo->id }}" 
                        {{ in_array($cargo->id, $empleado->cargos->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $cargo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>


    </div>

    <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
    <a href="{{ route('empleados.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const empleadoEsPresidente = @json($empleado->cargos->contains('nombre', 'Presidente'));
        if (empleadoEsPresidente) {
            Swal.fire({
                icon: 'warning',
                title: 'Acción no permitida',
                text: 'A esta persona no se le puede asignar un Jefe, ya que es el Presidente.',
                confirmButtonText: 'Entendido'
            });
        }
    });
</script>
@endsection
