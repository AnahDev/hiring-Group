<form method="GET" action="{{ route('candidato.ofertas.index') }}" class="row g-3">
    <div class="col-md-3">
        <input type="text" name="cargo" class="form-control" placeholder="Cargo" value="{{ request('cargo') }}">
    </div>
    <div class="col-md-3">
        <input type="text" name="ubicacion" class="form-control" placeholder="Ubicación"
            value="{{ request('ubicacion') }}">
    </div>
    <div class="col-md-3">
        <select name="estado" class="form-select">
            <option value="">-- Estado --</option>
            <option value="activa" {{ request('estado') == 'activa' ? 'selected' : '' }}>Activa</option>
            <option value="inactiva" {{ request('estado') == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
        </select>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <a href="{{ route('candidato.ofertas.index') }}" class="btn btn-secondary">Limpiar</a>
    </div>
</form>
