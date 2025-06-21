<?php

namespace App\Http\Controllers;

use App\Models\nomina;
use Illuminate\Http\Request;

class nominaController extends Controller
{
    public function index()
    {
        $nomina = nomina::all();
        return view('nominas.index', compact('nomina'));
    }

    public function create()
    {
        $nomina = nomina::all();
        return view('nominas.create', compact('nomina'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'empresa_id' => 'required|exists:candidatos,id', // Asegurarse de que la empresa existe
            'mes' => 'required|string|max:255',
            'año' => 'required|integer|min:2000|max:2100',
            'fechaGeneracion' => 'required|date',
        ]);

        nomina::create($request->all());

        return redirect()->route('nominas.index');
    }

    public function show(string $id)
    {
        $nomina = nomina::findOrFail($id);
        return view('nominas.show', compact('nomina'));
    }

    public function edit(string $id)
    {
        $nomina = nomina::findOrFail($id);
        return view('nominas.edit', compact('nomina'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'empresa_id' => 'required|exists:candidatos,id', // Asegurarse de que la empresa existe
            'mes' => 'required|string|max:255',
            'año' => 'required|integer|min:2000|max:2100',
            'fechaGeneracion' => 'required|date',
        ]);

        nomina::findOrFail($id)->update($request->all());
        return redirect()->route('nominas.index');
    }

    public function destroy(string $id)
    {
        $nomina = nomina::findOrFail($id);
        $nomina->delete();
        return redirect()->route('nominas.index');
    }
}
