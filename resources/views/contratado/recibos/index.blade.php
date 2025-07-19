@extends('layouts.app')
@section('content')
    <div class="main-content">
        <h2>Mis Recibos de Pago</h2>

        <form method="GET" class="row g-3 mb-3">
            <div class="form-grid">
                <div class="col-md-3">
                    <select name="mes" class="form-select">
                        <option value="">-- Mes --</option>
                        @foreach (range(1, 12) as $m)
                            <option value="{{ $m }}" {{ request('mes') == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="anio" class="form-select">
                        <option value="">-- Año --</option>
                        @for ($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ request('año') == $y ? 'selected' : '' }}>
                                {{ $y }}</option>
                        @endfor
                    </select>
                </div>

            </div>

            <div style="display: flex; gap: 10px; justify-content:center; margin-top:-15px; margin-bottom: 15px;">

                <button type="submit" class="submit-btn">&#128269; Filtrar</button>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recibos as $recibo)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($recibo->nomina->fechaGeneracion)->format('d/m/Y') }}</td>
                        <td>${{ number_format($recibo->salarioNeto, 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No hay recibos para mostrar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
