@extends('layouts.app')

@section('content')
    <h1>Ofertas Laborales</h1>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Profesión</th>
                <th>Cargo</th>
                <th>Descripción</th>
                <th>Salario</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ofertasLaborales as $oferta)
                <tr>
                    <td>{{ $oferta->empresa->nombre ?? '-' }}</td>
                    <td>{{ $oferta->profesion->descripcion ?? '-' }}</td>
                    <td>{{ $oferta->cargo ?? '-' }}</td>
                    <td>{{ $oferta->descripcion ?? '-' }}</td>
                    <td>{{ $oferta->salario ?? '-' }}</td>
                    <td>{{ $oferta->estado ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
