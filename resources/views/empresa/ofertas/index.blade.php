@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestión de Ofertas Laborales</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('empresa.ofertas.create') }}" class="btn btn-primary">Crear Nueva Oferta</a>
        </div>
 
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profesión</th>
                    <th>Cargo Vacante</th>
                    <th>Salario Ofrecido</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ofertasLaborales as $oferta)
                    <tr>
                        <td>{{ $oferta->id }}</td>
                        {{-- Accedemos a la relación 'profesion' y luego a su campo 'descripcion' --}}
                        <td>{{ $oferta->profesion->descripcion ?? 'N/A' }}</td>
                        <td>{{ $oferta->cargo }}</td>
                        <td>${{ number_format($oferta->salario, 2, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $oferta->estatus ? 'bg-success' : 'bg-danger' }}">
                                {{ $oferta->estatus_texto }}
                            </span>
                            {{-- Formulario para cambiar estatus --}}
                             <form action="{{ route('empresa.ofertas.toggleStatus', $oferta) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $oferta->estatus ? 'btn-warning' : 'btn-success' }}">
                                    {{ $oferta->estatus ? 'Desactivar' : 'Activar' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('empresa.ofertas.edit', $oferta) }}" class="btn btn-info btn-sm">Editar</a>
                            <form action="{{ route('empresa.ofertas.destroy', $oferta) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta oferta?')">Eliminar</button>
                            </form> 
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay ofertas laborales publicadas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection