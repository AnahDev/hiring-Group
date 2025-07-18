@extends('layouts.app')

@section('content')
    <div class="main-content">
        <a href="{{ route('hiringGroup.bancos.index') }}" class="btn-action"
            style="background-color: #6c757d; color: white; margin-bottom: 1.5rem;">
            &larr; Volver a la lista </a>
        <h2>Detalles del Banco: {{ $banco->nombreBanco }}</h2>

        <div class="empresa-card">
            <div class="card-header">
                Información General
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $banco->id }}</p>
                <p><strong>Nombre del Banco:</strong> {{ $banco->nombreBanco }}</p>
                <p><strong>Creado el:</strong> {{ $banco->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Última Actualización:</strong> {{ $banco->updated_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="container">

                <h3 style="text-align: center;">Contratos Asociados (Empleados)</h3>

                <div class="card-body">
                    @if ($banco->contrato->isEmpty())
                        <div
                            style="background-color: #d1ecf1; color: #0c5460; padding: 1rem; border-radius: var(--border-radius);">
                            No hay contratos asociados a este banco.
                        </div>
                    @else
                        <div>
                            <table class="table table-container">
                                <thead>
                                    <tr>
                                        <th>ID Contrato</th>
                                        <th>Empleado (Nombre y Apellido)</th>
                                        {{-- <th>Cédula</th> --}}
                                        <th>Cargo</th>
                                        <th>Inicio de Contrato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banco->contrato as $contrato)
                                        <tr>
                                            <td>{{ $contrato->id }}</td>
                                            <td>{{ $contrato->postulacion->candidato->nombre ?? 'N/A' }}
                                                {{ $contrato->postulacion->candidato->apellido ?? '' }}</td>
                                            {{--  <td>{{ $contrato->postulacion->candidato->usuario->cedula ?? 'N/A' }}</td > --}}
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
