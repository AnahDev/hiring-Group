<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use App\Models\Estudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstudioController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    //Agregar una nueva formación académica
    public function store(Request $request)
    {
        $request->validate([
            'nombreUni' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
            'fechaEgreso' => 'required|date',
        ]);

        $candidato = Auth::user()->candidato;
        $candidato->estudios()->create($request->all());

        return redirect()->route('candidato.perfil.edit')->with('success', 'Formación académica añadida.');
    }

    // Modificar una formación académica.
    public function show(Request $request, estudio $estudio)
    {
        //
    }

    public function edit(Estudio $estudio)
    {
        //
    }

    public function update(Request $request, Estudio $estudio)
    {
        $this->authorize('update', $estudio); // Usamos la Policy que creamos

        $request->validate([
            'nombreUni' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
            'fechaEgreso' => 'required|date',
        ]);

        $estudio->update($request->all());

        return redirect()->route('candidato.perfil.edit')->with('success', 'Formación académica actualizada.');
    }

    //Eliminar una formación académica.
    public function destroy(estudio $estudio)
    {
        $this->authorize('delete', $estudio); // Usamos la Policy
        $estudio->delete();
        return redirect()->route('candidato.perfil.edit')->with('success', 'Formación académica eliminada.');
    }
}
