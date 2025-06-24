<?php

namespace App\Http\Controllers;


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
            return redirect()->intended('home'); // Redirige a la página de inicio
        }
        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas no son válidas.',
        ]);
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
