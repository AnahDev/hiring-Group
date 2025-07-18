@extends('layouts.app')

@section('content')
    <div class="container">
        <h2> Nóminas Ejecutadas</h2>

        @if ($nominas->isEmpty())
            <div class="alert alert-info">No se ha ejecutado ninguna nómina aún.</div>
        @else
            <table class="table table-bordered table-striped mt-4">
                <thead>
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>Empresa</th>
                        <th>Mes / Año</th>
                        <th>Generación</th>
                        <th>T. Bruto</th>
                        <th>T. Neto</th>
                        <th>Comisión HG</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nominas as $nomina)
                        <tr>
                            {{-- <td>{{ $nomina->id }}</td> --}}
                            <td>{{ $nomina->empresa->nombre }}</td>
                            <td>{{ \Carbon\Carbon::create()->month($nomina->mes)->locale('es')->monthName }} /
                                {{ $nomina->año }}</td>
                            <td>{{ $nomina->fechaGeneracion->format('d/m/Y') }}</td>
                            {{-- Los accesores calcularán estos valores --}}
                            <td>{{ number_format($nomina->getTotalBrutoPagadoAttribute(), 2, ',', '.') }}</td>
                            <td>{{ number_format($nomina->getTotalNetoPagadoAttribute(), 2, ',', '.') }}</td>
                            <td>{{ number_format($nomina->getTotalComisionHgAttribute(), 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('hiringGroup.nomina.historial.show', $nomina->id) }}" class="btn-action">Ver
                                    Detalles</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
