<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\contactoEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactoController extends Controller
{

    //Almacena un nuevo contacto para la empresa autenticada.
    public function store(Request $request)
    {
        $request->validate([
            'personaContacto' => 'required|string|max:255',
            'tlfContacto' => 'required|string|max:20',
        ]);

        $empresa = Auth::user()->empresa;
        $empresa->contactos()->create($request->all());

        return redirect()->back()->with('success', 'Contacto agregado exitosamente.');
    }

    //Elimina un contacto específico.
    public function destroy(contactoEmpresa $contactoEmpresa)
    {
        // Autorización: Asegurarse de que el contacto pertenece a la empresa del usuario.
        if ($contactoEmpresa->empresa_id !== Auth::user()->empresa->id) {
            abort(403, 'ACCIÓN NO AUTORIZADA.');
        }

        $contactoEmpresa->delete();

        return redirect()->back()->with('success', 'Contacto eliminado exitosamente.');
    }
}
