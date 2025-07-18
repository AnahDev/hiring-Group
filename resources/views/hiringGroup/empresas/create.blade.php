@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="page-title">Crear Nueva Empresa</h2>
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
            <div class="form-header">
                <h3>Datos de la Empresa</h3>
            </div>

            <form action="{{ route('hiringGroup.empresas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div>
                        <label class="form-label" for="nombre">
                            Nombre de la Empresa
                        </label>
                        <input class="form-control" id="nombre" name="nombre" type="text"
                            placeholder="Escribe Aqui... " value="{{ old('nombre') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">
                        Email de Contacto de la Empresa
                    </label>
                    <input class="form-control" id="email" name="email" type="email"
                        placeholder="contacto@empresa.com" value="{{ old('email') }}" required>
                </div>

                <div class="form-header">
                    <h3>Datos del Usuario de Acceso</h3>
                </div>
                <div class="form-group">

                    <label class="form-label" for="user_email">
                        Email del Usuario
                    </label>
                    <input class="form-control" id="user_email" name="user_email" type="email"
                        placeholder="usuario@empresa.com" value="{{ old('user_email') }}" required>
                </div>
                <div class="form-group"> {{-- Uses existing .form-group --}}
                    <label class="form-label" for="user_password">
                        Contraseña
                    </label>
                    <input class="form-control" id="user_password" name="user_password" type="password"
                        placeholder="*********" required>
                </div>
                <div class="form-group"> {{-- Uses existing .form-group --}}
                    <label class="form-label" for="user_password_confirmation">
                        Confirmar Contraseña
                    </label>
                    <input class="form-control" id="user_password_confirmation" name="user_password_confirmation"
                        type="password" placeholder="*********" required>
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between;">

                    <button class="btn btn-primary" type="submit" style="border: none">
                        Guardar Empresa
                    </button>

                    <div>
                        <a href="{{ route('hiringGroup.empresas.index') }}" class="btn btn-danger" style="border: none">

                            Cancelar
                        </a>
                    </div>
                </div>
            </form>

        </div>


    </div>


@endsection
