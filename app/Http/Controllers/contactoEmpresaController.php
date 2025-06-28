<?php

namespace App\Http\Controllers;

use App\Models\contactoEmpresa;
use Illuminate\Http\Request;
use App\Models\empresa;

class contactoEmpresaController extends Controller
{
    public function index(empresa $empresa)
    {
        $contactosEmpresa = $empresa->contactos;
        return view('contactosEmpresa.index', compact('empresa', 'contactosEmpresa'));
    }

    public function create(empresa $empresa)
    {
        return view('contactosEmpresa.create', compact('empresa'));
    }

    public function store(Request $request, empresa $empresa)
    {
        // Validar los datos del formulario
        $request->validate([
            'personaContacto' => 'required|email|max:255',
            'tlfContacto' => 'nullable|string|max:15',
        ]);

        $empresa->contactos()->create($request->all());

        return redirect()->route('hiringGroup.empresas.contactos.index', $empresa)
            ->with('success', 'Contacto creado exitosamente.');
    }

    public function show(empresa $empresa, contactoEmpresa $contactoEmpresa)
    {
        return view('contactosEmpresa.show', compact('empresa', 'contactoEmpresa'));
    }

    public function edit(empresa $empresa, contactoEmpresa $contactoEmpresa)
    {
        return view('contactosEmpresa.edit', compact('empresa', 'contactoEmpresa'));
    }

    public function update(Request $request, empresa $empresa, contactoEmpresa $contactoEmpresa)
    {
        // Validar los datos del formulario
        $request->validate([
            'personaContacto' => 'required|email|max:255',
            'tlfContacto' => 'nullable|string|max:15',
        ]);

        $contactoEmpresa->update($request->all());

        return redirect()->route('hiringGroup.empresas.contactos.index', $empresa)
            ->with('success', 'Contacto actualizado exitosamente.');
    }

    public function destroy(empresa $empresa, contactoEmpresa $contactoEmpresa)
    {
        $contactoEmpresa->delete();
        return redirect()->route('hiringGroup.empresas.contactos.index', $empresa)
            ->with('success', 'Contacto eliminado exitosamente.');
    }
}
