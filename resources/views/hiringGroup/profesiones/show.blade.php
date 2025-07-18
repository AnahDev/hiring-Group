@extends('layouts.app')

@section('content')
    <div class="main-content">
        <a href="{{ route('hiringGroup.profesiones.index') }}" class="btn-action"
            style="background-color: #6c757d; color: white; margin-bottom: 1.5rem;">
            &larr; Volver a la lista
        </a>
        <h2>Detalles de la Profesión: {{ $profesion->descripcion }}</h1>

            <div class="empresa-card">
                <div class="card-header">
                    Información General
                </div>
                <div class="card-body"> {{-- card-body aquí es solo para estructura --}}
                    <p><strong>ID:</strong> {{ $profesion->id }}</p>
                    <p><strong>Nombre:</strong> {{ $profesion->descripcion }}</p>
                    <p><strong>Creado el:</strong> {{ $profesion->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Última Actualización:</strong> {{ $profesion->updated_at->format('d/m/Y H:i') }}</p>
                </div>

                <div class="container">
                    <h3 style="text-align: center;">
                        Contratos Asociados (Empleados)
                    </h3>
                    <div class="card-body">
                        @if ($profesion->tieneContratos() == false)
                            <div
                                style="background-color: #d1ecf1; color: #0c5460; padding: 1rem; border-radius: var(--border-radius);">
                                No hay contratos asociados a esta profesión.
                            </div>
                        @else
                            <div>
                                <table class="table table-container">
                                    <thead>
                                        <tr>
                                            <th>ID Contrato</th>
                                            <th>Empleado</th>
                                            <th>Cargo</th>
                                            <th> Inicio Contrato</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Recorre la colección de todos los contratos obtenidos del nuevo método --}}
                                        @foreach ($profesion->getAllContracts() as $contrato)
                                            <tr>
                                                <td>{{ $contrato->id }}</td>
                                                <td>
                                                    {{-- Asegúrate de que estas relaciones están cargadas en el controlador --}}
                                                    {{ $contrato->postulacion->candidato->nombre ?? 'N/A' }}
                                                    {{ $contrato->postulacion->candidato->apellido ?? '' }}
                                                </td>
                                                <td>{{ $contrato->postulacion->ofertaLaboral->cargo ?? 'N/A' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($contrato->fecha_inicio)->format('d/m/Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach ($profesion->contrato as $contrato)
                                            <tr>
                                                <td>{{ $contrato->id }}</td>
                                                <td>{{ $contrato->postulacion->candidato->nombre ?? 'N/A' }}
                                                    {{ $contrato->postulacion->candidato->apellido ?? '' }}</td>
                                                <td>{{ $contrato->postulacion->ofertaLaboral->cargo ?? 'N/A' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($contrato->fecha_inicio)->format('d/m/Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


    </div>
@endsection
