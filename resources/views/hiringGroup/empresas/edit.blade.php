@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">Editar Empresa: {{ $empresa->nombre }}</h1>

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                <strong style="font-weight: bold;">¡Ups!</strong>
                <span style="display: block;">Hay algunos problemas con tu entrada.</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('hiringGroup.empresas.update', $empresa) }}" method="POST" class="card">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label" for="nombre">
                    Nombre de la Empresa
                </label>
                <input class="form-control" style="display: block; width: 30%" id="nombre" name="nombre" type="text"
                    value="{{ old('nombre', $empresa->nombre) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">
                    Email de Contacto de la Empresa
                </label>
                <input class="form-control" style="display: block; width: 30%" id="email" name="email" type="email"
                    value="{{ old('email', $empresa->email) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">
                    Usuario de Acceso (Email)
                </label>
                <p style="color: #000000;">{{ $empresa->usuario->correo ?? 'No asignado' }}</p> {{-- Inline style for text-gray-700 --}}
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">
                    Actualizar Empresa
                </button>
                <a href="{{ route('hiringGroup.empresas.index') }}" class="btn btn-link"> {{-- Uses existing .btn .btn-link --}}
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
