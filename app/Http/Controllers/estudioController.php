<?php

namespace App\Http\Controllers;

use App\Models\estudio;
use Illuminate\Http\Request;

class estudioController extends Controller
{

    public function index()
    {
        $estudio = estudio::all();
        return view('estudios.index', compact('estudio')); // falta la vista 'estudios.index'
    }


    public function create()
    {
        return view('estudios.create'); // falta la vista 'estudios.create'
    }


    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'candidato_id' => 'required|exists:candidatos,id', // Asegurarse de que el candidato existe
            'nombreUni' => 'required|string|min:10|max:255',
            'carrera' => 'required|string|min:10|max:255',
            'fechaEgreso' => 'required|date',
        ]);
        // Crear un nuevo registro de estudio
        estudio::create($request->all());

        // Redirigir a la lista de estudios después de guardar
        return redirect()->route('estudios.index');
    }


    public function show(string $id)
    {
        // 
    }


    public function edit(string $id)
    {
        $estudio = estudio::findOrFail($id);
        return view('estudios.edit', compact('estudio'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'candidato_id' => 'required|exists:candidatos,id',
            'nombreUni' => 'required|string|min:10|max:255',
            'carrera' => 'required|string|min:10|max:255',
            'fechaEgreso' => 'required|date',
        ]);
        estudio::findOrFail($id)->update($request->all());
        return redirect()->route('estudios.index');
    }

    public function destroy(string $id)
    {
        $estudio = estudio::findOrFail($id);
        $estudio->delete();
        return redirect()->route('estudios.index');
    }
}
