<?php

namespace App\Http\Controllers;

use App\Models\candidato_profesion;
use Illuminate\Http\Request;

class candidato_profesionController extends Controller
{
    public function index()
    {
        $candidato_profesion = candidato_profesion::all();
        return $candidato_profesion;
        // Se va a reemplazar por la vista de contacto de la cand_profesion
    }

    public function create()
    {
        //se crea a partir de las tablas candidado y profesion
        //return $candidato_profesion;
        //return 'aqui va el formulario para crear un contacto de la cand_profesion';
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidato_id' => 'required|exists:candidato,id',
            'profesion_id' => 'required|exists:profesion,id',
        ]);
        candidato_profesion::create($request->all());
    }

    public function show(string $id)
    {
        $candidato_profesion = candidato_profesion::findOrFail($id);
        return $candidato_profesion;
    }

    public function edit(string $id)
    {
        //no se va a usar, ya que no se va a editar un contacto de la cand_profesion
    }

    public function update(Request $request, string $id)
    {
        // no se va a usar porque se deberia actualizar automaticamente
    }

    public function destroy(string $id)
    {
        //
    }
}
