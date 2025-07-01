<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use App\Models\ofertaLaboral;
use App\Models\profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ofertaLaboralController extends Controller
{

    //muestra la oferta laboral asociada una empresa
    public function index(Request $request)
    {
        //PROBAR ESTA SI NO FUNCIONA LA OTRA
        $query = ofertaLaboral::where('estado', 'activa');

        // Filtrado condicional por profesión
        $query->when($request->profesion_id, function ($q, $profesion_id) {
            return $q->where('profesion_id', $profesion_id);
        });

        // Filtrado condicional por ubicación
        $query->when($request->ubicacion, function ($q, $ubicacion) {
            return $q->where('ubicacion', 'like', "%{$ubicacion}%");
        });

        $ofertas = $query->with('profesion', 'empresa')->latest()->paginate(10);

        // Faltarían las vistas, pero la lógica está lista
        return view('candidato.ofertas.index', compact('ofertas'));
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


    public function show(ofertaLaboral $ofertaLaboral)
    {
        // Usamos una policy para asegurar que solo se vean ofertas activas
        $this->authorize('view', $ofertaLaboral);
        return view('candidato.ofertas.show', compact('ofertaLaboral'));
    }
}
