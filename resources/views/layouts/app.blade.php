<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Incluye los assets compilados por Vite -->
    {{-- @vite('public/css/styles.css') --}}
    @vite('resources/css/app.css')

    {{-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> --}}

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

</head>

{{-- <body>
    <div id="app">
        @yield('content')
    </div>
</body> --}}

<body>
    <div style="display: flex; min-height: 100vh;">
        <x-menu-lateral />
        {{-- Contenido principal --}}
        <main style="flex:1; padding:10px; background-color: #f5f7fa;">
            @yield('content')
        </main>
    </div>
</body>

</html>
