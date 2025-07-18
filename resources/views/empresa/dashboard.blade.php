@extends('layouts.app')

@section('content')
    <div class="main-content">

        <div class="page-header">
            <h2>Bienvenido, Empresa</h2>
        </div>
        <h3>Informacion de la Empresa</h3>
        <div class="card-header">
            <h1 class="empresa-nombre">{{ auth()->user()->empresa->nombre }}</h1>
            <p class="empresa-email"><strong>ID Usuario: </strong>{{ auth()->user()->empresa->usuario_id }} </p>
        </div>

        <div class="card-body">
            <div class="">
                <div class="info-section">
                    <h3 class="section_title">
                        Sectores de la Empresa:
                    </h3>
                    <ul>
                        @forelse ((auth()->user()->empresa->sectores ?? []) as $sector)
                            <li>{{ $sector->descripcion ?? 'Sin descripcion' }} </li>
                        @empty
                            <li>No disponible</li>
                        @endforelse
                    </ul>
                </div>
                <div class="contacts-section">
                    <h3 class="section-title">
                        📞 Contactos de la Empresa
                    </h3>


                    @forelse ((auth()->user()->empresa->contactos ?? []) as $contacto)
                        <div class="contact-item">
                            <div class="contact-icon">
                                {{ strtoupper(substr($contacto->personaContacto, 0, 2)) }}
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">{{ $contacto->personaContacto ?? 'No Disponible' }}</div>
                                <div class="contact-phone"> {{ $contacto->tlfContacto ?? 'No disponible' }}</div>
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

            <div class="info-section">


                <h3 class="section-title">
                    Nóminas de la Empresa:

                </h3>
                <table class="table table-container">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha de Generación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse((auth()->user()->empresa->nominas ?? []) as $nomina)
                            <tr>
                                <td>{{ $nomina->id }}</td>
                                <td>{{ $nomina->fechaGeneracion ?? 'No disponible' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">No hay nóminas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>


        </div>

    </div>
@endsection
