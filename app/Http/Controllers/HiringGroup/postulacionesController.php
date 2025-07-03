<?php

namespace App\Http\Controllers\HiringGroup;

use App\Http\Controllers\Controller;
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

        return view('hiringGroup.contrataciones.postulaciones', compact('postulaciones'));
    }
}
