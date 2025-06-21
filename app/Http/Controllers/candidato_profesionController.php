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
            'nombre' => 'required|string|max:255',
        ]);
        return 'aqui se va a guardar el contacto de la cand_profesion';
        // Aquí se implementará la lógica para guardar el contacto de la cand_profesion
    }

    public function show(string $id)
    {
        return 'aqui se va a mostrar un contacto de la cand_profesion especifico';
        // Aquí se implementará la lógica para mostrar un contacto de la cand_profesion específico
    }

    public function edit(string $id)
    {
        return 'aqui se va a mostrar el formulario para modificar un contacto de la cand_profesion';
        // Aquí se implementará la lógica para mostrar el formulario de edición de un contacto de la cand_profesion
    }

    public function update(Request $request, string $id)
    {
        return 'aqui se va a actualizar el contacto de la cand_profesion';
        // Aquí se implementará la lógica para actualizar el contacto de la cand_profesion
    }

    public function destroy(string $id)
    {
        return 'aqui se va a eliminar el contacto de la cand_profesion';
        // Aquí se implementará la lógica para eliminar el contacto de la cand_profesion
    }
}
