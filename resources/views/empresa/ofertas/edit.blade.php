@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Oferta Laboral: {{ $ofertaLaboral->cargo_vacante }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('empresa.ofertas.update', $ofertaLaboral) }}" method="POST">
            @csrf
            @method('PUT') {{-- Importante para las solicitudes PUT/PATCH --}}

            <div class="mb-3">
                <label for="profesion_id" class="form-label">Profesión:</label>
                <select class="form-control" id="profesion_id" name="profesion_id" required>
                    <option value="">Seleccione una profesión</option>
                    @foreach ($profesiones as $profesion)
                        <option value="{{ $profesion->id }}" {{ old('profesion_id', $ofertaLaboral->profesion_id) == $profesion->id ? 'selected' : '' }}>
                            {{ $profesion->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="cargo_vacante" class="form-label">Cargo Vacante:</label>
                <input type="text" class="form-control" id="cargo_vacante" name="cargo_vacante" value="{{ old('cargo_vacante', $ofertaLaboral->cargo_vacante) }}" required>
            </div>

            <div class="mb-3">
                <label for="descripcion_perfil" class="form-label">Descripción del Perfil:</label>
                <textarea class="form-control" id="descripcion_perfil" name="descripcion_perfil" rows="5" required>{{ old('descripcion_perfil', $ofertaLaboral->descripcion_perfil) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="salario_ofrecido" class="form-label">Salario Ofrecido:</label>
                <input type="number" step="0.01" class="form-control" id="salario_ofrecido" name="salario_ofrecido" value="{{ old('salario_ofrecido', $ofertaLaboral->salario_ofrecido) }}" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="estatus" name="estatus" value="1" {{ old('estatus', $ofertaLaboral->estatus) ? 'checked' : '' }}>
                <label class="form-check-label" for="estatus">Activa</label>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Oferta</button>
            <a href="{{ route('empresa.ofertas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection