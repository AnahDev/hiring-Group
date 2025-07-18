@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2>Gestionar Perfil de la Empresa</h2>
        </div>

        <p>Desde aquí puedes actualizar la información de tu empresa.</p>

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



        {{-- SECCIÓN PARA GESTIONAR SECTORES --}}
        <div class="empresa-card">
            <div class="card-header">
                <h3>Sectores Actuales</h3>
            </div>
            <div class="">
                <table class="table table-container">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($empresa->sectores->isNotEmpty())
                            @foreach ($empresa->sectores as $sector)
                                <tr>
                                    <td>{{ $sector->descripcion }}</td>
                                    <td>
                                        <form action="{{ route('empresa.sectores.destroy', $sector->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este sector?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"
                                                class="icono">&#128465;</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="text-center">Aún no has agregado ningún sector.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>


                <div class="card-header">
                    <h3>Agregar Nuevo Sector</h3>
                </div>
                <div class="form-card">
                    <form action="{{ route('empresa.sectores.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="descripcion_sector" class="form-label">Descripción del Sector</label>
                            <input type="text" class="form-control" id="descripcion_sector" name="descripcion" required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top:1rem;">Agregar Sector</button>
                    </form>
                </div>


            </div>


            {{-- SECCIÓN PARA GESTIONAR CONTACTOS --}}
            <div class="card">
                <div class="card-header">
                    <h3>Contactos de la Empresa</h3>
                </div>

                <table class="table table-container">
                    <thead>
                        <tr>
                            <th>Persona de Contacto</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($empresa->contactos->isNotEmpty())
                            @foreach ($empresa->contactos as $contacto)
                                <tr>
                                    <td>{{ $contacto->personaContacto }}</td>
                                    <td>{{ $contacto->tlfContacto }}</td>
                                    <td>
                                        <form action="{{ route('empresa.contactos.destroy', $contacto->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este contacto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"
                                                class="icono">&#128465;</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">Aún no has agregado ningún contacto.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>



                <div class="card-header">
                    <h3>Agregar Nuevo Contacto</h3>
                </div>
                <div class="form-card">
                    <form action="{{ route('empresa.contactos.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <label for="personaContacto" class="form-label">Nombre de Contacto</label>
                                <input type="text" class="form-control" id="personaContacto" name="personaContacto"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="tlfContacto" class="form-label">Teléfono de Contacto</label>
                                <input type="text" class="form-control" id="tlfContacto" name="tlfContacto" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Contacto</button>
                    </form>
                </div>

            </div>
        </div>
    </div>




    </div>
@endsection
