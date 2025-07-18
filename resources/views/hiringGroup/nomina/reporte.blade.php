@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reporte Previo de Nómina</h1>
        <h2>Empresa: {{ $empresa->nombre }} - Mes: {{ $mes }} / Año: {{ $año }}</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        @if ($contratos->isEmpty())
            <div class="alert alert-info">
                No hay empleados activos para procesar la nómina en la empresa {{ $empresa->nombre }} para el período
                {{ $mes }}/{{ $año }}.
            </div>
            <a href="{{ route('hiringGroup.nomina.preparar') }}" class="btn btn-secondary mt-3">Volver a Preparar Nómina</a>
        @else
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        {{-- <th>Cédula</th> --}}
                        <th>Nombre </th>
                        <th>Cargo </th>
                        <th>Sueldo Bruto</th>
                        <th>INCES (0.5%)</th>
                        <th>IVSS (1%)</th>
                        <th>Comisión HG (2%)</th>
                        <th>Salario Neto Estimado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contratos as $contrato)
                        @php
                            $sueldoBruto = $contrato->salarioMensual; // Asumo que esta es la columna en Contrato
                            $deduccionInces = $sueldoBruto * 0.005;
                            $deduccionIvss = $sueldoBruto * 0.01;
                            $comisionHg = $sueldoBruto * 0.02;
                            $salarioNeto = $sueldoBruto - $deduccionInces - $deduccionIvss;
                        @endphp
                        <tr>
                            {{-- <td>{{ $contrato->postulacion->candidato->usuario->cedula ?? 'N/A' }}</td> --}}
                            <td>{{ $contrato->postulacion->candidato->nombre ?? 'N/A' }}</td>
                            <td>{{ $contrato->postulacion->ofertaLaboral->cargo }}</td>
                            <td>{{ number_format($sueldoBruto, 2, ',', '.') }}</td>
                            <td>{{ number_format($deduccionInces, 2, ',', '.') }}</td>
                            <td>{{ number_format($deduccionIvss, 2, ',', '.') }}</td>
                            <td>{{ number_format($comisionHg, 2, ',', '.') }}</td>
                            <td>{{ number_format($salarioNeto, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


            <div style="display: flex; align-items: center; justify-content: space-around; margin-top: 1rem;">
                {{-- Formulario para CONFIRMAR y EJECUTAR la corrida de nómina --}}
                <form action="{{ route('hiringGroup.nomina.ejecutar') }}" method="POST">
                    @csrf
                    {{-- Campos ocultos para pasar los datos de la nómina --}}
                    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                    <input type="hidden" name="mes" value="{{ $mes }}">
                    <input type="hidden" name="año" value="{{ $año }}">

                    {{-- <button type="submit" class="btn btn-primary btn-lg"
                        onclick="return confirm('¿Está seguro de que desea ejecutar esta corrida de nómina? ¡Esta acción es irreversible!');">
                        Confirmar y Ejecutar Corrida de Nómina
                    </button> --}}
                    {{-- <form id="form-nomina" action="{{ route('empresa.ofertas.toggleStatus', $oferta) }}" method="POST">
                        @csrf --}}
                    <button id="b" type="submit" class="btn btn-primary btn-lg" onclick="return confirmar()">
                        Confirmar y Ejecutar Corrida de Nómina
                    </button>
                    {{-- </form> --}}

                </form>
                <a href="{{ route('hiringGroup.nomina.preparar') }}" class=" btn btn-danger btn-lg ">Cancelar</a>
            </div>
        @endif

    </div>

    <script>
        function confirmar() {
            let seguro = confirm(
                '¿Está seguro de que desea ejecutar esta corrida de nómina? ¡Esta acción es irreversible!');

            if (!seguro) return false; // Cancela si el usuario no acepta

            alert('✅ Nómina ejecutada con éxito');
        }
    </script>

@endsection
