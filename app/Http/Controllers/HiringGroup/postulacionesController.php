<?php

namespace App\Http\Controllers\HiringGroup;

use App\Http\Controllers\Controller;
use App\Models\ofertaLaboral;
use App\Models\postulacion;
use Illuminate\Http\Request;

class postulacionesController extends Controller
{
    public function index()
    {
        $postulaciones = postulacion::with([
            'candidato',
            'ofertaLaboral.empresa'
        ])->get();

        return view('hiringGroup.postulaciones.index', compact('postulaciones'));
    }


    public function show(postulacion $postulacion)
    {
        // Recibe una oferta, carga sus postulaciones con la información del candidato y muestra una vista con la lista.
        $postulaciones = $postulacion->postulaciones()->with('candidato.usuario')->get();
        return view('hiringGroup.contrataciones.postulantes', compact('postulaciones'));
    }
}
