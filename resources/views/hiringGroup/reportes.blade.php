@extends('layouts.app')

@section('content')
    <h2>Reporte de Ofertas por Profesión</h2>
    <table class="table table-container">
        <thead>
            <tr>
                <th>Profesión</th>
                <th>Cantidad de Ofertas</th>
                <th>Empresas Participantes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reporte as $profesion)
                <tr>
                    <td>{{ $profesion->descripcion }}</td>
                    <td>{{ $profesion->ofertas_count }}</td>
                    <td>
                        {{ $profesion->ofertas->pluck('empresa.nombre')->unique()->implode(', ') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
