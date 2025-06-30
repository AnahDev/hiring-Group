{{-- @extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Gestión de Empresas Clientes</h1>

        <div class="mb-4">
            <a href="{{ route('hiringGroup.empresas.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Nueva Empresa
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                            Nombre de la Empresa</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                            Email de Contacto</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                            Usuario Asociado</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($empresas as $empresa)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $empresa->nombre }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $empresa->email }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{ $empresa->usuario->correo ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                                <a href="{{ route('hiringGroup.empresas.edit', $empresa) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                                <a href="{{ route('hiringGroup.empresas.contactos.index', $empresa) }}"
                                    class="text-green-600 hover:text-green-900 mr-3">Contactos</a>
                                <a href="{{ route('hiringGroup.empresas.sectores.index', $empresa) }}"
                                    class="text-yellow-600 hover:text-yellow-900 mr-3">Sectores</a>
                                <form action="{{ route('hiringGroup.empresas.destroy', $empresa) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta empresa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
 --}}
