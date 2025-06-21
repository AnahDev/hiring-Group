<?php

namespace App\Http\Controllers;

use App\Models\contrato;
use Illuminate\Http\Request;

class contratoController extends Controller
{
    public function index()
    {
        $contrato = contrato::all();
        return view('contratos.index', compact('contrato'));
    }

    public function create()
    {
        return view('contratos.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'postulacion_id' => 'required|exists:postulaciones,id', // Asegurarse de que la postulacion existe
            'banco_id' => 'required|exists:bancos,id', // Asegurarse de que el banco existe
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
            'tipoContrato' => 'required|string|max:255',
            'duracion' => 'required|in:1 Mes,6 Meses,1 Año,indefinido',
            'salarioMensual' => 'required|numeric|min:0',
            'tipoSangre' => 'required|string|max:10',
            'tlfEmergencia' => 'required|string|max:15',
            'contactoEmergencia' => 'required|string|max:100',
            'cuentaBanco' => 'required|string|max:20',
        ]);

        contrato::create($request->all());
        return redirect()->route('contratos.index');
    }

    public function show(string $id)
    {
        $contrato = contrato::findOrFail($id);
        return view('contratos.show', compact('contrato'));
    }

    public function edit(string $id)
    {
        $contrato = contrato::findOrFail($id);
        return view('contratos.edit', compact('contrato'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'postulacion_id' => 'required|exists:postulaciones,id',
            'banco_id' => 'required|exists:bancos,id',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
            'tipoContrato' => 'required|string|max:255',
            'duracion' => 'required|in:1 Mes,6 Meses,1 Año,indefinido',
            'salarioMensual' => 'required|numeric|min:0',
            'tipoSangre' => 'required|string|max:10',
            'tlfEmergencia' => 'required|string|max:15',
            'contactoEmergencia' => 'required|string|max:100',
            'cuentaBanco' => 'required|string|max:20',
        ]);

        contrato::findOrFail($id)->update($request->all());
        return redirect()->route('contratos.index');
    }

    public function destroy(string $id)
    {
        $contrato = contrato::findOrFail($id);
        $contrato->delete();
        return redirect()->route('contratos.index');
    }
}
