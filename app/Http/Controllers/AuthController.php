<?php

namespace App\Http\Controllers;


use App\Models\usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //muestra la vista del login para ingresar
    public function loginForm()
    {
        return view('auth.login');
    }

    // Maneja el inicio de sesión del usuario
    // Valida las credenciales y redirige al usuario a la página de inicio
    public function login(Request $request)
    {
        $credentials = $request->only('correo', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $tipoUsuario = Auth::user()->tipo;
            //forma de redirigir al usuario según su tipo
            $ruta = match ($tipoUsuario) {
                'admin' => route('admin.dashboard'),
                'hiringGroup' => route('hiringGroup.dashboard'),
                'empresa' => route('empresa.dashboard'),
                'candidato' => route('candidato.dashboard'),
                'contratado' => route('contratado.dashboard'),
                default => '/home',
            };
            return redirect()->intended($ruta); // Redirige a la página de inicio
        }
        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas no son válidas.',
        ]);
    }

    public function registrarUsuario()
    {
        return view('auth.registrar');
    }

    public function registrar(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'correo' => 'required|email|unique:usuario,correo',
            'password' => 'required|min:6|confirmed',
        ]);
        // Crear un nuevo usuario
        $usuario = new usuario();
        $usuario->correo = $request->input('correo');
        $usuario->password = bcrypt($request->input('password')); // Encriptar la contraseña
        $usuario->tipo = $request->input('tipo', 'candidato'); // Asignar el tipo de usuario, por defecto 'candidato' 
        $usuario->fechaRegistro = now();
        $usuario->save(); // Guardar el usuario en la base de datos

        // CAMBIO: En lugar de iniciar sesión, redirigimos al login.
        return redirect()->route('login')->with('success', '¡Cuenta creada exitosamente! Ahora puedes iniciar sesión.');
    }

    // Maneja el cierre de sesión del usuario
    // Redirige al usuario a la página de inicio después de cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login'); // Redirige a la página de inicio de sesión
    }
}
