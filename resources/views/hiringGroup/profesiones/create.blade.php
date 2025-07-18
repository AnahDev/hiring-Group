@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h2>Agregar nueva Profesion</h2>
    </div>
    <div class="form-card">
        <h3 style="padding: 1rem; border-bottom: 1px solid #eee; margin-bottom: 1rem; font-weight: bold;">
            Nombre de la Profesion
        </h3>
        <div class="card-body">
            <form action="{{ route('hiringGroup.profesiones.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    {{-- <label for="nombreProfesion" class="form-label">Nombre de la
                        Profesion</label> --}}
                    <input type="text" class="form-control" placeholder="Escribe aqui..." id="descripcion"
                        name="descripcion" value="{{ old('descripcion') }}" required>
                    @error('descripcion')
                        <div style="color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Profesion
                    </button>
                    <a href="{{ route('hiringGroup.profesiones.index') }}" class="btn-action"
                        style="background-color: #6c757d; color: white;">
                        &larr; Volver al Listado
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection
