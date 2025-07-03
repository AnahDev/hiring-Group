<?php

namespace App\Http\Controllers\HiringGroup;

use App\Http\Controllers\Controller;
use App\Models\ofertaLaboral;
use App\Models\profesion;
use Illuminate\Http\Request;

class OfertaLaboralController extends Controller
{
    // Muestra todas las ofertas laborales
    public function index()
    {
        // Aquí podrías agregar una Policy o Gate para asegurar que solo hiringGroup acceda
        $ofertasLaborales = ofertaLaboral::with(['empresa', 'profesion'])->get();
        // Vista para hiringGroup
        return view('hiringGroup.ofertas', compact('ofertasLaborales'));
    }

    public function reporteOfertasPorProfesion()
    {
        $reporte = profesion::with(['ofertas.empresa'])->withCount('ofertas')
            ->get();

        return view('hiringGroup.reportes', compact('reporte'));
    }
}
