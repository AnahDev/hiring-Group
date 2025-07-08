@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Gestionar Perfil de la Empresa</h2>
        <p>Desde aquí puedes actualizar la información de tu empresa, así como agregar o eliminar sectores y personas de
            contacto.</p>

        {{-- Mostrar mensajes de éxito o error --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <hr>

        {{-- SECCIÓN PARA GESTIONAR SECTORES --}}
        <div class="card mb-4">
            <div class="card-header">
                <h3>Sectores de la Empresa</h3>
            </div>
            <div class="card-body">
                <h5>Sectores Actuales</h5>
                @if ($empresa->sectores->isNotEmpty())
                    <ul class="list-group mb-3">
                        @foreach ($empresa->sectores as $sector)
                            {{--   
                            @php dd($sector); @endphp
                            --}}
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $sector->descripcion }}
                                <form action="{{ route('empresa.sectores.destroy', $sector->id) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este sector?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Aún no has agregado ningún sector.</p>
                @endif

                <hr>

                <h5>Agregar Nuevo Sector</h5>
                <form action="{{ route('empresa.sectores.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="descripcion_sector" class="form-label">Descripción del Sector</label>
                        <input type="text" class="form-control" id="descripcion_sector" name="descripcion" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Sector</button>
                </form>
            </div>
        </div>


        {{-- SECCIÓN PARA GESTIONAR CONTACTOS --}}
        <div class="card">
            <div class="card-header">
                <h3>Contactos de la Empresa</h3>
            </div>
            <div class="card-body">
                <h5>Contactos Actuales</h5>
                @if ($empresa->contactos->isNotEmpty())
                    <ul class="list-group mb-3">
                        @foreach ($empresa->contactos as $contacto)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $contacto->personaContacto }}</strong>
                                    <br>
                                    <small class="text-muted">Teléfono: {{ $contacto->tlfContacto }}</small>
                                </div>
                                <form action="{{ route('empresa.contactos.destroy', $contacto->id) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este contacto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Aún no has agregado ningún contacto.</p>
                @endif

                <hr>

                <h5>Agregar Nuevo Contacto</h5>
                <form action="{{ route('empresa.contactos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="personaContacto" class="form-label">Nombre de la Persona de Contacto</label>
                            <input type="text" class="form-control" id="personaContacto" name="personaContacto" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tlfContacto" class="form-label">Teléfono de Contacto</label>
                            <input type="text" class="form-control" id="tlfContacto" name="tlfContacto" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Contacto</button>
                </form>
            </div>
        </div>

    </div>
@endsection
