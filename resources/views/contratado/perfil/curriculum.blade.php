@extends('layouts.app')

@section('content')
    <div class="main-content">
        <h1>Mi Currículum Vitae</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        <div class="empresa-card">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Información Personal</h3>
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $candidato->nombre }}</p>
                    <p><strong>Apellido:</strong> {{ $candidato->apellido }}</p>
                    <p><strong>Dirección:</strong> {{ $candidato->direccion ?? 'No especificada' }}</p>
                    <p><strong>Email:</strong> {{ $candidato->usuario->correo ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h3>Teléfonos de Contacto</h3>
                </div>
                <div class="card-body">
                    @if ($candidato->telefonos->isEmpty())
                        <p>No hay teléfonos registrados.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($candidato->telefonos as $telefono)
                                <li class="list-group-item">{{ $telefono->numero }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h3>Experiencia Laboral</h3>
                </div>
                <div class="card-body">
                    @if ($candidato->experienciasLaborales->isEmpty())
                        <p>No hay experiencia laboral registrada.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($candidato->experienciasLaborales as $experiencia)
                                <li class="list-group-item">
                                    <strong>Empresa:</strong> {{ $experiencia->empresa }}<br>
                                    <strong>Cargo:</strong> {{ $experiencia->cargo }}<br>
                                    <strong>Período:</strong>
                                    {{ \Carbon\Carbon::parse($experiencia->fechaInicio)->format('d/m/Y') }} -
                                    {{ $experiencia->fechaFin ? \Carbon\Carbon::parse($experiencia->fechaFin)->format('d/m/Y') : 'Actualidad' }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h3>Estudios Universitarios</h3>
                </div>
                <div class="card-body">
                    @if ($candidato->estudios->isEmpty())
                        <p>No hay estudios universitarios registrados.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($candidato->estudios as $estudio)
                                <li class="list-group-item">
                                    <strong>Universidad:</strong> {{ $estudio->nombreUni }}<br>
                                    <strong>Carrera:</strong> {{ $estudio->carrera }}<br>
                                    <strong>Fecha de Egreso:</strong>
                                    {{ $estudio->fechaEgreso ? \Carbon\Carbon::parse($estudio->fechaEgreso)->format('d/m/Y') : 'En curso' }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h3> Profesiones</h3>
                </div>
                <div class="card-body">
                    @if ($candidato->candidatoProfesiones->isEmpty())
                        <p>No hay profesiones registradas.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($candidato->candidatoProfesiones as $candidatoProfesion)
                                <li class="list-group-item">
                                    {{ $candidatoProfesion->profesion->descripcion ?? 'Profesión Desconocida' }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>


    </div>
@endsection
