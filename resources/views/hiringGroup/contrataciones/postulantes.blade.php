@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Postulantes para la oferta: {{ $ofertaLaboral->cargo }}</h2>

        @if ($ofertaLaboral->postulaciones->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Profesión</th>
                        <th>Ver Perfil</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ofertaLaboral->postulaciones as $postulacion)
                        <tr>
                            <td>{{ $postulacion->candidato->nombre }} {{ $postulacion->candidato->apellido }}</td>
                            <td>{{ $postulacion->candidato->usuario->correo ?? '-' }}</td>
                            <td>
                                @if ($postulacion->candidato->candidatoProfesiones->count())
                                    {{ $postulacion->candidato->candidatoProfesiones->first()->profesion->descripcion }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    <li><strong>Nombre:</strong> {{ $postulacion->candidato->nombre }}
                                        {{ $postulacion->candidato->apellido }}</li>
                                    <li><strong>Teléfono:</strong> {{ $postulacion->candidato->telefono ?? '-' }}</li>
                                    <li><strong>Correo:</strong> {{ $postulacion->candidato->usuario->correo ?? '-' }}</li>
                                    <li><strong>Profesión:</strong>
                                        @if ($postulacion->candidato->candidatoProfesiones->count())
                                            {{ $postulacion->candidato->candidatoProfesiones->first()->profesion->descripcion }}
                                        @else
                                            -
                                        @endif
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <a href="{{ route('hiringGroup.contratacion.create', $postulacion) }}"
                                    class="btn btn-success btn-sm">
                                    Contratar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay postulantes para esta oferta.</p>
        @endif

        <a href="{{ route('hiringGroup.ofertas.index') }}" class="btn btn-secondary mt-3">Volver a Ofertas</a>
    </div>
@endsection
