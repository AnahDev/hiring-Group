@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Gestión de profesiones</h2>

        @if (session('success'))
            <div
                style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div
                style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
                {{ session('error') }}
            </div>
        @endif

        <div style="text-align: right; margin-bottom: 1.5rem;">
            <a href="{{ route('hiringGroup.profesiones.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Nueva Profesión
            </a>
        </div>

        @if ($profesiones->isEmpty())
            <div
                style="background-color: #d1ecf1; color: #0c5460; padding: 1rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
                No hay profesiones registradas en el sistema.
            </div>
        @else
            <div class="table-responsive"> {{-- Mantengo table-responsive si tienes CSS para ello o para overflow --}}
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre de la Profesión</th>
                            <th style="width: auto;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profesiones as $profesion)
                            <tr>
                                <td>{{ $profesion->descripcion }}</td>
                                <td>
                                    <a href="{{ route('hiringGroup.profesiones.show', $profesion->id) }}" class="btn"
                                        style="background-color: #17a2b8; color: white;">
                                        <i class="fas fa-eye">Ver</i>
                                    </a>
                                    <a href="{{ route('hiringGroup.profesiones.edit', $profesion->id) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-edit">Editar</i>
                                    </a>
                                    <form action="{{ route('hiringGroup.profesiones.destroy', $profesion->id) }}"
                                        method="POST" style="display: inline;"
                                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta profesión? Esta acción no se puede deshacer y fallará si hay contratos asociados.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" <i
                                            class="fas fa-trash-alt">Eliminar</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Paginación: Laravel genera HTML que se puede estilizar con tu CSS, pero podría requerir estilos adicionales --}}
            <div style="display: flex; justify-content: center; margin-top: 1.5rem;">
                {{ $profesiones->links() }}
            </div>
        @endif
    </div>
@endsection
