<?php

namespace App\Http\Controllers;

use App\Models\empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{

    public function index()
    {
        $empresa = empresa::all();
        return view('empresas.index', compact('empresa'));
    }


    public function create()
    {
        return view('empresas.create');
    }


    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id', // Asegurarse de que el usuario existe
            'nombre' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255|unique:empresas,email',
        ]);

        // Crear una nueva empresa
        empresa::create($request->all());

        return redirect()->route('empresas.index');
    }

    public function show(string $id)
    {
        $empresa = empresa::findOrFail($id);
        return view('empresa.show', compact('empresa'));
    }

    public function edit(string $id)
    {
        $empresa = empresa::findOrFail($id);
        return view('empresas.edit', compact('empresa'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id', // Asegurarse de que el usuario existe
            'nombre' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255|unique:empresas,email,' . $id, // Excluir el ID actual de la validación única
        ]);

        empresa::findOrFail($id)->update($request->all());

        return redirect()->route('empresas.index');
    }

    public function destroy(string $id)
    {
        $empresa = empresa::findOrFail($id);
        $empresa->delete();
        return redirect()->route('empresas.index')->with('success', 'Empresa eliminada correctamente.');
    }

    public function showPasswordForm()
    {
        return view('empresa.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'new_password.confirmed' => 'La confirmación de la nueva contraseña no coincide.',
        ]);

        $user = Auth::user();
        // Verifica la contraseña actual
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'La contraseña actual no es correcta.');
        }

        // Actualiza la contraseña
        $user->password = bcrypt($request->new_password);

        if ($user && method_exists($user, 'save')) {
            $user->password = bcrypt($request->new_password);
            $user->save();

            return back()->with('success', '¡Contraseña actualizada correctamente!');
        } else {
            return back()->with('error', 'No se pudo actualizar la contraseña. El usuario autenticado no es un modelo válido.');
        }
    }
}
