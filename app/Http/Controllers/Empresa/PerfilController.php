<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{

    // mostrar el formulario de edición del perfil de la empresa
    public function edit()
    {
        // Obtenemos la empresa del usuario autenticado
        // y cargamos las relaciones 'sectores' y 'contactos'
        $empresa = Auth::user()->empresa->load('sectores', 'contactos');

        // Pasamos el objeto a la vista
        return view('empresa.perfil.edit', compact('empresa'));
    }
}
