<?php

namespace App\Http\Controllers;

use App\Models\contactoEmpresa;
use Illuminate\Http\Request;

class contactoEmpresaController extends Controller
{
    public function index()
    {
        $contactoEmpresa = contactoEmpresa::all();
        return view('contactosEmpresa.index', compact('contactoEmpresa'));
    }

    public function create()
    {
        return view('contactosEmpresa.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'empresa_id' => 'required|exists:empresas,id', // Asegurarse de que la empresa existe
            'nombre' => 'required|string|min:3|max:255',
            'personaContacto' => 'required|email|max:255',
            'tlfContacto' => 'nullable|string|max:15',
        ]);

        contactoEmpresa::create($request->all());

        return redirect()->route('contactosEmpresa.index');
    }

    public function show(string $id)
    {
        $contactoEmpresa = contactoEmpresa::findOrFail($id);
        return view('contactosEmpresa.show', compact('contactosEmpresa'));
    }

    public function edit(string $id)
    {
        $contactoEmpresa = contactoEmpresa::findOrFail($id);
        return view('contactosEmpresa.edit', compact('contactoEmpresa'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'empresa_id' => 'required|exists:empresas,id', // Asegurarse de que la empresa existe
            'nombre' => 'required|string|min:3|max:255',
            'personaContacto' => 'required|email|max:255',
            'tlfContacto' => 'nullable|string|max:15',
        ]);

        contactoEmpresa::findOrFail($id)->update($request->all());

        return redirect()->route('contactosEmpresa.index');
    }

    public function destroy(string $id)
    {
        $contactoEmpresa = contactoEmpresa::findOrFail($id);
        $contactoEmpresa->delete();
        return redirect()->route('contactosEmpresa.index');
    }
}
