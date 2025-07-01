<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use App\Models\ofertaLaboral;
use App\Models\postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class postulacionesController extends Controller
{
    // Mostrar todas las ofertas a las que ha aplicado, ordenadas por fecha.
    public function index()
    {
        $candidato = Auth::user()->candidato;
        $postulaciones = postulacion::where('candidato_id', $candidato->id)
            ->with('ofertaLaboral.empresa', 'ofertaLaboral.profesion') // Cargar relaciones para mostrar info útil
            ->paginate(15);
        return view('candidato.postulaciones.index', compact('postulaciones'));
    }

    public function create(ofertaLaboral $ofertaLaboral)
    {
        //
    }

    // Aplicar a una oferta de empleo.
    public function store(ofertaLaboral $ofertaLaboral)
    {
        $candidato = Auth::user()->candidato;

        // 1. Verificar que el candidato no haya aplicado ya a esta oferta
        $yaAplico = postulacion::where('candidato_id', $candidato->id)
            ->where('oferta_laboral_id', $ofertaLaboral->id)
            ->exists();

        if ($yaAplico) {
            return redirect()->back()->with('error', 'Ya has aplicado a esta oferta.');
        }

        // 2. Crear la postulación
        postulacion::create([
            'candidato_id' => $candidato->id,
            'oferta_laboral_id' => $ofertaLaboral->id,
            'fechaPostulacion' => now(),
        ]);
        return redirect()->route('candidato.ofertas.show', $ofertaLaboral)->with('success', '¡Has aplicado a la oferta exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(postulacion $postulacion)
    {

        return redirect()->route('candidato.postulaciones.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
