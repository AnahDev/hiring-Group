<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use App\Models\candidato_profesion;
use App\Models\profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class candidato_profesionController extends Controller
{

    public function index()
    {
        $candidato = Auth::user()->candidato;
        $profesiones = profesion::all();

        $candidatoProfesionesPivot = $candidato->candidatoProfesiones()->with('profesion')->get();

        // Para la vista, es útil tener una colección de los modelos Profesion directamente
        $profesionesDelCandidato = $candidatoProfesionesPivot->map(function ($pivotRecord) {
            return $pivotRecord->profesion;
        });

        return view('candidato.profesiones.index', compact('profesiones', 'candidato', 'profesionesDelCandidato'));
    }


    public function store(Request $request)
    {

        $user = Auth::user();
        $candidato = $user->candidato;

        $request->validate([
            'profesion_id' => [
                'required',
                'exists:profesion,id',
                // Regla personalizada para verificar si la combinación Candidato-Profesion ya existe en la tabla pivote
                function ($attribute, $value, $fail) use ($candidato) {
                    if (candidato_profesion::where('candidato_id', $candidato->id)
                        ->where('profesion_id', $value)
                        ->exists()
                    ) {
                        $fail('Esta profesión ya ha sido añadida a tu perfil.');
                    }
                },
            ],
        ]);

        $profesionId = $request->input('profesion_id');

        // *** AHORA CREAMOS UN NUEVO REGISTRO EN LA TABLA PIVOTE DIRECTAMENTE ***
        candidato_profesion::create([
            'candidato_id' => $candidato->id,
            'profesion_id' => $profesionId,
        ]);
        return redirect()->route('candidato.profesiones.index')
            ->with('success', 'Profesión añadida correctamente.');
    }


    public function destroy(profesion $profesion)
    {
        $user = Auth::user();
        $candidato = $user->candidato;

        // *** AHORA BUSCAMOS Y ELIMINAMOS EL REGISTRO ESPECÍFICO EN LA TABLA PIVOTE ***
        candidato_profesion::where('candidato_id', $candidato->id)
            ->where('profesion_id', $profesion->id)
            ->delete();

        return redirect()->route('candidato.profesiones.index')
            ->with('success', 'Profesión eliminada correctamente.');
    }
}
