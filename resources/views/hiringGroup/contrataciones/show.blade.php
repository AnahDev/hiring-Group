@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Postulantes para la oferta: {{ $ofertaLaboral->cargo }}</h2>

        <div style="margin-bottom:1.5rem";><a href="{{ route('hiringGroup.ofertas.index') }}" class="btn-action">
                &larr;Volver</a>
        </div>

        @if ($ofertaLaboral->postulaciones->count())
            <table class="table table-container">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Profesión</th>
                        <th>Perfil</th>
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
                                @endif
                            </td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    <li><strong>Nombre:</strong> {{ $postulacion->candidato->nombre }}
                                        {{ $postulacion->candidato->apellido }}</li>
                                    <li>
                                        <strong>Teléfono(s):</strong>
                                        @if ($postulacion->candidato && $postulacion->candidato->telefonos->isNotEmpty())
                                            <ul>
                                                @foreach ($postulacion->candidato->telefonos as $telefono)
                                                    <li>{{ $telefono->numero }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            -
                                        @endif
                                    </li>
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
                                <a href="{{ route('hiringGroup.contratacion.create', $postulacion) }}" class="btn-action">
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


    </div>
@endsection
