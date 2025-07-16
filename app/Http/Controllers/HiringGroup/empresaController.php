<?php

namespace App\Http\Controllers\HiringGroup;

use App\Http\Controllers\Controller;
use App\Models\empresa;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class empresaController extends Controller
{
    public function index()
    {
        // Usamos 'with' para cargar la relación y evitar problemas de N+1.
        // Usamos el nombre de variable en plural '$empresas' para la colección.
        $empresas = empresa::with('usuario')->get();
        return view('hiringGroup.empresas.index', compact('empresas'));
    }


    public function create()
    {
        return view('hiringGroup.empresas.create');
    }


    public function store(Request $request)
    {
        // Validar los datos del formulario para el usuario y la empresa
        $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255|unique:empresa,email',
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
        return view('hiringGroup.empresas.show', compact('empresa'));
    }

    public function edit(empresa $empresa)
    {
        return view('hiringGroup.empresas.edit', compact('empresa'));
    }

    public function update(Request $request, empresa $empresa)
    {

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
}
