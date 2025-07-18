@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('hiringGroup.nomina.historial') }}" class="btn-action">
            &larr; Volver al Historial
        </a>
        <h2>Detalles de Nómina: #{{ $nomina->id }}</h2>

        <div class="empresa-card">
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
            <div class="card-body">
                <h3 style="text-align: center">Detalles por Empleado</h3>
                @if ($nomina->detalleNomina->isEmpty())
                    <div
                        style="background-color: #d1ecf1; color: #0c5460; padding: 1rem; border-radius: var(--border-radius); text-align: center;">
                        No hay detalles de nómina para este registro.</div>
                @else
                    <table class="table table-container">
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
        </div>
    </div>


@endsection
