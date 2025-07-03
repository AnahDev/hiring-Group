<form method="GET" action="{{ route('candidato.ofertas.index') }}" class="row g-3">
    <div class="col-md-3">
        <select name="cargo" class="form-select">
            <option value="">-- Cargo --</option>
            @foreach ($cargos as $cargo)
                <option value="{{ $cargo }}" {{ request('cargo') == $cargo ? 'selected' : '' }}>
                    {{ $cargo }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <input type="text" name="ubicacion" class="form-control" placeholder="Ubicación"
            value="{{ request('ubicacion') }}">
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <a href="{{ route('candidato.ofertas.index') }}" class="btn btn-secondary">Limpiar</a>
    </div>
</form>
