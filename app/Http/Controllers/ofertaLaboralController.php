<?php

namespace App\Http\Controllers;

use App\Models\empresa;
use App\Models\ofertaLaboral;
use App\Models\profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ofertaLaboralController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        $empresa = $usuario->empresa;

        if (!$empresa) {
            return redirect('/empresa')->with('error', 'No tienes una empresa asociada para gestionar ofertas.');
        }

        $ofertasLaborales = $empresa->ofertaLaboral()->with('profesion')->get();

        return view('empresa.ofertas.index', compact('ofertasLaborales'));
    }

    public function create()
    {
        $profesiones = profesion::all();
        return view('empresa.ofertas.create', compact('profesiones'));
    }

    public function store(Request $request)
    {
        $usuario = Auth::user();
        $empresa = $usuario->empresa;

        if (!$empresa) {
            return redirect()->back()->with('error', 'Debes tener una empresa asociada para crear ofertas.');
        }

        $request->validate([
            'empresa_id' => 'required|exists:empresas,id', // Asegurarse de que la empresa existe
            'candidato_id' => 'required|exists:candidatos,id', // Asegurarse de que el candidato existe
            'cargo' => 'required|string|max:255',
            'descripcion' => 'required|text',
            'salario' => 'nullable|decimal|min:0',
            'estado' => 'required|in:activa,inactiva',
            'fechaCreacion' => 'nullable|date',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        $empresa->ofertasLaborales()->create([
            'profesion_id' => $request->profesion_id,
            'cargo' => $request->cargo,
            'descripcion' => $request->descripcion,
            'salario' => $request->salario,
            'estado' => $request->has('estado') ? (bool)$request->estatus : true,
            'ubicacion' => $request->ubicacion,
        ]);

        return redirect()->route('ofertasLaborales.index')->with('success', 'Oferta creada exitosamente!');
    }

    public function show(ofertaLaboral $ofertaLaboral)
    {
        if ($ofertaLaboral->empresa_id !== Auth::user()->empresa->id) {
            abort(403, 'Acceso no autorizado a esta oferta.');
        }
        return view('empresa.ofertas.show', compact('ofertaLaboral'));
    }

    public function edit(ofertaLaboral $ofertaLaboral)
    {
        if ($ofertaLaboral->empresa_id !== Auth::user()->empresa->id) {
            abort(403, 'Acceso no autorizado para editar esta oferta.');
        }
        $profesiones = Profesion::all();
        return view('empresa.ofertas.edit', compact('ofertaLaboral', 'profesiones'));
    }

    public function update(Request $request, ofertaLaboral $ofertaLaboral)
    {
        if ($ofertaLaboral->empresa_id !== Auth::user()->empresa->id) {
            abort(403, 'Acceso no autorizado para actualizar esta oferta.');
        }

        $request->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'candidato_id' => 'required|exists:candidatos,id',
            'cargo' => 'required|string|max:255',
            'descripcion' => 'required|text',
            'salario' => 'nullable|decimal|min:0',
            'estado' => 'required|in:activa,inactiva',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        $ofertaLaboral->update($request->all());
        return redirect()->route('empresa.ofertas.index')->with('success', 'Oferta actualizada exitosamente!');
    }

    public function destroy(ofertaLaboral $ofertaLaboral)
    {
        if ($ofertaLaboral->empresa_id !== Auth::user()->empresa->id) {
            abort(403, 'Acceso no autorizado para eliminar esta oferta.');
        }

        $ofertaLaboral->delete();
        return redirect()->route('empresa.ofertas.index')->with('success', 'Oferta eliminada correctamente.');
    }

    //Acción para cambiar el estatus de una oferta (solo de activa a inactiva y viceversa).
    public function toggleStatus(OfertaLaboral $ofertaLaboral)
    {
        if ($ofertaLaboral->empresa_id !== Auth::user()->empresa->id) {
            return response()->json(['message' => 'Acceso no autorizado'], 403);
        }

        // Cambia el estado de 'activo' a 'inactivo' y viceversa
        $ofertaLaboral->estado = $ofertaLaboral->estado === 'activo' ? 'inactivo' : 'activo';
        $ofertaLaboral->save();

        return redirect()->back()->with('success', 'Estatus de la oferta actualizado a: ' . $ofertaLaboral->estado);
    }
}
