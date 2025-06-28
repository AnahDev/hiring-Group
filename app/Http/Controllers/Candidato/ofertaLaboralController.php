<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use App\Models\ofertaLaboral;
use App\Models\profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ofertaLaboralController extends Controller
{
    /*  public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role:candidato'); // O un middleware más específico
    } */

    //muestra la oferta laboral asociada una empresa
    public function index(Request $request)
    {
        $query = ofertaLaboral::with(['empresa', 'profesion']);

        // Lógica de filtrado por profesión y ubicación
        if ($request->has('profesion_id') && $request->profesion_id) {
            $query->where('profesion_id', $request->profesion_id);
        }
        if ($request->has('ubicacion') && $request->ubicacion) {
            $query->where('ubicacion', 'like', '%' . $request->ubicacion . '%');
        }

        // Mostrar solo ofertas activas para candidatos
        $query->where('estado', 'activa');

        $ofertasLaborales = $query->get();
        $profesiones = Profesion::all(); // Para el filtro de profesiones en la vista

        return view('candidato.ofertas.index', compact('ofertasLaborales', 'profesiones'));
    }

    public function show(ofertaLaboral $ofertaLaboral)
    {
        $ofertaLaboral->load('empresa', 'profesion');
        return view('candidato.ofertas.show', compact('ofertaLaboral'));
    }
}
