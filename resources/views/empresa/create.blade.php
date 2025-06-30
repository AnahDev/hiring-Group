@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Crear Nueva Empresa</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">¡Ups!</strong>
                <span class="block sm:inline">Hay algunos problemas con tu entrada.</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('hiringGroup.empresa.store') }}" method="POST"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Datos de la Empresa</h2>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                    Nombre de la Empresa
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="nombre" name="nombre" type="text" placeholder="Nombre de la Empresa"
                    value="{{ old('nombre') }}" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email de Contacto de la Empresa
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="email" name="email" type="email" placeholder="contacto@empresa.com"
                    value="{{ old('email') }}" required>
            </div>

            <hr class="my-6">

            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Datos del Usuario de Acceso</h2>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="user_email">
                    Email del Usuario
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="user_email" name="user_email" type="email" placeholder="usuario@empresa.com"
                    value="{{ old('user_email') }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="user_password">
                    Contraseña
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="user_password" name="user_password" type="password" placeholder="******************" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="user_password_confirmation">
                    Confirmar Contraseña
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="user_password_confirmation" name="user_password_confirmation" type="password"
                    placeholder="******************" required>
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Guardar Empresa
                </button>
                <a href="{{ route('hiringGroup.empresa.index') }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
