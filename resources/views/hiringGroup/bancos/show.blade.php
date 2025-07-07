@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('hiringGroup.bancos.index') }}" class="btn"
            style="background-color: #6c757d; color: white; margin-bottom: 1.5rem;">
            <i class="fas fa-arrow-left"></i> Volver al Listado de Bancos
        </a>
        <h1 style="margin-bottom: 1.5rem;">Detalles del Banco: {{ $banco->nombreBanco }}</h1>

        <div class="card" style="margin-bottom: 1.5rem;">
            <div style="padding: 1rem; border-bottom: 1px solid #eee; margin-bottom: 1rem; font-weight: bold;">
                Información General
            </div>
            <div class="card-body"> {{-- card-body aquí es solo para estructura --}}
                <p><strong>ID:</strong> {{ $banco->id }}</p>
                <p><strong>Nombre del Banco:</strong> {{ $banco->nombreBanco }}</p>
                {{-- <p><strong>Código del Banco:</strong> {{ $banco->codigoBanco }}</p> --}}
                <p><strong>Creado el:</strong> {{ $banco->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Última Actualización:</strong> {{ $banco->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="card">
            <div style="padding: 1rem; border-bottom: 1px solid #eee; margin-bottom: 1rem; font-weight: bold;">
                Contratos Asociados (Empleados)
            </div>
            <div class="card-body">
                @if ($banco->contrato->isEmpty())
                    <div
                        style="background-color: #d1ecf1; color: #0c5460; padding: 1rem; border-radius: var(--border-radius);">
                        No hay contratos asociados a este banco.
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
                                @foreach ($banco->contrato as $contrato)
                                    <tr>
                                        <td>{{ $contrato->id }}</td>
                                        <td>{{ $contrato->postulacion->candidato->nombre ?? 'N/A' }}
                                            {{ $contrato->postulacion->candidato->apellido ?? '' }}</td>
                                        {{--  <td>{{ $contrato->postulacion->candidato->usuario->cedula ?? 'N/A' }}</td > --}}
                                        <td>{{ $contrato->postulacion->ofertaLaboral->cargo ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($contrato->fecha_inicio)->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
