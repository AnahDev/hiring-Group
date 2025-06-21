<?php

namespace App\Http\Controllers;

use App\Models\banco;
use Illuminate\Http\Request;

class bancoController extends Controller
{
    public function index()
    {
        $bancos = banco::all();
        return view('bancos.index', compact('bancos')); //falta el archivo de vista
    }

    public function create()
    {

        // Muestra el formulario para crear un banco
        return view('bancos.crear'); //falta el archivo de vista
    }

    public function store(Request $request)
    {
        // guardar campo creado por el usuario
        $request->validate([
            'nombreBanco' => 'required|string|min:10|max:255',
        ]);
        banco::create($request->all());

        return redirect()->route('bancos.index'); // Redirige a la lista de bancos después de guardar
    }

    public function show(string $nombre)
    {
        $banco = banco::where('nombreBanco', $nombre)->first();
        if (!$banco) {
            return response()->json(['message' => 'Banco no encontrado'], 404);
        }
        return $banco;
        // Aquí se implementará la lógica para buscar un banco por nombre
    }

    public function edit(string $id)
    {
        //Muestra el formulario para modificar un banco
        $banco = banco::findOrFail($id); // Verifica si el banco existe, si no, lanza una excepción
        return view('bancos.editar', compact('banco'));      //falta el archivo de vista
    }

    public function update(Request $request, string $id)
    {
        //Guarda los cambios realizados en el banco

        $request->validate([
            'nombreBanco' => 'required|string|min:10|max:255',
        ]);
        banco::findOrFail($id)->update($request->all()); //Busca el banco por ID y actualiza sus datos
        // Si el banco no existe, findOrFail lanzará una excepción y se manejará automáticamente
        return redirect()->route('bancos.index'); // Redirige a la lista de bancos después de guardar

    }

    public function destroy(string $id)
    {
        $banco = banco::findOrFail($id);
        $banco->delete();
        return redirect()->route('bancos.index'); // Redirige a la lista de bancos después de eliminar
    }
}
