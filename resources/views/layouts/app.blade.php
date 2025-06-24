<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Incluye los assets compilados por Vite -->
    @vite('resources/css/app.css')
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
        <main style="flex:1; padding: 32px;">
            @yield('content')
        </main>
    </div>
</body>

</html>
