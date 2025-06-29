<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\ofertaLaboral;
use App\Models\profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfertaLaboralController extends Controller
{
    // Muestra las ofertas de la empresa autenticada
    public function index()
    {
        // La autorización ahora se puede hacer al principio o en la ruta
        $this->authorize('viewAny', ofertaLaboral::class);
        $empresa = Auth::user()->empresa;
        $ofertasLaborales = $empresa->ofertaLaboral()->with('profesion')->get(); // Corregida la relación a 'ofertaLaboral'
        return view('empresa.ofertas.index', compact('ofertasLaborales'));
    }

    // Muestra el formulario para crear una oferta
    public function create()
    {
        $this->authorize('create', ofertaLaboral::class);
        $profesiones = profesion::all();
        return view('empresa.ofertas.create', compact('profesiones'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', ofertaLaboral::class);
        $empresa = Auth::user()->empresa;

        $request->validate([
            'profesion_id' => 'required|exists:profesion,id',
            'cargo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'salario' => 'nullable|decimal:2',
            'ubicacion' => 'nullable|string|max:255',
            // No validamos empresa_id, candidato_id ni estado aquí
        ]);

        $empresa->ofertaLaboral()->create([
            'profesion_id' => $request->profesion_id,
            'cargo' => $request->cargo,
            'descripcion' => $request->descripcion,
            'salario' => $request->salario,
            'estado' => $request->has('estado') ? 'activa' : 'inactiva',
            'ubicacion' => $request->ubicacion,
            'fechaCreacion' => now(),
        ]);

        return redirect()->route('empresa.ofertas.index')->with('success', 'Oferta creada exitosamente!');
    }

    public function show(ofertaLaboral $ofertaLaboral)
    {
        $this->authorize('view', $ofertaLaboral);
        return view('empresa.ofertas.show', compact('ofertaLaboral'));
    }

    public function edit(ofertaLaboral $ofertaLaboral)
    {
        $empresa = Auth::user()->empresa;
        $this->authorize('update', $ofertaLaboral);
        $profesiones = Profesion::all();
        return view('empresa.ofertas.edit', compact('ofertaLaboral', 'profesiones'));
    }

    public function update(Request $request, ofertaLaboral $ofertaLaboral)
    {
        $this->authorize('update', $ofertaLaboral);

        $request->validate([
            'profesion_id' => 'required|exists:profesion,id',
            'cargo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'salario' => 'nullable|decimal:2',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        $ofertaLaboral->update($request->all());
        return redirect()->route('empresa.ofertas.index')->with('success', 'Oferta actualizada exitosamente!');
    }

    public function destroy(ofertaLaboral $ofertaLaboral)
    {
        // Verifica si el usuario tiene permiso para eliminar la oferta
        $this->authorize('delete', $ofertaLaboral);
        $ofertaLaboral->delete();
        return redirect()->route('empresa.ofertas.index')->with('success', 'Oferta eliminada correctamente.');
    }

    //Metodos extras
    //Acción para cambiar el estatus de una oferta (solo de activa a inactiva y viceversa).
    public function toggleStatus(OfertaLaboral $ofertaLaboral)
    {
        $this->authorize('update', $ofertaLaboral);
        // Cambia el estado de 'activo' a 'inactivo' y viceversa
        $ofertaLaboral->estado = $ofertaLaboral->estado === 'activa' ? 'inactiva' : 'activa';
        $ofertaLaboral->save();

        return redirect()->back()->with('success', 'Estatus de la oferta actualizado a: ' . $ofertaLaboral->estado);
    }

    public function activas()
    {
        $usuario = Auth::user();
        $empresa = $usuario->empresa;

        if (!$empresa) {
            return redirect('/empresa')->with('Error', 'No tienes una empresa asociada.');
        }

        $ofertasLaborales = $empresa->ofertaLaboral()->where('estado', 'activa')->with('profesion')->get();

        return view('empresa.ofertas.index', compact('ofertasLaborales'));
    }

    public function inactivas()
    {
        $usuario = Auth::user();
        $empresa = $usuario->empresa;

        if (!$empresa) {
            return redirect('/empresa')->with('Error', 'No tienes una empresa asociada.');
        }

        $ofertasLaborales = $empresa->ofertaLaboral()->where('estado', 'inactiva')->with('profesion')->get();

        return view('empresa.ofertas.index', compact('ofertasLaborales'));
    }
}
