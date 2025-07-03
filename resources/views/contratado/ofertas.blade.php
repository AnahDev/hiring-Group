@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Ofertas Laborales Disponibles</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Cargo</th>
                    <th>Empresa</th>
                    <th>Salario</th>
                    <th>Ubicación</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ofertas as $oferta)
                    <tr>
                        <td>{{ $oferta->cargo }}</td>
                        <td>{{ $oferta->empresa->nombre ?? '-' }}</td>
                        <td>${{ number_format($oferta->salario, 2, ',', '.') }}</td>
                        <td>{{ $oferta->ubicacion }}</td>
                        <td>{{ ucfirst($oferta->estado) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No hay ofertas disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
