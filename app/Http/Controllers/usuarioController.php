<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;

class usuarioController extends Controller
{
    public function index()
    {
        $usuario = usuario::all();
        return view('usuarios.index', compact('usuario'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email|max:255|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
            'tipo' => 'required|in:admin,hiringGroup,empresa,candidato,contratado',
            'fechaRegistro' => 'nullable|date',
        ]);

        // Crear un nuevo usuario
        usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encriptar la contraseña
            'tipo' => $request->tipo,
            'fechaRegistro' => $request->now(),
        ]);

        return redirect()->route('usuarios.index');
    }

    public function show(string $id)
    {
        $usuario = usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(string $id)
    {
        $usuario = usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email|max:255|unique:usuarios,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'tipo' => 'required|in:admin,hiringGroup,empresa,candidato,contratado',
            'fechaRegistro' => 'nullable|date',
        ]);

        // Actualizar el usuario
        $usuario = usuario::findOrFail($id);
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password); // Encriptar la contraseña si se proporciona
        }
        $usuario->tipo = $request->tipo;
        $usuario->fechaRegistro = now();
        $usuario->save();

        return redirect()->route('usuarios.index');
    }

    public function destroy(string $id)
    {
        $usuario = usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index');
    }
}
