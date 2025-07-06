@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Historial de Nóminas Ejecutadas</h1>

        @if ($nominas->isEmpty())
            <div class="alert alert-info">No se ha ejecutado ninguna nómina aún.</div>
        @else
            <table class="table table-bordered table-striped mt-4">
                <thead>
                    <tr>
                        <th>ID Nómina</th>
                        <th>Empresa</th>
                        <th>Mes / Año</th>
                        <th>Fecha Generación</th>
                        <th>Total Bruto</th>
                        <th>Total Neto</th>
                        <th>Comisión HG</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nominas as $nomina)
                        <tr>
                            <td>{{ $nomina->id }}</td>
                            <td>{{ $nomina->empresa->nombre }}</td>
                            <td>{{ \Carbon\Carbon::create()->month($nomina->mes)->locale('es')->monthName }} /
                                {{ $nomina->año }}</td>
                            <td>{{ $nomina->fechaGeneracion->format('d/m/Y H:i') }}</td>
                            {{-- Los accesores calcularán estos valores --}}
                            <td>{{ number_format($nomina->getTotalBrutoPagadoAttribute(), 2, ',', '.') }}</td>
                            <td>{{ number_format($nomina->getTotalNetoPagadoAttribute(), 2, ',', '.') }}</td>
                            <td>{{ number_format($nomina->getTotalComisionHgAttribute(), 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('hiringGroup.nomina.historial.show', $nomina->id) }}"
                                    class="btn btn-info btn-sm">Ver Detalles</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
