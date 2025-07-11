<?php

namespace App\Http\Controllers\Contratado;

use App\Http\Controllers\Controller;
use App\Models\candidato;
use App\Models\profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class perfilController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $candidato = $user->candidato; // Obtiene el perfil del candidato del usuario autenticado

        // Si el candidato no tiene un perfil creado, lo redirigimos a la página de creación
        if (!$candidato) {
            return redirect()->route('contratado.perfil.create')->with('info', 'Tu perfil no está completo. Por favor, complétalo para ver tu currículum.');
        }

        // Cargar todas las relaciones necesarias para mostrar el currículum completo
        $candidato->load([
            'telefonos',
            'experienciasLaborales',
            'estudios',
            'candidatoProfesiones.profesion' // Asegúrate de que 'profesion' es el nombre de la relación en CandidatoProfesion
        ]);

        return view('contratado.perfil.curriculum', compact('candidato'));
    }

    public function edit(candidato $candidato)
    {
        $usuario = Auth::user()->candidato;
        $profesiones = profesion::all();

        if (!$usuario) {
            return redirect()->route('contratado.dashboard')->with('error', 'Perfil no encontrado.');
        }

        return view('candidato.perfil.edit', compact('candidato', 'profesiones'));
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
            return redirect()->route('contratado.dashboard')->with('error', 'Perfil no encontrado.');
        }

        $usuario->update($request->only(['nombre', 'apellido', 'direccion']));

        return redirect()->route('contratado.dashboard')->with('success', 'Perfil actualizado correctamente.');
    }
}
