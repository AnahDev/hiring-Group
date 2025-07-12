@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Bienvenido {{ $contratado->nombre ?? auth()->user()->nombre }}</h2>

        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Información Personal</h4>
                <p><strong>Nombre:</strong> {{ $contratado->nombre ?? '-' }}</p>
                <p><strong>Apellido:</strong> {{ $contratado->apellido ?? '-' }}</p>
                <p><strong>Correo:</strong> {{ $contratado->usuario->correo ?? '-' }}</p>
                <p><strong>Dirección:</strong> {{ $contratado->direccion ?? '-' }}</p>
                <p><strong>Teléfono:</strong></p>
                <ul>
                    @if (isset($contratado->telefonos) && $contratado->telefonos->count())
                        @foreach ($contratado->telefonos as $telefono)
                            <li>{{ $telefono->numero }}</li>
                        @endforeach
                    @else
                        <li>No hay teléfonos registrados.</li>
                    @endif
                </ul>
                <p><strong>Estudios realizados:</strong></p>
                <ul>
                    @if (isset($contratado->estudios) && $contratado->estudios->count())
                        @foreach ($contratado->estudios as $estudio)
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
                @if ($contratado->candidatoProfesiones->isEmpty())
                <p>No hay profesiones registradas.</p>
                @else
                     <ul class="list-group">
                        @foreach ($contratado->candidatoProfesiones as $candidatoProfesion)
                            <li class="list-group-item">
                                {{ $candidatoProfesion->profesion->descripcion ?? 'Profesión Desconocida' }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Experiencias Laborales</h4>
                @if (isset($contratado->experienciasLaborales) && $contratado->experienciasLaborales->count())
                    <ul>
                        @foreach ($contratado->experienciasLaborales as $exp)
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
