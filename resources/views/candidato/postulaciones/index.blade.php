@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Historial de Postulaciones</h2>
        <table class="table table-container">
            <thead>
                <tr>
                    <th>Oferta</th>
                    <th>Profesión</th>
                    <th>Cargo</th>
                    <th>Fecha </th>
                    <th>Estado</th>
                    <th>Ver Oferta</th>
                </tr>
            </thead>
            <tbody>
                @forelse($postulaciones as $postulacion)
                    <tr>
                        <td>{{ $postulacion->ofertaLaboral->id }}</td>
                        <td>{{ $postulacion->ofertaLaboral->profesion->descripcion ?? 'N/A' }}</td>
                        <td>{{ $postulacion->ofertaLaboral->cargo }}</td>
                        <td>{{ $postulacion->created_at->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($postulacion->estado ?? 'pendiente') }}</td>
                        <td>
                            <a href="{{ route('candidato.ofertas.show', $postulacion->ofertaLaboral->id) }}"
                                class="btn btn-info btn-sm">Ver Oferta</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No tienes postulaciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endsection
