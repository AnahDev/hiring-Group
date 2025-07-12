@extends('layouts.app')

@section('content')
    <div class="container"> {{-- Uses existing .container --}}
        <h1 class="page-title">Crear Nueva Empresa</h1> {{-- Uses existing .page-title --}}

        @if ($errors->any())
            <div class="alert alert-error" role="alert"> {{-- Uses existing .alert .alert-error --}}
                <strong style="font-weight: bold;">¡Ups!</strong> {{-- Inline style for boldness as no specific .font-bold class --}}
                <span style="display: block;">Hay algunos problemas con tu entrada.</span> {{-- Inline style for block display, no specific .block class --}}
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="card">
                <div class="form-grid cols-2">
            <div class="card">
                <form action="{{ route('hiringGroup.empresas.store') }}" method="POST" class="card"> {{-- Uses existing .card --}}
            @csrf
            <div class="form-group"> 
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">Datos de la Empresa</h2>
                <label class="form-label" for="nombre"> 
                    Nombre de la Empresa
                </label>
                <input class="form-control"  id="nombre" name="nombre" type="text"
                    placeholder="Nombre de la Empresa" value="{{ old('nombre') }}"
                    required>
            </div>
                <div class="form-group"> 
                    <label class="form-label" for="email">
                        Email de Contacto de la Empresa
                    </label>
                    <input class="form-control" id="email" name="email" type="email"
                        placeholder="contacto@empresa.com" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="card">
                   <div class="form-group"> 
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">Datos del Usuario de Acceso</h2>
                <label class="form-label" for="user_email">
                    Email del Usuario
                </label>
                <input class="form-control" id="user_email" name="user_email" type="email"
                     placeholder="usuario@empresa.com" value="{{ old('user_email') }}"
                    required>
            </div>
            <div class="form-group"> {{-- Uses existing .form-group --}}
                <label class="form-label" for="user_password">
                    Contraseña
                </label>
                <input class="form-control" id="user_password" name="user_password" type="password"
                     placeholder="******************" required>
            </div>
            <div class="form-group"> {{-- Uses existing .form-group --}}
                <label class="form-label" for="user_password_confirmation">
                    Confirmar Contraseña
                </label>
                <input class="form-control" id="user_password_confirmation" name="user_password_confirmation"
                    type="password" placeholder="******************" required>
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between;"> {{-- Inline flex styles for actions --}}
                <button class="btn btn-primary" {{-- Uses existing .btn .btn-primary --}} type="submit">
                    Guardar Empresa
                </button>
            </div>
        </div>
    </div>
                <a href="{{ route('hiringGroup.empresas.index') }}" class="btn"
                    style="background: rgb(63, 99, 160); border: 1px solid var(--secondary-color); color: var(--secondary-color); font-weight: bold; font-size: 0.875rem;">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
