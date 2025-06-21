<?php

namespace App\Http\Controllers;

use App\Models\experienciaLaboral;
use Illuminate\Http\Request;

class experienciaLaboralController extends Controller
{
    public function index()
    {
        $experienciaLaboral = experienciaLaboral::all();
        return view('experiencias.index', compact('experienciaLaboral'));
    }

    public function create()
    {
        return view('experiencias.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'candidato_id' => 'required|exists:candidatos,id', // Asegurarse de que el candidato existe
            'empresa' => 'required|string|min:3|max:255',
            'cargo' => 'required|string|min:3|max:255',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
        ]);

        experienciaLaboral::create($request->all());

        return redirect()->route('experiencias.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $experienciaLaboral = experienciaLaboral::findOrFail($id); // Verifica si la experiencia laboral existe, si no, lanza una excepción
        return view('experiencias.edit', compact('experienciaLaboral')); // Muestra el formulario para modificar una experiencia laboral
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'candidato_id' => 'required|exists:candidatos,id', // Asegurarse de que el candidato existe
            'empresa' => 'required|string|min:3|max:255',
            'cargo' => 'required|string|min:3|max:255',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
        ]);

        experienciaLaboral::findOrFail($id)->update($request->all());

        return redirect()->route('experiencias.index');
    }

    public function destroy(string $id)
    {
        $experienciaLaboral = experienciaLaboral::findOrFail($id);
        $experienciaLaboral->delete();
        return redirect()->route('experiencias.index');
    }
}
