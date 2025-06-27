@extends('layouts.app')

@section('content')
    <h1>Bienvenido, Empresa</h1>

    <div>
        <h3>Informacion de la Empresa</h3>
        <br>
        <p><strong>ID Usuario: </strong>{{ auth()->user()->empresa->usuario_id }} </p>
        <p><strong>Nombre: </strong>{{ auth()->user()->empresa->nombre }}</p>

        {{-- Sectores de la empresa --}}
        <p><strong>Sectores de la Empresa:</strong> </p>
        <ul>
            @forelse (auth()->user()->empresa->sectorEmpresa as $sector)
                <li>{{ $sector->descripcion ?? 'Sin descripcion' }} </li>
            @empty
                <li>No disponible</li>
            @endforelse
        </ul>
        {{-- Contactos de la empresa --}}
        <p><strong>Contactos de la empresa</strong></p>
        <ul>
            @forelse (auth()->user()->empresa->contactoEmpresa as $contacto)
                Persona: {{ $contacto->personaContacto ?? 'No disponible' }},
                Telefono: {{ $contacto->tlfContacto ?? 'No disponible' }}
            @empty
                <li>No disponible</li>
            @endforelse
        </ul>

        <p><strong>Nóminas de la Empresa:</strong></p>
        <ul>
            @forelse(auth()->user()->empresa->nomina as $nomina)
                <li>
                    ID Nómina: {{ $nomina->id }},
                    Fecha: {{ $nomina->fecha ?? 'No disponible' }}
                </li>
            @empty
                <li>No disponible</li>
            @endforelse
        </ul>
    </div>
@endsection
