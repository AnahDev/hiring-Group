<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;

class Candidatos extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidatos = Candidato::all();
        return view('candidatos.index', compact('candidatos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('candidatos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'usario_id' => 'required|exists:usuario,id',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:255',
        ]);
        $candidato = Candidato::create($validatedData);
        return redirect()->route('candidatos.index')->with('success', 'Candidato creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidato $candidato)
    {
        return view('candidatos.show', compact('candidato'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $candidato = Candidato::findOrFail($id);
        return view('candidatos.edit', compact('candidato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $candidato = Candidato::findOrFail($id);
        $validatedData = $request->validate([
            'usuario_id' => 'required|exists:usuario,id',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:255',
        ]);
        $candidato->update($validatedData);
        return redirect()->route('candidatos.index')->with('success', 'Candidato actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $candidato = Candidato::findOrFail($id);
        $candidato->delete();
        return redirect()->route('candidatos.index')->with('success', 'Candidato eliminado exitosamente.');
    }
}
