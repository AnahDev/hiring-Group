@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Agregar Profesión --}}
    <div class="main-container">
        <div class="page-header">
            <h2>Agregar Profesion</h2>
        </div>
        <div class="empresa-card">
            <div class="card-header">
                {{-- <h3>Agregar Profesion</h3> --}}
            </div>
            <div class="form-card">
                <form method="POST" action="{{ route('candidato.profesiones.store') }}">
                    @csrf
                    <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
                    <div class="mb-3">
                        {{-- <label for="profesion_id" class="form-label">Profesión</label> --}}
                        <select class="form-control" id="profesion_id" name="profesion_id" required>
                            <option value="">Seleccione una profesión</option>
                            @foreach ($profesiones as $profesion)
                                <option value="{{ $profesion->id }}">{{ $profesion->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button style="margin-top:1rem; type="submit" class="btn btn-primary">Agregar Profesión</button>
                </form>
            </div>
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Profesiones Agregadas</h3>
                </div>

                <table class="table table-container" style="margin-top:1rem;">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($profesionesDelCandidato->isNotEmpty())
                            @foreach ($profesionesDelCandidato as $profesion)
                                <tr>
                                    <td>{{ $profesion->descripcion }}</td>
                                    <td>
                                        <form action="{{ route('candidato.profesiones.destroy', $profesion->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta profesión de tu perfil?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                title="Eliminar">&#128465;</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="text-center">Aún no has añadido ninguna profesión a tu perfil.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>


            </div>
        </div>

    </div>

    </div>
@endsection
