@extends('layouts.app')

@section('content')
    <h1>Reporte de Ofertas por Profesión</h1>
    <table border="1" cellpadding="6" cellspacing="0">
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
