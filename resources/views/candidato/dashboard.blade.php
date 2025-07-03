@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Bienvenido, {{ $candidato->nombre ?? auth()->user()->name }}</h1>
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Información Personal</h4>
                <p><strong>Nombre:</strong> {{ $candidato->nombre ?? '-' }}</p>
                <p><strong>Apellido:</strong> {{ $candidato->apellido ?? '-' }}</p>
                <p><strong>Correo:</strong> {{ $candidato->usuario->correo ?? '-' }}</p>
                <p><strong>Dirección:</strong> {{ $candidato->direccion ?? '-' }}</p>
                <p><strong>Teléfono:</strong></p>
                <ul>
                    @if (isset($candidato->telefonos) && $candidato->telefonos->count())
                        @foreach ($candidato->telefonos as $telefono)
                            <li>{{ $telefono->numero }}</li>
                        @endforeach
                    @else
                        <li>No hay teléfonos registrados.</li>
                    @endif
                </ul>
                <p><strong>Estudios realizados:</strong></p>
                <ul>
                    @if (isset($candidato->estudios) && $candidato->estudios->count())
                        @foreach ($candidato->estudios as $estudio)
                            <li>{{ $estudio->carrera }} en {{ $estudio->nombreUni }} egresado en el
                                {{ $estudio->fechaEgreso ?? 'Actual' }}</li>
                        @endforeach
                    @else
                        <li>No hay estudios registrados.</li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Profesiones</h4>
                @if (isset($candidato->candidatoProfesiones) && $candidato->candidatoProfesiones->count())
                    <ul>
                        @foreach ($candidato->candidatoProfesiones as $profesion)
                            <li>{{ $profesion->profesion->descripcion }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No hay profesiones registradas.</p>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Experiencias Laborales</h4>
                @if (isset($candidato->experienciasLaborales) && $candidato->experienciasLaborales->count())
                    <ul>
                        @foreach ($candidato->experienciasLaborales as $exp)
                            <li>
                                {{ $exp->cargo }} en {{ $exp->empresa }}
                                ({{ $exp->fechaInicio }} - {{ $exp->fechaFin ?? 'Actual' }})
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No hay experiencias laborales registradas.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
