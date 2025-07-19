@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h2 class="page-title">Editar Perfil de Candidato</h2>
    </div>
    {{-- Un único recuadro (card) para los dos formularios principales --}}
    <div class="empresa-card">
        <div class="card-header">
            <h3 class="section-heading">Datos Personales</h3>
        </div>
        <div class="card-body"> {{-- Contenedor para distribuir los dos formularios en 2 columnas --}}
            <div class="">
                {{-- Formulario de edición de perfil --}}
                <div class="card">
                    <form method="POST" action="{{ route('candidato.perfil.update', $candidato->id) }}">
                        @csrf
                        @method('PUT')

                        <fieldset style="border: 1px solid rgba(150, 148, 148, 0.617);">
                            <legend>Información Básica</legend>
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" style="width: 95%;"
                                    value="{{ old('nombre', $candidato->nombre) }}" required>
                                @error('nombre')
                                    <span
                                        style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido"
                                    style="width: 95%;" value="{{ old('apellido', $candidato->apellido) }}" required>
                                @error('apellido')
                                    <span
                                        style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                    style="width: 95%;" value="{{ old('direccion', $candidato->direccion) }}">
                                @error('direccion')
                                    <span
                                        style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="form-actions" style="justify-content: flex-start;">
                                <button type="submit" class="submit-btn">Actualizar Perfil</button>
                            </div> --}}
                        </fieldset>



                    </form>
                </div>
            </div>

            <fieldset style="margin-top:20px; border: 1px solid rgba(150, 148, 148, 0.617);">
                <legend>Información de Contacto</legend>
                <div class="card">
                    {{-- <h4 class="sub-heading">Agregar Teléfono</h4> --}}
                    <form method="POST" action="{{ route('candidato.telefonos.store') }}">
                        @csrf
                        <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
                        <div class="form-group">
                            <label for="telefono" class="form-label">Número de Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="numero" style="width: 95%;"
                                required>
                            @error('numero')
                                <span
                                    style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-actions" style="justify-content: flex-start;">
                            <button type="submit" class="submit-btn">Agregar Teléfono</button>
                        </div>
                    </form>
                </div>
            </fieldset>

            <fieldset style="margin-top:20px; border: 1px solid rgba(150, 148, 148, 0.617);">
                <legend>Información Profesional y Academica</legend>
                <div class = "card-body">
                    <div class="">
                        <div class="card">
                            <h4 class="sub-heading">Agregar Estudio Universitario</h4>
                            <form method="POST" action="{{ route('candidato.estudios.store') }}">
                                @csrf
                                <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
                                <div class="form-grid cols-2">
                                    <div class="form-group">
                                        <label for="nombreUni" class="form-label">Universidad</label>
                                        <input type="text" class="form-control" id="nombreUni" name="nombreUni" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="carrera" class="form-label">Carrera</label>
                                        <input type="text" class="form-control" id="carrera" name="carrera" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fechaEgreso" class="form-label">Fecha de Egreso</label>
                                    <input type="date" class="form-control" id="fechaEgreso" name="fechaEgreso">
                                    <small
                                        style="color: #6c757d; font-size: 0.875rem; display: block; margin-top: 0.25rem;">
                                        Dejar vacío si aún estudia.</small>
                                    @error('fechaEgreso')
                                        <span
                                            style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-actions" style="justify-content: flex-start;">
                                    <button type="submit" class="submit-btn">Agregar Estudios</button>
                                </div>
                            </form>
                        </div>

                        {{-- Agregar Experiencia Laboral --}}
                        <div class="card">
                            <h4 class="sub-heading">Agregar Experiencia Laboral</h4>
                            <form method="POST" action="{{ route('candidato.experiencias.store') }}">
                                @csrf
                                <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
                                <div class="form-grid cols-2">
                                    <div class="form-group">
                                        <label for="empresa" class="form-label">Empresa</label>
                                        <input type="text" class="form-control" id="empresa" name="empresa"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cargo" class="form-label">Cargo</label>
                                        <input type="text" class="form-control" id="cargo" name="cargo"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                                        <input type="date" class="form-control" id="fechaInicio" name="fechaInicio"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaFin" class="form-label">Fecha de Fin</label>
                                        <input type="date" class="form-control" id="fechaFin" name="fechaFin">
                                        <small
                                            style="color: #6c757d; font-size: 0.875rem; display: block; margin-top: 0.25rem;">Dejar
                                            vacío si aún trabaja aquí.</small>
                                    </div>
                                </div>
                                <div class="form-actions" style="justify-content: flex-start;">
                                    <button type="submit" class="submit-btn">Agregar Experiencia</button>
                                </div>
                            </form>
                        </div>

                        {{-- Agregar Profesión --}}
                        <div class="card">
                            <h4 class="sub-heading">Agregar Profesión</h4>
                            <form method="POST" action="{{ route('candidato.profesiones.store') }}">
                                @csrf
                                <input type="hidden" name="candidato_id" value="{{ $candidato->id }}">
                                <div class="form-group">
                                    <label for="profesion_id" class="form-label">Profesión</label>
                                    <select class="form-control" id="profesion_id" name="profesion_id" required>
                                        <option value="">Seleccione una profesión</option>


                                        @foreach ($profesiones as $profesion)
                                            <option value="{{ $profesion->id }}">{{ $profesion->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-actions" style="justify-content: flex-start;">
                                    <button type="submit" class="submit-btn">Agregar Profesión</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </fieldset>


        </div> {{-- Cierre de form-grid cols-2 --}}



        {{-- <div class="card-header">
            <h3 class="section-heading">Informacion profesional y academica</h3>
        </div> --}}

        {{-- Agregar Estudio Universitario --}}

    </div>
@endsection
