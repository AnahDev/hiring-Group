<?php

namespace App\Http\Controllers;

use App\Models\sectorEmpresa;
use Illuminate\Http\Request;

class sectorEmpresaController extends Controller
{
    public function index()
    {
        $sectorEmpresa = sectorEmpresa::all();
        return view('sectores.index', compact('sectorEmpresa'));
    }

    public function create()
    {
        return view('sectores.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'empresa_id' => 'required|exists:empresas,id', // Asegurarse de que la empresa existe
            'descripcion' => 'nullable|string|max:500',
        ]);

        sectorEmpresa::create($request->all());

        return redirect()->route('sectores.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $sectorEmpresa = sectorEmpresa::findOrFail($id);
        return view('sectores.edit', compact('sectorEmpresa'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'empresa_id' => 'required|exists:empresas,id', // Asegurarse de que la empresa existe
            'descripcion' => 'nullable|string|max:500',
        ]);

        sectorEmpresa::findOrFail($id)->update($request->all());

        return redirect()->route('sectores.index');
    }

    public function destroy(string $id)
    {
        $sectorEmpresa = sectorEmpresa::findOrFail($id);
        $sectorEmpresa->delete();
        return redirect()->route('sectores.index');
    }
}
