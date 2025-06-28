<?php

namespace App\Http\Controllers;

use App\Models\empresa;
use App\Models\sectorEmpresa;
use Illuminate\Http\Request;

class sectorEmpresaController extends Controller
{
    public function index(empresa $empresa)
    {
        $sectoresEmpresa = $empresa->sectores;
        return view('sectores.index', compact('empresa', 'sectoresEmpresa'));
    }

    public function create(empresa $empresa)
    {
        return view('sectores.create', compact('empresa'));
    }

    public function store(Request $request, empresa $empresa)
    {
        // Validar los datos del formulario
        $request->validate([
            'descripcion' => 'nullable|string|max:500',
        ]);

        $empresa->sectores()->create($request->all());

        return redirect()->route('hiringGroup.empresas.sectores.index', $empresa)
            ->with('success', 'Sector creado exitosamente.');
    }

    public function show(empresa $empresa, sectorEmpresa $sectorEmpresa)
    {
        return view('sectores.show', compact('empresa', 'sectorEmpresa'));
    }

    public function edit(empresa $empresa, sectorEmpresa $sectorEmpresa)
    {
        return view('sectores.edit', compact('empresa', 'sectorEmpresa'));
    }

    public function update(Request $request, empresa $empresa, sectorEmpresa $sectorEmpresa)
    {
        $request->validate([
            'descripcion' => 'nullable|string|max:500',
        ]);

        $sectorEmpresa->update($request->all());

        return redirect()->route('hiringGroup.empresas.sectores.index', $empresa)
            ->with('success', 'Sector actualizado exitosamente.');
    }

    public function destroy(empresa $empresa, sectorEmpresa $sectorEmpresa)
    {
        $sectorEmpresa->delete();
        return redirect()->route('hiringGroup.empresas.sectores.index', $empresa)
            ->with('success', 'Sector eliminado exitosamente.');
    }
}
