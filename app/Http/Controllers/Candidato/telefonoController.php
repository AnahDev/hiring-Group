<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use App\Models\telefono;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class telefonoController extends Controller
{

    public function store(Request $request)
    {
        Auth::user()->usuario;

        $request->validate([
            'numero' => 'required|string|max:20',
        ]);

        $candidato = Auth::user()->candidato;
        $candidato->telefonos()->create($request->all());
        return redirect()->route('candidato.perfil.edit')->with('success', 'Telefono añadido correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(telefono $telefono)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(telefono $telefono)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, telefono $telefono)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(telefono $telefono)
    {
        //
    }
}
