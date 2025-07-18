@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h2 class="page-title">Agregar Nuevo Banco</h2>
    </div>
    <a href="{{ route('hiringGroup.bancos.index') }}" class="btn-action" style="margin-bottom: 1rem;">
        &larr; Volver al Listado
    </a>
    <div class="form-card">
        <div>
            <h3 style="padding: 1rem; border-bottom: 1px solid #eee; margin-bottom: 1rem; font-weight: bold;">Información
                del Banco</h3>
        </div>
        <div class="card-body"> {{-- card-body aquí es solo para estructura, no tiene estilo CSS directo --}}
            <form action="{{ route('hiringGroup.bancos.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombreBanco" class="form-label">Nombre del Banco</label>
                    <input type="text" class="form-control" id="nombreBanco" name="nombreBanco"
                        value="{{ old('nombreBanco') }}" required>
                    @error('nombreBanco')
                        <div style="color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="submit-btn">
                    Guardar Banco
                </button>

            </form>
        </div>
    </div>
@endsection
