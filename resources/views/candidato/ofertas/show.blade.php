@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2>Detalles de la Oferta Laboral</h2>
        </div>

        <div class="empresa-card">
            <div class="card-header">
                <h1 class="card-title">{{ $ofertaLaboral->cargo }}</h1>
            </div>
            <div class="card">
                <div class="info-section">
                    <div class="card-body">
                        <p><strong>Profesión:</strong> {{ $ofertaLaboral->profesion->descripcion ?? 'N/A' }}</p>
                        <p><strong>Salario:</strong> ${{ number_format($ofertaLaboral->salario, 2, ',', '.') }}</p>
                        <p><strong>Ubicación:</strong> {{ $ofertaLaboral->ubicacion }}</p>
                        <p><strong>Estado:</strong> {{ ucfirst($ofertaLaboral->estado) }}</p>
                        <p><strong>Descripción:</strong> {{ $ofertaLaboral->descripcion }}</p>

                    </div>
                </div>

            </div>

            <div style="display:flex; justify-content: space-around;  margin-top: 20px; margin-bottom: 20px;">
                @can('create', [App\Models\postulacion::class, $ofertaLaboral])
                    @php
                        $yaPostulado = $ofertaLaboral
                            ->postulaciones()
                            ->where('candidato_id', auth()->user()->candidato->id)
                            ->exists();
                    @endphp
                    <form method="POST" action="{{ route('candidato.ofertas.postular', $ofertaLaboral) }}">
                        @csrf
                        <button style="font-weight:bold;" type="submit" class="btn btn-primary"
                            {{ $yaPostulado ? 'disabled' : '' }}>
                            &#10004; {{ $yaPostulado ? 'Ya te postulaste' : 'Aplicar a esta oferta' }}
                        </button>
                    </form>
                @endcan
                <a href="{{ route('candidato.ofertas.index') }}" class="btn btn-danger"> &#8592; Volver </a>
            </div>

        </div>
    @endsection
