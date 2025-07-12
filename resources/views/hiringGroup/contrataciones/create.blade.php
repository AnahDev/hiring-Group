@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="section-heading">Crear Contrato para {{ $postulacion->candidato->nombre }}</h2>

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                <strong style="font-weight: bold;">¡Ups! Hubo algunos problemas con tu entrada.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('hiringGroup.contratacion.store', $postulacion) }}" class="card">
            @csrf
            <div class="form-grid cols-2">
                <div class="form-group">
                    <label for="salarioMensual" class="form-label">Salario Mensual</label>
                    <input type="number" step="0.01" name="salarioMensual" class="form-control" required>
                    <label for="tipoSangre" class="form-label">Tipo de Sangre</label>
                    <input type="text" name="tipoSangre" class="form-control" required>
                    <label for="tlfEmergencia" class="form-label">Teléfono de Emergencia</label>
                    <input type="text" name="tlfEmergencia" class="form-control" required>
                    <label for="contactoEmergencia" class="form-label">Contacto de Emergencia</label>
                    <input type="text" name="contactoEmergencia" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" name="fechaInicio" class="form-control" required>
                    <label for="fechaFin" class="form-label">Fecha de Fin</label>
                    <input type="date" name="fechaFin" class="form-control">
                    {{-- CAMBIO AQUÍ: Input de número a campo de selección --}}
                    <div class="form-group">
                        <label for="duracion" class="form-label">Duración</label>
                        <select name="duracion" id="duracion" class="form-control" required>
                            <option value="">Selecciona la duración</option>
                            @foreach ($duracionOpciones as $opcion)
                                <option value="{{ $opcion }}" {{ old('duracion') == $opcion ? 'selected' : '' }}>
                                    {{ $opcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{--        <label for="duracion" class="form-label">Duración (meses)</label>
                    <input type="number" name="duracion" class="form-control" required> --}}
                </div>
                <div class="form-group"> <label for="cuentaBanco" class="form-label">Cuenta Bancaria</label>
                    <input type="text" name="cuentaBanco" class="form-control">
                </div>
                <div class="form-group">
                    <label for="banco_id" class="form-label">Banco</label>
                    <select name="banco_id" class="form-control">
                        @foreach ($bancos as $banco)
                            <option value="{{ $banco->id }}">{{ $banco->nombreBanco }}</option>
                        @endforeach
                    </select>
                </div>
            </div> {{-- Cierre de form-section --}}
            <div class="form-actions" style="justify-content: flex-start;">
                <button type="submit" class="btn btn-primary">Crear Contrato</button>
            </div>
        </form>
    </div>
@endsection
