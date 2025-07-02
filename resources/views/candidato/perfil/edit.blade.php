@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Perfil de Candidato</h2>
        <form method="POST" action="{{ route('candidato.perfil.update', $candidato->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="{{ old('nombre', $candidato->nombre) }}" required>
                @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido"
                    value="{{ old('apellido', $candidato->apellido) }}" required>
                @error('apellido')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion"
                    value="{{ old('direccion', $candidato->direccion) }}">
                @error('direccion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Actualizar Perfil</button>
        </form>

        <hr>

        {{-- Agregar Teléfono --}}
        <h4>Agregar Teléfono</h4>
        <form method="POST" action="{{ route('candidato.telefonos.store') }}">
            @csrf
            <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
            <div class="mb-3">
                <label for="telefono" class="form-label">Número de Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="numero" required>
                @error('numero')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Agregar Teléfono</button>
        </form>

        <hr>

        {{-- Agregar Experiencia Laboral --}}
        <h4>Agregar Experiencia Laboral</h4>
        <form method="POST" action="{{ route('candidato.experiencias.store') }}">
            @csrf
            <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
            <div class="mb-3">
                <label for="empresa" class="form-label">Empresa</label>
                <input type="text" class="form-control" id="empresa" name="empresa" required>
            </div>
            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" class="form-control" id="cargo" name="cargo" required>
            </div>
            <div class="mb-3">
                <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
            </div>
            <div class="mb-3">
                <label for="fechaFin" class="form-label">Fecha de Fin</label>
                <input type="date" class="form-control" id="fechaFin" name="fechaFin">
                <small class="form-text text-muted">Dejar vacío si aún trabaja aquí.</small>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Experiencia</button>
        </form>

        <hr>
        {{-- Agregar Estudio Universitario --}}
        <h4>Agregar Estudio Universitario</h4>
        <form method="POST" action="{{ route('candidato.estudios.store') }}">
            @csrf
            <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
            <div class="mb-3">
                <label for="nombreUni" class="form-label">Universidad</label>
                <input type="text" class="form-control" id="nombreUni" name="nombreUni" required>
            </div>
            <div class="mb-3">
                <label for="carrera" class="form-label">Carrera</label>
                <input type="text" class="form-control" id="carrera" name="carrera" required>
            </div>
            <div class="mb-3">
                <label for="fechaEgreso" class="form-label">Fecha de Egreso</label>
                <input type="date" class="form-control" id="fechaEgreso" name="fechaEgreso">
                <small class="form-text text-muted">Dejar vacío si aún estudia.</small>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Estudio</button>
        </form>

        <hr>

        {{-- Agregar Profesión --}}
        <h4>Agregar Profesión</h4>
        <form method="POST" action="{{ route('candidato.candidato_profesiones.store') }}">
            @csrf
            <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
            <div class="mb-3">
                <label for="profesion_id" class="form-label">Profesión</label>
                <select class="form-control" id="profesion_id" name="profesion_id" required>
                    <option value="">Seleccione una profesión</option>
                    @foreach ($candidato->candidatoProfesiones as $profesion)
                        <option value="{{ $profesion->id }}">{{ $profesion->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Profesión</button>
        </form>
    </div>
@endsection
