@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Oferta Laboral: {{ $ofertaLaboral->cargo }}</h1>

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
                <label for="cargo" class="form-label">Cargo Vacante:</label>
                <input type="text" class="form-control" id="cargo" name="cargo" value="{{ old('cargo', $ofertaLaboral->cargo) }}" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción del Perfil:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required>{{ old('descripcion', $ofertaLaboral->descripcion) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="salario" class="form-label">Salario Ofrecido:</label>
                <input type="number" step="0.01" class="form-control" id="salario" name="salario" value="{{ old('salario', $ofertaLaboral->salario) }}" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="estado" name="estado" value="1" {{ old('estado', $ofertaLaboral->estado) ? 'checked' : '' }}>
                <label class="form-check-label" for="estatus">Activa</label>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Oferta</button>
            <a href="{{ route('empresa.ofertas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection