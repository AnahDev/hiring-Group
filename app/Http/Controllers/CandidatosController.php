<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;

class CandidatosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'Aqui se va la vista de candidatos';
        //Se va a reemplazar por la vista de candidatos
    }

    public function crear()
    {
        return 'aqui se va el formulario para crear un candidato';
        //Se va a reemplazar por la vista de crear candidato
    }

    /**
     * Store a newly created resource in storage.
     */
    public function guardar(Request $request)
    {
        return 'aqui se va a guardar el candidato';
        /*       Validación de los datos del formulario. hacer que funcione
        $validatedData = $request->validate([
            'usario_id' => 'required|exists:usuario,id',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:255',
        ]);
        $candidato = Candidato::create($validatedData);
        return redirect()->route('candidatos.index')->with('success', 'Candidato creado exitosamente.');
        */
    }

    /**
     * Display the specified resource.
     */
    public function buscar(Candidato $candidato)
    {
        return 'aqui se va a mostrar un candidato espeficico';
        //return view('candidatos.show', compact('candidato'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function modificar(string $id)
    {
        return 'aqui se va a mostrar el formulario para modificar un candidato';
        //$candidato = Candidato::findOrFail($id);
        //return view('candidatos.edit', compact('candidato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function actualizar(Request $request, string $id)
    {
        return 'aqui se va a modificar el candidato';

        /*$candidato = Candidato::findOrFail($id);
        $validatedData = $request->validate([
            'usuario_id' => 'required|exists:usuario,id',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:255',
        ]);
        $candidato->update($validatedData);
        return redirect()->route('candidatos.index')->with('success', 'Candidato actualizado exitosamente.');*/
    }

    /**
     * Remove the specified resource from storage.
     */
    public function eliminar(string $id)
    {
        return 'aqui se va a eliminar el candidato';

        //$candidato = Candidato::findOrFail($id);
        //$candidato->delete();
        //return redirect()->route('candidatos.index')->with('success', 'Candidato eliminado exitosamente.');
    }
}
