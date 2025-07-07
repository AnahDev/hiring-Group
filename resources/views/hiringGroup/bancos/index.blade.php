@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="margin-bottom: 1.5rem;">Gestión de Bancos</h1>

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
            <a href="{{ route('hiringGroup.bancos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Nuevo Banco
            </a>
        </div>

        @if ($bancos->isEmpty())
            <div
                style="background-color: #d1ecf1; color: #0c5460; padding: 1rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
                No hay bancos registrados en el sistema.
            </div>
        @else
            <div class="table-responsive"> {{-- Mantengo table-responsive si tienes CSS para ello o para overflow --}}
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Banco</th>
                            <th style="width: auto;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bancos as $banco)
                            <tr>
                                <td>{{ $banco->id }}</td>
                                <td>{{ $banco->nombreBanco }}</td>
                                {{--  <td>{{ $banco->codigoBanco }}</td> --}}
                                <td>
                                    <a href="{{ route('hiringGroup.bancos.show', $banco->id) }}" class="btn"
                                        style="background-color: #17a2b8; color: white;">
                                        <i class="fas fa-eye">Ver</i>
                                    </a>
                                    <a href="{{ route('hiringGroup.bancos.edit', $banco->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit">Editar</i>
                                    </a>
                                    <form action="{{ route('hiringGroup.bancos.destroy', $banco->id) }}" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar este banco? Esta acción no se puede deshacer y fallará si hay contratos asociados.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn"
                                            style="background-color: #dc3545; color: white;">
                                            <i class="fas fa-trash-alt">Eliminar</i>
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
                {{ $bancos->links() }}
            </div>
        @endif
    </div>
@endsection
