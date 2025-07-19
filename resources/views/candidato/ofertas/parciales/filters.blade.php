<div class="">
    <form method="GET" action="{{ route('candidato.ofertas.index') }}" class="row g-3">

        <div class="grid-sec">

            <div class="form-group">
                <div class="select-container">

                    <select name="cargo" class="form-select">
                        <option value="" disabled selected>-- Buscar por Cargo... --</option>
                        @foreach ($cargos as $cargo)
                            <option value="{{ $cargo }}" {{ request('cargo') == $cargo ? 'selected' : '' }}>
                                {{ $cargo }}</option>
                        @endforeach
                    </select>
                    <i data-lucide="chevron-down" class="select-icon"></i>
                </div>
            </div>

            <div class="form-group">
                <div class="select-container">
                    <select name="profesion_id" class="form-select">
                        <option value="" disabled selected>-- Buscar por Profesion --</option>
                        @foreach ($profesiones as $profesion)
                            <option value="{{ $profesion->id }}"
                                {{ request('profesion_id') == $profesion->id ? 'selected' : '' }}>
                                {{ $profesion->descripcion }}</option>
                        @endforeach
                    </select>
                    <i data-lucide="chevron-down" class="select-icon"></i>
                </div>
            </div>

            <div class="form-group">
                <input type="text" name="ubicacion" class="form-control" placeholder="Ubicación"
                    value="{{ request('ubicacion') }}" style="width: 80%;">
            </div>

        </div>


        <div style="display: flex; gap: 10px; justify-content:center; margin-top:-15px; margin-bottom: 15px;">
            <button type="submit" class="btn btn-primary">&#128269; <strong>Filtar</strong></button>
            <a href="{{ route('candidato.ofertas.index') }}" class="btn btn-danger">Limpiar</a>
        </div>
    </form>
</div>
