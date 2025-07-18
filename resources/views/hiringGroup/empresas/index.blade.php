@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Empresas Registradas</h2>

        <div class="text-right" style="margin-bottom: 1.5rem;">
            <a href="{{ route('hiringGroup.empresas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Empresa
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error"> {{-- Using alert-error for consistency --}}
                {{ session('error') }}
            </div>
        @endif

        @if ($empresas->isEmpty())
            <div class="alert alert-info">
                No hay empresas registradas.
            </div>
        @else
            <div class=""> {{-- Mantengo table-responsive si tienes CSS para ello o para overflow --}}
                <table class="table table-container">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th style="width: auto;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empresas as $empresa)
                            <tr>
                                <td>{{ $empresa->nombre }}</td>
                                <td>{{ $empresa->email }}</td>
                                <td>
                                    @foreach ($empresa->contactos as $contacto)
                                        {{ $contacto->tlfContacto }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('hiringGroup.empresas.show', $empresa->id) }}" class="btn btn-info">
                                        Ver
                                    </a>
                                    <a href="{{ route('hiringGroup.empresas.edit', $empresa->id) }}" class="btn btn-warning"
                                        title="Editar Empresa">
                                        &#9998;
                                    </a>
                                    <form action="{{ route('hiringGroup.empresas.destroy', $empresa->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('¿Está seguro de eliminar esta empresa? Esta acción no se puede deshacer.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Eliminar Empresa">
                                            &#128465;
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        @endif
    </div>
@endsection
