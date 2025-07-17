{{-- @extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Detalles de la Empresa</h1>
                <a href="{{ route('hiringGroup.empresas.index') }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    &larr; Volver a la lista
                </a>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-700">{{ $empresa->nombre }}</h2>
                <p class="text-gray-600">{{ $empresa->email }}</p>
            </div>

            <hr class="my-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Usuario Asociado</h3>
                    @if ($empresa->usuario)
                        <p><strong>Correo:</strong> {{ $empresa->usuario->correo }}</p>
                        <p><strong>Fecha de Registro:</strong> {{ $empresa->usuario->fechaRegistro->format('d/m/Y') }}</p>
                    @else
                        <p class="text-red-500">No hay un usuario asociado a esta empresa.</p>
                    @endif
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Contactos</h3>
                    <ul class="list-disc list-inside">
                        @forelse ($empresa->contactos as $contacto)
                            <li>{{ $contacto->personaContacto }} - {{ $contacto->tlfContacto }}</li>
                        @empty
                            <li>No hay contactos registrados.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
 --}}

@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2>Detalles de la Empresa</h2>
            <a href="{{ route('hiringGroup.empresas.index') }}" class="btn-action">
                &larr; Volver a la lista
            </a>
        </div>

        <div class="empresa-card">
            <div class="card-header">
                <h1 class="empresa-nombre">{{ $empresa->nombre }}</h1>
                <p class="empresa-email">{{ $empresa->email }}</p>
            </div>

            <div class="card-body">
                <div class="info-grid">
                    <div class="info-section">
                        <h3 class="section-title">
                            👤 Usuario Asociado
                        </h3>
                        @if ($empresa->usuario)
                            <div class="info-item">
                                <span class="info-label">Correo:</span>
                                <span class="info-value">{{ $empresa->usuario->correo }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Fecha de Registro:</span>
                                <span class="info-value">{{ $empresa->usuario->fechaRegistro->format('d/m/Y') }}</span>
                            </div>
                        @else
                            <div class="no-data">No hay un usuario asociado a esta empresa.</div>
                        @endif
                    </div>

                    <div class="contacts-section">
                        <h3 class="section-title">
                            📞 Contactos
                        </h3>

                        @forelse ($empresa->contactos as $contacto)
                            <div class="contact-item">
                                <div class="contact-icon">
                                    {{ strtoupper(substr($contacto->personaContacto, 0, 2)) }}
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">{{ $contacto->personaContacto }}</div>
                                    <div class="contact-phone">{{ $contacto->tlfContacto }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="contact-item">
                                <div class="contact-icon">--</div>
                                <div class="contact-info">
                                    <div class="contact-name">No hay contactos registrados.</div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
