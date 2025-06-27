@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Añadir Nueva Experiencia Laboral</h2>
        <form method="POST" action="{{ route('candidato.experiencias.store') }}">
            @csrf
            <div class="mb-3">
                <label for="empresa" class="form-label">Empresa</label>
                <input type="text" class="form-control" id="empresa" name="empresa" value="{{ old('empresa') }}" required>
                @error('empresa')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" class="form-control" id="cargo" name="cargo" value="{{ old('cargo') }}"
                    required>
                @error('cargo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio"
                    value="{{ old('fechaInicio') }}" required>
                @error('fechaInicio')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="fechaFin" class="form-label">Fecha de Fin</label>
                <input type="date" class="form-control" id="fechaFin" name="fechaFin" value="{{ old('fechaFin') }}">
                @error('fechaFin')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Guardar Experiencia</button>
        </form>
    </div>
@endsection
