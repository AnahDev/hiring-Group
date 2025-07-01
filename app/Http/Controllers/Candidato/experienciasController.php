<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use App\Models\estudio;
use App\Models\experienciaLaboral;
use App\Models\ofertaLaboral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class experienciasController extends Controller
{

    public function index()
    {
        $candidato = Auth::user()->candidato;
        $experiencias = $candidato->experienciasLaborales()->orderBy('fechaInicio', 'desc')->paginate(10);
        return view('candidato.experiencias.index', compact('experiencias'));
    }

    public function create()
    {
        return view('candidato.experiencias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'empresa' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
        ]);

        $candidato = Auth::user()->candidato;
        $candidato->experienciasLaborales()->create($request->all());

        return redirect()->route('candidato.perfil.edit')->with('success', 'Experiencia laboral añadida.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(experienciaLaboral $experienciaLaboral)
    {
        $experienciaLaboral = Auth::user()->candidato;
        $this->authorize('update', $experienciaLaboral);
        return view('candidato.perfil.edit', compact('candidato'));
    }

    public function update(Request $request, ofertaLaboral $ofertaLaboral)
    {
        $this->authorize('update', $ofertaLaboral); // Usamos la Policy que creamos

        $request->validate([
            'empresa' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
        ]);

        $ofertaLaboral->update($request->all());
        return redirect()->route('candidato.perfil.edit')->with('success', 'Oferta laboral actualizada.');
    }
    public function destroy(ofertaLaboral $ofertaLaboral)
    {
        $this->authorize('delete', $ofertaLaboral); // Usamos la Policy
        $ofertaLaboral->delete();
        return redirect()->route('candidato.perfil.edit')->with('success', 'Experiencia Laboral eliminada.');
    }
}
