@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalles de la Oferta</h2>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $ofertaLaboral->cargo }}</h4>
                <p><strong>Profesión:</strong> {{ $ofertaLaboral->profesion->descripcion ?? 'N/A' }}</p>
                <p><strong>Salario:</strong> ${{ number_format($ofertaLaboral->salario, 2, ',', '.') }}</p>
                <p><strong>Ubicación:</strong> {{ $ofertaLaboral->ubicacion }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($ofertaLaboral->estado) }}</p>
                <p><strong>Descripción:</strong></p>
                <p>{{ $ofertaLaboral->descripcion }}</p>
            </div>
        </div>
        <a href="{{ route('candidato.ofertas.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
    </div>
@endsection
