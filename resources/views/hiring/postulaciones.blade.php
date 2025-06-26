@extends('layouts.app')

@section('content')
    <h1>Postulaciones</h1>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>Candidato</th>
                <th>Profesión</th>
                <th>Oferta</th>
                <th>Empresa</th>
                <th>Fecha de Postulación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($postulaciones as $postulacion)
                <tr>
                    <td>{{ $postulacion->candidato->nombre ?? '-' }}</td>
                    <td>{{ $postulacion->ofertaLaboral->profesion->descripcion ?? '-' }}</td>
                    <td>{{ $postulacion->ofertaLaboral->cargo ?? '-' }}</td>
                    <td>{{ $postulacion->ofertaLaboral->empresa->nombre ?? '-' }}</td>
                    <td>{{ $postulacion->fechaPostulacion ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
