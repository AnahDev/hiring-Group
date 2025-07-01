<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use App\Models\empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{

    public function index()
    {
        // Usamos 'with' para cargar la relación y evitar problemas de N+1.
        // Usamos el nombre de variable en plural '$empresas' para la colección.
        $empresas = empresa::with('usuario')->get();
        return view('empresa.index', compact('empresas'));
    }


    public function create()
    {
        return view('empresa.create');
    }


    public function store(Request $request)
    {
        // Validar los datos del formulario para el usuario y la empresa
        $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255|unique:empresa,email', // Tabla es 'empresa'
            'user_email' => 'required|email|max:255|unique:usuario,correo',
            'user_password' => 'required|string|min:6|confirmed',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Crear el usuario para la empresa
            $user = usuario::create([
                'correo' => $request->input('user_email'),
                'password' => bcrypt($request->input('user_password')),
                'tipo' => 'empresa',
                'fechaRegistro' => now(),
            ]);

            // 2. Crear la empresa y asociar el usuario
            // Nota: Asegúrate de tener la relación hasOne('empresa') en tu modelo Usuario.
            $user->empresa()->create([
                'nombre' => $request->input('nombre'),
                'email' => $request->input('email'),
            ]);
        });

        return redirect()->route('hiringGroup.empresas.index')->with('success', 'Empresa y usuario creados exitosamente.');
    }

    public function show(empresa $empresa)
    {
        return view('empresa.show', compact('empresa')); // Asegúrate que esta vista exista

        // $empresas = Empresa::with(['contactos'])->get();

        // return view('empresa.show', compact('empresas'));
    }

    public function edit(empresa $empresa)
    {
        return view('empresa.edit', compact('empresa'));
    }

    public function update(Request $request, empresa $empresa)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255|unique:empresa,email,' . $empresa->id,
        ]);

        $empresa->update($request->only(['nombre', 'email']));

        return redirect()->route('hiringGroup.empresas.index')->with('success', 'Empresa actualizada correctamente.');
    }

    public function destroy(empresa $empresa)
    {
        $empresa->delete();
        return redirect()->route('hiringGroup.empresas.index')->with('success', 'Empresa eliminada correctamente.');
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
        $user->save();

        return back()->with('success', '¡Contraseña actualizada correctamente!');
    }
}
