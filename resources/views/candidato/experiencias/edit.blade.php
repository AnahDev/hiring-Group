@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Experiencia Laboral</h2>
        <form method="POST" action="{{ route('candidato.experiencias.update', $experiencia->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="empresa" class="form-label">Empresa</label>
                <input type="text" class="form-control" id="empresa" name="empresa"
                    value="{{ old('empresa', $experiencia->empresa) }}" required>
                @error('empresa')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" class="form-control" id="cargo" name="cargo"
                    value="{{ old('cargo', $experiencia->cargo) }}" required>
                @error('cargo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio"
                    value="{{ old('fechaInicio', $experiencia->fechaInicio) }}" required>
                @error('fechaInicio')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="fechaFin" class="form-label">Fecha de Fin</label>
                <input type="date" class="form-control" id="fechaFin" name="fechaFin"
                    value="{{ old('fechaFin', $experiencia->fechaFin) }}">
                @error('fechaFin')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Actualizar Experiencia</button>
        </form>
    </div>
@endsection
