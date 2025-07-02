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
        //
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,)
    {

        $request->validate([
            'candidato_id' => 'required|exists:candidato,id',
            'profesion_id' => 'required|exists:profesion,id',
        ]);

        $candidato = Auth::user()->candidato;
        $profesiones = profesion::all();
        $candidato->candidato_profesiones()->create($request->all());
        return redirect()->route('candidato.perfil.edit', $profesiones)->with('success', 'Añadido correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(candidato_profesion $candidato_profesion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(candidato_profesion $candidato_profesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, candidato_profesion $candidato_profesion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(candidato_profesion $candidato_profesion)
    {
        //
    }
}
