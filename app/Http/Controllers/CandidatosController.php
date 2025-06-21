<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;

class CandidatosController extends Controller
{

    public function index()
    {
        $Candidato = Candidato::all();
        return view('candidatos.index', compact('Candidato'));
    }

    public function create()
    {
        return view('candidatos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuario,id',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:255',
        ]);
        Candidato::create($request->all());
        return redirect()->route('candidatos.index');
    }

    public function show(Candidato $candidato)
    {
        $candidato = Candidato::findOrFail($candidato->id);
        return view('candidatos.show', compact('candidato'));
    }

    public function edit(string $id)
    {
        $candidato = Candidato::findOrFail($id);
        return view('candidatos.edit', compact('candidato'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuario,id',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:255',
        ]);

        $candidato = Candidato::findOrFail($id);
        $candidato->update($request->all());
        return redirect()->route('candidatos.index')->with('success', 'Candidato actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        $candidato = Candidato::findOrFail($id);
        $candidato->delete();
        return redirect()->route('candidatos.index')->with('success', 'Candidato eliminado exitosamente.');
    }
}
