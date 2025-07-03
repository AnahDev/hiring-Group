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

        {{--        <div class="mb-3">
            <a href="{{ route('empresa.ofertas.create') }}" class="btn btn-primary">Crear Nueva Oferta</a>
        </div> --}}
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profesión</th>
                    <th>Cargo Vacante</th>
                    <th>Salario Ofrecido</th>
                    <th>Ubicación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ofertasLaborales as $oferta)
                    <tr>
                        <td>{{ $oferta->id }}</td>
                        <td>{{ $oferta->profesion->descripcion ?? 'N/A' }}</td>
                        <td>{{ $oferta->cargo }}</td>
                        <td>${{ number_format($oferta->salario, 2, ',', '.') }}</td>
                        <th>{{ $oferta->ubicacion }} </th>
                        <td>{{ $oferta->estado }}</td>
                        <td>
                            <form action="{{ route('empresa.ofertas.toggleStatus', $oferta) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm {{ $oferta->estado ? 'btn-warning' : 'btn-success' }}">
                                    {{ $oferta->estado ? 'Activar' : 'Desactivar' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('empresa.ofertas.edit', $oferta) }}" class="btn btn-info btn-sm">Editar</a>
                            <form action="{{ route('empresa.ofertas.destroy', $oferta) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar esta oferta?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
        </table>
    </div>
@endsection
