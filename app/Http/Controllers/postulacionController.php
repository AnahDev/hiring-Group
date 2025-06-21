<?php

namespace App\Http\Controllers;

use App\Models\postulacion;
use Illuminate\Http\Request;

class postulacionController extends Controller
{
    public function index()
    {
        $postulacion = postulacion::all();
        return view('postulaciones.index', compact('postulacion'));
    }

    public function create()
    {
        return view('postulaciones.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'candidato_id' => 'required|exists:candidatos,id', // Asegurarse de que el candidato existe
            'oferta_laboral_id' => 'required|exists:ofertas,id', // Asegurarse de que la oferta laboral existe
            'fechaPostulacion' => 'required|date',
        ]);

        postulacion::create($request->all());

        return redirect()->route('postulaciones.index');
    }

    public function show(string $id)
    {
        $postulacion = postulacion::findOrFail($id);
        return view('postulaciones.show', compact('postulacion'));
    }

    public function edit(string $id)
    {
        $postulacion = postulacion::findOrFail($id);
        return view('postulaciones.edit', compact('postulacion'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'candidato_id' => 'required|exists:candidatos,id',
            'oferta_laboral_id' => 'required|exists:ofertas,id',
            'fechaPostulacion' => 'required|date',
        ]);

        postulacion::findOrFail($id)->update($request->all());

        return redirect()->route('postulaciones.index');
    }

    public function destroy(string $id)
    {
        $postulacion = postulacion::findOrFail($id);
        $postulacion->delete();

        return redirect()->route('postulaciones.index');
    }
}
