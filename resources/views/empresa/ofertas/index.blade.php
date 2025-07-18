@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Gestión de Ofertas Laborales</h2>

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

        <table class="table table-container">
            <thead>
                <tr>
                    {{-- <th>ID</th> --}}
                    <th>Profesión</th>
                    <th>Vacante</th>
                    <th>Salario</th>
                    <th>Ubicación</th>
                    <th>Estado</th>
                    <th style="width:auto;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ofertasLaborales as $oferta)
                    <tr>
                        {{-- <td>{{ $oferta->id }}</td> --}}
                        <td>{{ $oferta->profesion->descripcion ?? 'N/A' }}</td>
                        <td>{{ $oferta->cargo }}</td>
                        <td>${{ number_format($oferta->salario, 2, ',', '.') }}</td>
                        <td>{{ $oferta->ubicacion }} </th>
                        <td>{{ $oferta->estado }}</td>

                        <td>

                            <form action="{{ route('empresa.ofertas.toggleStatus', $oferta) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm {{ $oferta->estado ? 'btn-warning' : 'btn-success' }}"
                                    title="{{ $oferta->estado ? 'Cambiar estado' : 'Activar oferta' }}">
                                    &#8596;
                                </button>
                            </form>
                            <a href="{{ route('empresa.ofertas.edit', $oferta) }}" title="Editar" class="btn btn-info">
                                &#9998;</a>
                            <form action="{{ route('empresa.ofertas.destroy', $oferta) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar esta oferta?')"
                                    title="Eliminar">&#128465;</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
        </table>
    </div>
@endsection
