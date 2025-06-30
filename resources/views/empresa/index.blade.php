@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Empresas Registradas</h1>
        <a href="{{ route('hiringGroup.empresas.create') }}" class="btn btn-primary mb-3">Agregar Empresa</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($empresas->isEmpty())
            <div class="alert alert-info">No hay empresas registradas.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $empresa)
                        <tr>
                            <td>{{ $empresa->id }}</td>
                            <td>{{ $empresa->nombre }}</td>
                            <td>{{ $empresa->correo }}</td>
                            <td>{{ $empresa->telefono }}</td>
                            <td>
                                <a href="{{ route('hiringGroup.empresas.show', $empresa->id) }}"
                                    class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('hiringGroup.empresas.edit', $empresa->id) }}"
                                    class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('hiringGroup.empresas.destroy', $empresa->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Está seguro de eliminar esta empresa?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
