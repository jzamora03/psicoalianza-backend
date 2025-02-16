@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Lista de Ciudades</h4>
            <a href="{{ route('ciudades.create') }}" class="btn btn-light">+ Agregar Ciudad</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>País</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ciudades as $ciudad)
                        <tr>
                            <td>{{ $ciudad->id }}</td>
                            <td>{{ $ciudad->nombre }}</td>
                            <td>{{ $ciudad->pais->nombre ?? 'Sin País' }}</td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
