<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profesionesController extends Controller
{

    public function index()
    {
        $usuario = Auth::user();
        // Suponiendo que tienes una relación profesiones en el modelo candidato o usuario
        $profesiones = $usuario->candidato->profesiones ?? collect();

        return view('candidato.profesiones.index', compact('profesiones'));
    }


    public function create()
    {
        return view('candidato.profesiones.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $usuario = Auth::user();
        $candidato = $usuario->candidato;


        $candidato->profesiones()->create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('profesiones.index')->with('success', 'Profesión agregada correctamente.');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
