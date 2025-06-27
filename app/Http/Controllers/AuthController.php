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

            if (Auth::user()->tipo === 'admin') {
                return redirect()->intended('/admin'); // Redirige al panel de administración
            } elseif (Auth::user()->tipo === 'hiringGroup') {
                return redirect()->intended('/hiringGroup'); // Redirige al panel de hiringGroup
            } elseif (Auth::user()->tipo === 'empresa') {
                return redirect()->intended('/empresa'); // Redirige al panel de empresa
            } elseif (Auth::user()->tipo === 'candidato') {
                return redirect()->intended('/candidato'); // Redirige al panel de candidato
            } elseif (Auth::user()->tipo === 'contratado') {
                return redirect()->intended('/contratado'); // Redirige al panel de contratado
            }


            return redirect()->intended('/home'); // Redirige a la página de inicio
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

        // Iniciar sesión automáticamente después del registro
        Auth::login($usuario);
        if ($usuario->tipo === 'empresa') {
            return redirect('/empresa')->with('success', 'Cuenta creada exitosamente.');
        } elseif ($usuario->tipo === 'candidato') {
            return redirect('/candidato')->with('success', 'Cuenta creada exitosamente.');
        } elseif ($usuario->tipo === 'contratado') {
            return redirect('/contratado')->with('success', 'Cuenta creada exitosamente.');
        }
        return redirect('/home')->with('success', 'Cuenta creada exitosamente.');
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
