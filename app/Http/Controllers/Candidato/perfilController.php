<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use App\Models\candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class perfilController extends Controller
{

    //Muestra el formulario para que el candidato complete su perfil.
    public function create()
    {
        return view('candidato.perfil.create');
    }

    //Guarda los datos básicos del perfil del candidato.
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        $usuario = Auth::user()->candidato;

        // Verificar que no tenga ya un perfil para evitar duplicados
        if ($usuario) {
            return redirect()->route('candidato.dashboard')->with('error', 'Ya tienes un perfil completo.');
        }

        // Crear el perfil del candidato asociado al usuario autenticado
        $usuario->candidato()->create($request->all());

        return redirect()->route('candidato.dashboard')->with('success', '¡Perfil completado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function edit(candidato $candidato)
    {
        $usuario = Auth::user()->candidato;

        if (!$usuario) {
            return redirect()->route('candidato.dashboard')->with('error', 'Perfil no encontrado.');
        }

        return view('candidato.perfil.edit', compact('candidato'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        $usuario = Auth::user()->candidato;

        if (!$usuario) {
            return redirect()->route('candidato.dashboard')->with('error', 'Perfil no encontrado.');
        }

        $usuario->update($request->only(['nombre', 'apellido', 'direccion']));

        return redirect()->route('candidato.dashboard')->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
