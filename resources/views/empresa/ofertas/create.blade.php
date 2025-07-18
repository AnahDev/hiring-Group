@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2>Crear Nueva Oferta Laboral</h2>
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario para crear oferta --}}
        <div class="form-card">
            <form action="{{ route('empresa.ofertas.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="profesion_id" class="form-label">Profesión:</label>
                    <select class="form-control" id="profesion_id" name="profesion_id" required>
                        <option value="">Seleccione una profesión</option>
                        @foreach ($profesiones as $profesion)
                            <option value="{{ $profesion->id }}"
                                {{ old('profesion_id') == $profesion->id ? 'selected' : '' }}>
                                {{ $profesion->descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="cargo" class="form-label">Cargo Vacante:</label>
                    <input type="text" class="form-control" id="cargo_vacante" name="cargo" value="{{ old('cargo') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="descripcion" class="form-label">Descripción del Perfil:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="salario" class="form-label">Salario Ofrecido: </label>
                    <input type="number" step="0.01" class="form-control" id="salario_ofrecido" name="salario"
                        value="{{ old('salario') }}" required>
                </div>

                <div class="form-group">
                    <label for="ubicacion" class="form-label">Ubicación:</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion"
                        value="{{ old('ubicacion') }}">
                </div>


                <div class="checkBox ">
                    <input type="checkbox" class="checkBox" id="estado" name="estado" value="1"
                        {{ old('estado', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="estado">Activa</label>
                </div>

                <div style="display:flex;  align-items: center; justify-content: space-between;">
                    <button type="submit" class="btn btn-primary">Crear Oferta</button>
                    <a href="{{ route('empresa.ofertas.index') }}" class="btn btn-danger">Cancelar</a>
                </div>

            </form>

        </div>

    </div>
@endsection
