@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="page-title"> Nómina Mensual</h2>
            {{-- <p class="page-subtitle">Genere reportes de nómina para sus empresas registradas</p> --}}
        </div>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        <div class="form-card">
            <div class="form-header">
                <h1>Configurar Reporte</h1>
                <p>Seleccione los parámetros para generar el reporte de nómina</p>
            </div>

            <form id="nominaForm" action="{{ route('hiringGroup.nomina.reporte') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="empresa" class="form-label">Empresa</label>
                    <div class="select-container">
                        <select name="empresa_id" id="empresa_id" class="form-select" required>
                            <option value="">Seleccione una empresa</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}"
                                    {{ old('empresa_id') == $empresa->id ? 'selected' : '' }}>
                                    {{ $empresa->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <i data-lucide="chevron-down" class="select-icon"></i>
                    </div>

                    @error('empresa_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="mes" class="form-label">Mes</label>
                    <div class="select-container">
                        <select name="mes" id="mes" class="form-select" required>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ old('mes', date('n')) == $i ? 'selected' : '' }}>
                                    {{ Carbon\Carbon::create()->month($i)->locale('es')->monthName }}
                                </option>
                            @endfor
                        </select>
                        <i data-lucide="chevron-down" class="select-icon"></i>
                    </div>

                    @error('mes')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="año" class="form-label">Año</label>
                    <div class="select-container">
                        <select name="año" id="año" class="form-select nav-icon" required>
                            @for ($i = date('Y') - 5; $i <= date('Y') + 1; $i++)
                                <option value="{{ $i }}" {{ old('año', date('Y')) == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        <i data-lucide="chevron-down" class="select-icon"></i>
                    </div>
                    @error('año')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">
                    Generar Reporte de Nómina
                </button>
            </form>
        </div>
    </div>
@endsection

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
