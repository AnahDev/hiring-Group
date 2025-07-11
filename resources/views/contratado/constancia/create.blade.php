@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Solicitar Constancia de Trabajo</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <p>Haz clic en el botón para generar tu constancia de trabajo.</p>

        <form action="{{ route('contratado.constancia.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Generar Constancia</button>
        </form>
    </div>
@endsection
