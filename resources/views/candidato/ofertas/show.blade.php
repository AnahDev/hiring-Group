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
        @can('create', [App\Models\postulacion::class, $ofertaLaboral])
            @php
                $yaPostulado = $ofertaLaboral
                    ->postulaciones()
                    ->where('candidato_id', auth()->user()->candidato->id)
                    ->exists();
            @endphp
            <form method="POST" action="{{ route('candidato.ofertas.postular', $ofertaLaboral) }}">
                @csrf
                <button type="submit" class="btn btn-success mt-3" {{ $yaPostulado ? 'disabled' : '' }}>
                    {{ $yaPostulado ? 'Ya te postulaste' : 'Aplicar a esta oferta' }}
                </button>
            </form>
        @endcan
        <a href="{{ route('candidato.ofertas.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
    </div>
@endsection
