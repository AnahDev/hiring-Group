<?php

namespace App\Http\Controllers;

use App\Models\detalleNomina;
use Illuminate\Http\Request;

class detalleNominaController extends Controller
{
    public function index()
    {
        $detalleNomina = detalleNomina::all();
        return view('detalleNomina.index');
    }

    public function create()
    {
        return view('detalleNomina.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomina_id' => 'required|exists:nomina,id',
            'contrato_id' => 'required|exists:contrato,id',
            'sueldoBruto' => 'required|numeric|min:0',
            'comisionHg' => 'required|numeric|min:0',
            'deduccionInces' => 'required|numeric|min:0',
            'deduccionIvss' => 'required|numeric|min:0',
            'sueldoNeto' => 'required|numeric|min:0',
        ]);

        detalleNomina::create($request->all());
        return redirect()->route('detalleNomina.index');
    }

    public function show(string $id)
    {
        $detalleNomina = detalleNomina::findOrFail($id);
        return view('detalleNomina.show', compact('detalleNomina'));
    }

    public function edit(string $id)
    {
        $detalleNomina = detalleNomina::findOrFail($id);
        return view('detalleNomina.edit', compact('detalleNomina'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomina_id' => 'required|exists:nomina,id',
            'contrato_id' => 'required|exists:contrato,id',
            'sueldoBruto' => 'required|numeric|min:0',
            'comisionHg' => 'required|numeric|min:0',
            'deduccionInces' => 'required|numeric|min:0',
            'deduccionIvss' => 'required|numeric|min:0',
            'sueldoNeto' => 'required|numeric|min:0',
        ]);

        detalleNomina::findOrFail($id)->update($request->all());
        return redirect()->route('detalleNomina.index');
    }

    public function destroy(string $id)
    {
        $detalleNomina = detalleNomina::findOrFail($id);
        $detalleNomina->delete();
        return redirect()->route('detalleNomina.index');
    }
}
