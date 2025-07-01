<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
