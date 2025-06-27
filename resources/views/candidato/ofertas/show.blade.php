@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalles de la Oferta</h2>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $oferta->cargo }}</h4>
                <p><strong>Profesión:</strong> {{ $oferta->profesion->descripcion ?? 'N/A' }}</p>
                <p><strong>Salario:</strong> ${{ number_format($oferta->salario, 2, ',', '.') }}</p>
                <p><strong>Ubicación:</strong> {{ $oferta->ubicacion }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($oferta->estado) }}</p>
                <p><strong>Descripción:</strong></p>
                <p>{{ $oferta->descripcion }}</p>
            </div>
        </div>
        <a href="{{ route('candidato.ofertas.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
    </div>
@endsection
