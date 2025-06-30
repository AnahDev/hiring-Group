@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Detalles de la Empresa</h1>
                <a href="{{ route('hiringGroup.empresas.index') }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    &larr; Volver a la lista
                </a>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-700">{{ $empresa->nombre }}</h2>
                <p class="text-gray-600">{{ $empresa->email }}</p>
            </div>

            <hr class="my-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Usuario Asociado</h3>
                    @if ($empresa->usuario)
                        <p><strong>Correo:</strong> {{ $empresa->usuario->correo }}</p>
                        <p><strong>Fecha de Registro:</strong> {{ $empresa->usuario->fechaRegistro->format('d/m/Y') }}</p>
                    @else
                        <p class="text-red-500">No hay un usuario asociado a esta empresa.</p>
                    @endif
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Contactos</h3>
                    <ul class="list-disc list-inside">
                        @forelse ($empresa->contactos as $contacto)
                            <li>{{ $contacto->personaContacto }} - {{ $contacto->tlfContacto }}</li>
                        @empty
                            <li>No hay contactos registrados.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
