@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('hiringGroup.nomina.historial') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Volver al Historial
        </a>
        <h1>Detalles de Nómina #{{ $nomina->id }}</h1>

        <div class="card mb-4">
            <div class="card-header">
                Información General de la Nómina
            </div>
            <div class="card-body">
                <p><strong>Empresa:</strong> {{ $nomina->empresa->nombre }}</p>
                <p><strong>Período:</strong> {{ \Carbon\Carbon::create()->month($nomina->mes)->locale('es')->monthName }} /
                    {{ $nomina->año }}</p>
                <p><strong>Fecha de Generación:</strong> {{ $nomina->fechaGeneracion->format('d/m/Y H:i') }}</p>
                <p><strong>Total Bruto Pagado:</strong> {{ number_format($nomina->total_bruto_pagado, 2, ',', '.') }}</p>
                <p><strong>Total Neto Pagado:</strong> {{ number_format($nomina->total_neto_pagado, 2, ',', '.') }}</p>
                <p><strong>Total Comisión Hiring Group:</strong>
                    {{ number_format($nomina->total_comision_hg, 2, ',', '.') }}</p>
            </div>
        </div>

        <h3>Detalles por Empleado</h3>
        @if ($nomina->detalleNomina->isEmpty())
            <div class="alert alert-warning">No hay detalles de nómina para este registro.</div>
        @else
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Sueldo Bruto</th>
                        <th>Deducción INCES</th>
                        <th>Deducción IVSS</th>
                        <th>Comisión HG</th>
                        <th>Salario Neto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nomina->detalleNomina as $detalle)
                        <tr>
                            <td>{{ $detalle->contrato->postulacion->candidato->nombre ?? 'N/A' }}
                                {{ $detalle->contrato->postulacion->candidato->apellido ?? 'N/A' }}
                            </td>
                            <td>{{ number_format($detalle->sueldoBruto, 2, ',', '.') }}</td>
                            <td>{{ number_format($detalle->deduccionInces, 2, ',', '.') }}</td>
                            <td>{{ number_format($detalle->deduccionIvss, 2, ',', '.') }}</td>
                            <td>{{ number_format($detalle->comisionHg, 2, ',', '.') }}</td>
                            <td>{{ number_format($detalle->salarioNeto, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
