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
                                <span class="info-label">Fecha de Registro :</span>
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
