<?php

namespace App\Http\Controllers\Contratado;

use App\Http\Controllers\Controller;
use App\Models\ofertaLaboral;
use Illuminate\Http\Request;

class ofertaLaboralController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ofertaLaboral::class);
        // Solo muestra ofertas activas, solo lectura para contratados
        $ofertas = ofertaLaboral::with('empresa', 'profesion')
            ->where('estado', 'activa')
            ->get();

        return view('contratado.ofertas.index', compact('ofertas'));
    }
}
