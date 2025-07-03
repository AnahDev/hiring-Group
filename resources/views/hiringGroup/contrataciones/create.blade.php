@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Crear Contrato para {{ $postulacion->candidato->nombre }}</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>¡Ups! Hubo algunos problemas con tu entrada.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('hiringGroup.contratacion.store', $postulacion) }}">
            @csrf
            <div class="mb-3">
                <label for="salarioMensual" class="form-label">Salario Mensual</label>
                <input type="number" step="0.01" name="salarioMensual" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                <input type="date" name="fechaInicio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="fechaFin" class="form-label">Fecha de Fin</label>
                <input type="date" name="fechaFin" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="duracion" class="form-label">Duración (meses)</label>
                <input type="number" name="duracion" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tipoSangre" class="form-label">Tipo de Sangre</label>
                <input type="text" name="tipoSangre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tlfEmergencia" class="form-label">Teléfono de Emergencia</label>
                <input type="text" name="tlfEmergencia" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contactoEmergencia" class="form-label">Contacto de Emergencia</label>
                <input type="text" name="contactoEmergencia" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="cuentaBanco" class="form-label">Cuenta Bancaria</label>
                <input type="text" name="cuentaBanco" class="form-control">
            </div>
            <div class="mb-3">
                <label for="banco_id" class="form-label">Banco</label>
                <select name="banco_id" class="form-control">
                    @foreach ($bancos as $banco)
                        <option value="{{ $banco->id }}">{{ $banco->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Crear Contrato</button>
        </form>
    </div>
@endsection
