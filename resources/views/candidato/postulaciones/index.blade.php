@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Historial de Postulaciones</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Oferta</th>
                    <th>Profesión</th>
                    <th>Cargo</th>
                    <th>Fecha de Postulación</th>
                    <th>Estado de la Postulación</th>
                    <th>Ver Oferta</th>
                </tr>
            </thead>
            <tbody>
                @forelse($postulaciones as $postulacion)
                    <tr>
                        <td>{{ $postulacion->oferta->id }}</td>
                        <td>{{ $postulacion->oferta->profesion->descripcion ?? 'N/A' }}</td>
                        <td>{{ $postulacion->oferta->cargo }}</td>
                        <td>{{ $postulacion->created_at->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($postulacion->estado ?? 'pendiente') }}</td>
                        <td>
                            <a href="{{ route('candidato.ofertas.show', $postulacion->oferta->id) }}"
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
