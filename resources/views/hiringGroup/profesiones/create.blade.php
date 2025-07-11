@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="margin-bottom: 1.5rem;">Agregar nueva Profesion</h1>

        <div class="card">
            <div style="padding: 1rem; border-bottom: 1px solid #eee; margin-bottom: 1rem; font-weight: bold;">
                Información de la Profesion
            </div>
            <div class="card-body">
                <form action="{{ route('hiringGroup.profesiones.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombreProfesion" style="display: block; margin-bottom: 0.5rem;">Nombre de la
                            Profesion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion"
                            value="{{ old('descripcion') }}" required>
                        @error('descripcion')
                            <div style="color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Profesion
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
