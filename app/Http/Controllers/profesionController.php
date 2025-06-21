<?php

namespace App\Http\Controllers;

use App\Models\profesion;
use Illuminate\Http\Request;

class profesionController extends Controller
{
    public function index()
    {
        $profesion = profesion::all();
        return view('profesiones.index', compact('profesion'));
    }

    public function create()
    {
        return view('profesiones.create');
    }

    public function store(Request $request)
    {
        // guardar campo creado por el usuario
        $request->validate([
            'nombre' => 'required|string|min:10|max:255',
        ]);
        profesion::create($request->all());

        return redirect()->route('profesion.index'); // Redirige a la lista de bancos después de guardar
    }

    public function show(string $id)
    {
        $profesion = profesion::findOrFail($id);
        return view('profesiones.show', compact('profesion'));
    }

    public function edit(string $id)
    {
        $profesion = profesion::findOrFail($id); // Verifica si la profesion existe, si no, lanza una excepción
        return view('profesiones.edit', compact('profesion')); // Muestra el formulario para modificar una profesion
    }

    public function update(Request $request, string $id)
    {
        // guardar campo creado por el usuario
        $request->validate([
            'nombre' => 'required|string|min:10|max:255',
        ]);
        profesion::findOrFail($id)->update($request->all()); // Busca la profesion por ID y actualiza sus datos

        return redirect()->route('profesion.index'); // Redirige a la lista de bancos después de guardar
    }

    public function destroy(string $id)
    {
        $profesion = profesion::findOrFail($id);
        return redirect()->route('profesion.index');
    }
}
