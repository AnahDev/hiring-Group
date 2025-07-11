<!-- filepath: c:\xampp\htdocs\Laravel\hiring-group\resources\views\auth\registrar.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de Usuario</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    @vite('resources/css/styles.css')
</head>

<body>
    <div class="contenedor-formulario contenedor">
        <div class="imagen-formulario">
            <img src="{{ asset('img/bg.jpg') }}" alt="Imagen de fondo">
        </div>

        <form class="formulario" method="POST" action="{{ route('registrar') }}">
            @csrf
            <div class="texto-formulario">
                <h2>Hiring Group C.A</h2>
                <p>Regístrate con tus datos</p>
            </div>
            <div class="input">
                <label for="correo">Correo</label>
                <input placeholder="Ingresa tu correo" type="email" id="correo" name="correo"
                    value="{{ old('correo') }}" required>
                @error('correo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input">
                <label for="password">Contraseña</label>
                <input placeholder="Ingresa tu contraseña" type="password" id="password" name="password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input placeholder="Confirma tu contraseña" type="password" id="password_confirmation"
                    name="password_confirmation" required>
            </div>
            <div class="input">
                <label for="tipo">Tipo de usuario</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecciona un tipo</option>
                    <option value="empresa" {{ old('tipo') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                    <option value="candidato" {{ old('tipo') == 'candidato' ? 'selected' : '' }}>Candidato</option>
                </select>
                @error('tipo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input">
                <input type="submit" value="Registrarse">
            </div>
            <div class="crear-cuenta">
                <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
            </div>
        </form>
    </div>
</body>

</html>
