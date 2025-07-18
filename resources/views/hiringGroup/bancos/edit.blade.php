@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h2 class="page-title">Editar Banco: {{ $banco->nombreBanco }}</h2>
    </div>

    <div class="form-card">
        <div class="card">
            <div style="padding: 1rem; border-bottom: 1px solid #eee; margin-bottom: 1rem; font-weight: bold;">
                <h3>Información del Banco</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('hiringGroup.bancos.update', $banco->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nombreBanco" style="display: block; margin-bottom: 0.5rem;">Nombre del Banco</label>
                        <input type="text" class="form-control" id="nombreBanco" name="nombreBanco"
                            value="{{ old('nombreBanco', $banco->nombreBanco) }}" required>
                        @error('nombreBanco')
                            <div style="color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sync-alt"></i> Actualizar Banco
                        </button>
                        <a href="{{ route('hiringGroup.bancos.index') }}" class="btn-action"
                            style="background-color: #6c757d; color: white;">
                            &larr; Volver al Listado
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
