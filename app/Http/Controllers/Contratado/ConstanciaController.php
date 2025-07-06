<?php

namespace App\Http\Controllers\Contratado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConstanciaController extends Controller
{
    public function create()
    {
        $this->authorize('create', constancia::class);
        return view('contratado.constancia.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'motivo' => 'nullable|string|max:255',
        ]);

        constancia::create([
            'usuario_id' => auth()->id(),
            'motivo' => $request->motivo,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('contratado.constancia.create')->with('success', 'Solicitud enviada correctamente.');
    }
}
