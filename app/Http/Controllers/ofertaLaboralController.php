<?php

namespace App\Http\Controllers;

use App\Models\ofertaLaboral;
use Illuminate\Http\Request;

class ofertaLaboralController extends Controller
{
    public function index()
    {
        $ofertaLaboral = ofertaLaboral::all();
        return view('ofertasLaborales.index', compact('ofertaLaboral'));
    }

    public function create()
    {
        return view('ofertasLaborales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'empresa_id' => 'required|exists:empresas,id', // Asegurarse de que la empresa existe
            'candidato_id' => 'required|exists:candidatos,id', // Asegurarse de que el candidato existe
            'cargo' => 'required|string|max:255',
            'descripcion' => 'required|text',
            'salario' => 'nullable|decimal|min:0',
            'estado' => 'required|in:activa,inactiva',
            'fechaCreacion' => 'nullable|date',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        ofertaLaboral::create($request->all());
        return redirect()->route('ofertasLaborales.index');
    }

    public function show(string $id)
    {
        $ofertaLaboral = ofertaLaboral::findOrFail($id);
        return view('ofertasLaborales.show', compact('ofertaLaboral'));
    }

    public function edit(string $id)
    {
        $ofertaLaboral = ofertaLaboral::findOrFail($id);
        return view('ofertasLaborales.edit', compact('ofertaLaboral'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'candidato_id' => 'required|exists:candidatos,id',
            'cargo' => 'required|string|max:255',
            'descripcion' => 'required|text',
            'salario' => 'nullable|decimal|min:0',
            'estado' => 'required|in:activa,inactiva',
            'fechaCreacion' => 'nullable|date',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        ofertaLaboral::findOrFail($id)->update($request->all());
        return redirect()->route('ofertasLaborales.index');
    }

    public function destroy(string $id)
    {
        $ofertaLaboral = ofertaLaboral::findOrFail($id);
        $ofertaLaboral->delete();
        return redirect()->route('ofertasLaborales.index');
    }
}
