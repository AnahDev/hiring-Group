@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="page-title">Editar Empresa: {{ $empresa->nombre }}</h2>
        </div>


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
        <div class="form-card">

            <form action="{{ route('hiringGroup.empresas.update', $empresa) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label" for="nombre">
                        Nombre de la Empresa
                    </label>
                    <input class="form-control" id="nombre" name="nombre" type="text"
                        value="{{ old('nombre', $empresa->nombre) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">
                        Email de Contacto de la Empresa
                    </label>
                    <input class="form-control" id="email" name="email" type="email"
                        value="{{ old('email', $empresa->email) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        Usuario de Acceso (Email)
                    </label>
                    <p
                        style="color: #000000; background-color:rgba(179, 199, 244, 0.371); display: inline-block; padding: 0.5rem; border-radius: 0.25rem;">
                        {{ $empresa->usuario->correo ?? 'No asignado' }}
                    </p> {{-- Inline style for text-gray-700 --}}
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <button class="btn btn-primary" type="submit">
                        Actualizar Empresa
                    </button>
                    <a href="{{ route('hiringGroup.empresas.index') }}" class="btn btn-danger">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
