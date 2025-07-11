@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="margin-bottom: 1.5rem;">Editar profesión: {{ $profesion->descripcion }}</h1>

        <div class="card">
            <div style="padding: 1rem; border-bottom: 1px solid #eee; margin-bottom: 1rem; font-weight: bold;">
                Información de la Profesión
            </div>
            <div class="card-body">
                <form action="{{ route('hiringGroup.profesiones.update', $profesion->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="descripcion" style="display: block; margin-bottom: 0.5rem;">Descripción de la
                            Profesión</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion"
                            value="{{ old('descripcion', $profesion->descripcion) }}" required>
                        @error('descripcion')
                            <div style="color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sync-alt"></i> Actualizar Profesión
                    </button>
                    <a href="{{ route('hiringGroup.profesiones.index') }}" class="btn"
                        style="background-color: #6c757d; color: white;">
                        <i class="fas fa-arrow-left"></i> Volver al Listado
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
