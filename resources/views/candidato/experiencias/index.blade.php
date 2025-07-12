@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Experiencias Laborales</h1>
        <a href="{{ route('candidato.experiencias.create') }}" class="btn btn-primary mb-3">Agregar Experiencia</a>
        <hr>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <br>
        @if ($experiencias->isEmpty())
            <div class="alert alert-info">No hay experiencias registradas.</div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Cargo</th>
                        <th>Empresa</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($experiencias as $experiencia)
                        <tr>
                            <td>{{ $experiencia->cargo }}</td>
                            <td>{{ $experiencia->empresa }}</td>
                            <td>{{ $experiencia->fechaInicio }}</td>
                            <td>{{ $experiencia->fechaFin ?? 'Actual' }}</td>
                            <td>
                                <a href="{{ route('candidato.experiencias.edit', $experiencia->id) }}"
                                    class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('candidato.experiencias.destroy', $experiencia->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Seguro que deseas eliminar esta experiencia?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
