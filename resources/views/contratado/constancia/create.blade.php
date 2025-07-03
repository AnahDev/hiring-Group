@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Solicitar Constancia de Trabajo</h2>
        <form method="POST" action="{{ route('contratado.constancia.store') }}">
            @csrf
            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo o Destinatario (opcional)</label>
                <input type="text" name="motivo" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Solicitar Constancia</button>
        </form>
    </div>
@endsection
