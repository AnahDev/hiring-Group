<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use App\Models\ofertaLaboral;
use App\Models\profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ofertaLaboralController extends Controller
{
    //Filtrar por área de conocimiento (profesion) y estado del país (ubicacion)
    public function index(Request $request)
    {
        $query = ofertaLaboral::where('estado', 'activa');

        // Filtrado condicional por profesión
        $query->when($request->profesion_id, function ($q, $profesion_id) {
            return $q->where('profesion_id', $profesion_id);
        });

        // Filtrado condicional por cargo
        $query->when($request->cargo, function ($q, $cargo) {
            return $q->where('cargo', $cargo);
        });

        // Filtrado condicional por ubicación
        $query->when($request->ubicacion, function ($q, $ubicacion) {
            return $q->where('ubicacion', 'like', "%{$ubicacion}%");
        });

        $ofertas = $query->with('profesion', 'empresa')->latest()->paginate(10);

        // Traer todos los cargos únicos para el combobox
        $cargos = ofertaLaboral::select('cargo')->distinct()->pluck('cargo');

        return view('candidato.ofertas.index', compact('ofertas', 'cargos'));
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
