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
    <h4>Agregar Profesión</h4>
    <form method="POST" action="{{ route('candidato.profesiones.store') }}">
        @csrf
        <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
        <div class="mb-3">
            <label for="profesion_id" class="form-label">Profesión</label>
            <select class="form-control" id="profesion_id" name="profesion_id" required>
                <option value="">Seleccione una profesión</option>
                @foreach ($profesiones as $profesion)
                    <option value="{{ $profesion->id }}">{{ $profesion->descripcion }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Profesión</button>
    </form>
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Profesiones</h4>

            @if ($profesionesDelCandidato->isNotEmpty())
                <ul class="list-group">
                    @foreach ($profesionesDelCandidato as $profesion)
                        {{-- ¡Aquí se usa $profesion directamente! --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $profesion->descripcion }}
                            <form action="{{ route('candidato.profesiones.destroy', $profesion->id) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta profesión de tu perfil?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Aún no has añadido ninguna profesión a tu perfil.</p>
            @endif
        </div>
    </div>
@endsection
