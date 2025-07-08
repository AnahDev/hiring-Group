<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
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

        return redirect()->route('candidato.experiencias.index')->with('success', 'Experiencia laboral añadida.');
    }

    public function edit(experienciaLaboral $experienciaLaboral)
    {
        $candidato = Auth::user()->candidato;
        $this->authorize('update', $experienciaLaboral);
        return view('candidato.experiencias.edit', compact('candidato', 'experienciaLaboral'));
    }

    public function update(Request $request, experienciaLaboral $experienciaLaboral)
    {
        $this->authorize('update', $experienciaLaboral); // Usamos la Policy que creamos

        $request->validate([
            'empresa' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
        ]);

        $experienciaLaboral->update($request->all());
        return redirect()->route('candidato.experiencias.index')->with('success', 'Oferta laboral actualizada.');
    }
    public function destroy(experienciaLaboral $experienciaLaboral)
    {
        $this->authorize('delete', $experienciaLaboral); // Usamos la Policy
        $experienciaLaboral->delete();
        return redirect()->route('candidato.experiencias.index')->with('success', 'Experiencia Laboral eliminada.');
    }
}
