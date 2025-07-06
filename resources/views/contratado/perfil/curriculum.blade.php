@extends('layouts.app')

@section('content')
    <div class="container">
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

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                Información Personal
                <a href="{{ route('contratado.perfil.edit') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Editar Perfil
                </a>
            </div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $candidato->nombre }}</p>
                <p><strong>Apellido:</strong> {{ $candidato->apellido }}</p>
                <p><strong>Dirección:</strong> {{ $candidato->direccion ?? 'No especificada' }}</p>
                <p><strong>Email:</strong> {{ $candidato->usuario->correo ?? 'N/A' }}</p>
                {{-- Agrega más campos si los tienes en tu modelo Candidato --}}
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Teléfonos de Contacto
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
                Experiencia Laboral
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
                Estudios Universitarios
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
                Profesiones
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
@endsection
