<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\sectorEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SectorController extends Controller
{
    // Almacena un nuevo sector para la empresa autenticada.
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        // 1. Obtenemos el perfil de la empresa del usuario autenticado.
        $empresa = Auth::user()->empresa;
        // 2. Usamos la relación para crear el sector.
        $empresa->sectores()->create($request->all());
        // 3. Redirigimos de vuelta a la página anterior (el formulario de perfil de la empresa).
        return redirect()->back()->with('success', 'Sector agregado exitosamente.');
    }

    // Elimina un sector de la empresa del usuario autenticado.
    public function destroy(sectorEmpresa $sectorEmpresa)
    {
        // 1. Autorización: Verificamos que el sector que se intenta eliminar
        $this->authorize('delete', $sectorEmpresa);
        // 2. Si la autorización pasa, eliminamos el registro.
        $sectorEmpresa->delete();
        return redirect()->back()->with('success', 'Sector eliminado exitosamente.');
    }
}
