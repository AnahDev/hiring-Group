@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="margin-bottom: 1.5rem;">Crear Nuevo Banco</h1>

        <div class="card">
            <div style="padding: 1rem; border-bottom: 1px solid #eee; margin-bottom: 1rem; font-weight: bold;">
                Información del Banco
            </div>
            <div class="card-body"> {{-- card-body aquí es solo para estructura, no tiene estilo CSS directo --}}
                <form action="{{ route('hiringGroup.bancos.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombreBanco" style="display: block; margin-bottom: 0.5rem;">Nombre del Banco</label>
                        <input type="text" class="form-control" id="nombreBanco" name="nombreBanco"
                            value="{{ old('nombreBanco') }}" required>
                        @error('nombreBanco')
                            <div style="color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Banco
                    </button>
                    <a href="{{ route('hiringGroup.bancos.index') }}" class="btn"
                        style="background-color: #6c757d; color: white;">
                        <i class="fas fa-arrow-left"></i> Volver al Listado
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
