<?php

namespace App\Http\Controllers;

use App\Models\telefono;
use Illuminate\Http\Request;

class telefonoController extends Controller
{
    public function index()
    {
        $telefono = telefono::all();
        return view('telefonos.index', compact('telefono'));
    }

    public function create()
    {
        return view('telefonos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidato_id' => 'required|exists:candidatos,id', // Asegurarse de que el candidato existe
            'numero' => 'required|string|min:10|max:15',
        ]);
        telefono::create($request->all());
        return redirect()->route('telefonos.index');
    }

    public function show(string $id)
    {
        $telefono = telefono::findOrFail($id);
        return view('telefonos.show', compact('telefono'));
    }

    public function edit(string $id)
    {
        $telefono = telefono::findOrFail($id);
        return view('telefonos.edit', compact('telefono'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'candidato_id' => 'required|exists:candidatos,id',
            'numero' => 'required|string|min:10|max:15',
        ]);
        telefono::findOrFail($id)->update($request->all());
        return redirect()->route('telefonos.index');
    }

    public function destroy(string $id)
    {
        $telefono = telefono::findOrFail($id);
        $telefono->delete();
        return redirect()->route('telefonos.index');
    }
}
