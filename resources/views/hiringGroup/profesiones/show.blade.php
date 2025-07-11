@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('hiringGroup.profesiones.index') }}" class="btn"
            style="background-color: #6c757d; color: white; margin-bottom: 1.5rem;">
            <i class="fas fa-arrow-left"></i> Volver al Listado de Profesiones
        </a>
        <h1 style="margin-bottom: 1.5rem;">Detalles de la Profesión: {{ $profesion->descripcion }}</h1>

        <div class="card" style="margin-bottom: 1.5rem;">
            <div style="padding: 1rem; border-bottom: 1px solid #eee; margin-bottom: 1rem; font-weight: bold;">
                Información General
            </div>
            <div class="card-body"> {{-- card-body aquí es solo para estructura --}}
                <p><strong>ID:</strong> {{ $profesion->id }}</p>
                <p><strong>Nombre de la Profesión:</strong> {{ $profesion->descripcion }}</p>
                <p><strong>Creado el:</strong> {{ $profesion->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Última Actualización:</strong> {{ $profesion->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="card">
            <div style="padding: 1rem; border-bottom: 1px solid #eee; margin-bottom: 1rem; font-weight: bold;">
                Contratos Asociados (Empleados)
            </div>
            <div class="card-body">
                @if ($profesion->tieneContratos() == false)
                    <div
                        style="background-color: #d1ecf1; color: #0c5460; padding: 1rem; border-radius: var(--border-radius);">
                        No hay contratos asociados a esta profesión.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Contrato</th>
                                    <th>Empleado (Nombre y Apellido)</th>
                                    {{-- <th>Cédula</th> --}}
                                    <th>Cargo</th>
                                    <th>Fecha Inicio Contrato</th>
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
                                        {{-- <td>{{ $contrato->postulacion->candidato->usuario->cedula ?? 'N/A' }}</td > --}}
                                        <td>{{ $contrato->postulacion->ofertaLaboral->cargo ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($contrato->fecha_inicio)->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                                {{--   @foreach ($profesion->contrato as $contrato)
                                    <tr>
                                        <td>{{ $contrato->id }}</td>
                                        <td>{{ $contrato->postulacion->candidato->nombre ?? 'N/A' }}
                                            {{ $contrato->postulacion->candidato->apellido ?? '' }}</td>
                                        <td>{{ $contrato->postulacion->ofertaLaboral->cargo ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($contrato->fecha_inicio)->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
