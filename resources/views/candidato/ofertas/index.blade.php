@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ofertas Laborales</h2>

        {{-- Filtros --}}
        @include('candidato.ofertas.parciales.filters')

        <table class="table table-container">
            <thead>
                <tr>
                    <th>Profesión</th>
                    <th>Cargo</th>
                    <th>Salario</th>
                    <th>Ubicación</th>
                    <th>Estado</th>
                    <th>Ver Detalles</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ofertas as $oferta)
                    <tr>
                        <td>{{ $oferta->profesion->descripcion ?? 'N/A' }}</td>
                        <td>{{ $oferta->cargo }}</td>
                        <td>${{ number_format($oferta->salario, 2, ',', '.') }}</td>
                        <td>{{ $oferta->ubicacion }}</td>
                        <td>{{ ucfirst($oferta->estado) }}</td>
                        <td>
                            <a href="{{ route('candidato.ofertas.show', $oferta->id) }}" class="btn btn-info btn-sm">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No hay ofertas disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
