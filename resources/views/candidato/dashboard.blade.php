@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Bienvenido, {{ $candidato->nombre ?? auth()->user()->name }}</h1>
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Información Personal</h4>
                <p><strong>Nombre:</strong> {{ $candidato->nombre ?? '-' }}</p>
                <p><strong>Apellido:</strong> {{ $candidato->apellido ?? '-' }}</p>
                <p><strong>Correo:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Dirección:</strong> {{ $candidato->direccion ?? '-' }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Profesiones</h4>
                @if (isset($candidato->profesiones) && $candidato->profesiones->count())
                    <ul>
                        @foreach ($candidato->profesiones as $profesion)
                            <li>{{ $profesion->nombre }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No hay profesiones registradas.</p>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Experiencias Laborales</h4>
                @if (isset($candidato->experiencias) && $candidato->experiencias->count())
                    <ul>
                        @foreach ($candidato->experiencias as $exp)
                            <li>
                                {{ $exp->puesto }} en {{ $exp->empresa }}
                                ({{ $exp->fecha_inicio }} - {{ $exp->fecha_fin ?? 'Actual' }})
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No hay experiencias laborales registradas.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
