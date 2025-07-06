@extends('layouts.app')

@section('content')
    {{-- Agregar Profesión --}}
    <h4>Agregar Profesión</h4>
    <form method="POST" action="{{ route('candidato.candidato_profesiones.store') }}">
        @csrf
        <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
        <div class="mb-3">
            <label for="profesion_id" class="form-label">Profesión</label>
            <select class="form-control" id="profesion_id" name="profesion_id" required>
                <option value="">Seleccione una profesión</option>
                @foreach ($profesiones as $profesion)
                    <option value="{{ $profesion->id }}">{{ $profesion->descripcion }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Profesión</button>
    </form>
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Profesiones</h4>
            @if (isset($candidato->candidatoProfesiones) && $candidato->candidatoProfesiones->count())
                <ul>
                    @foreach ($candidato->candidatoProfesiones as $profesion)
                        <li>{{ $profesion->profesion->descripcion }}</li>
                    @endforeach
                </ul>
            @else
                <p>No hay profesiones registradas.</p>
            @endif
        </div>
    </div>
@endsection
