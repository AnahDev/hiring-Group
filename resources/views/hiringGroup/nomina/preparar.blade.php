@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Preparar Nómina Mensual</h1>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        <form action="{{ route('hiringGroup.nomina.reporte') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="empresa_id" class="form-label">Empresa:</label>
                <select name="empresa_id" id="empresa_id" class="form-control" required>
                    <option value="">Seleccione una empresa</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}" {{ old('empresa_id') == $empresa->id ? 'selected' : '' }}>
                            {{ $empresa->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('empresa_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mes" class="form-label">Mes:</label>
                <select name="mes" id="mes" class="form-control" required>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ old('mes', date('n')) == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->locale('es')->monthName }}
                        </option>
                    @endfor
                </select>
                @error('mes')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="año" class="form-label">Año:</label>
                <select name="año" id="año" class="form-control" required>
                    @for ($i = date('Y') - 5; $i <= date('Y') + 1; $i++)
                        <option value="{{ $i }}" {{ old('año', date('Y')) == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
                @error('año')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Generar Reporte de Nómina</button>
        </form>
    </div>
@endsection
