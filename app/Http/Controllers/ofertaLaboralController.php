<?php

namespace App\Http\Controllers;

use App\Models\ofertaLaboral;
use App\Models\profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ofertaLaboralController extends Controller
{

    //muestra la oferta laboral asociada una empresa
    public function index()
    {
        $empresa = Auth::user()->empresa;

        if (!$empresa) {
            return redirect('/empresa')->with('error', 'No tienes una empresa asociada para gestionar ofertas.');
        }

        $ofertasLaborales = $empresa->ofertaLaboral()->with('profesion')->get();

        return view('empresa.ofertas.index', compact('ofertasLaborales'));
    }

    // Muestra todas las ofertas laborales
    public function indexAll()
    {
        // Obtiene todas las ofertas laborales con su empresa y profesión asociada
        $ofertasLaborales = \App\Models\ofertaLaboral::with(['empresa', 'profesion'])->get();

        // Retorna la vista para el panel de hiring group
        return view('hiring.ofertas', compact('ofertasLaborales'));
    }

    public function create()
    {
        $empresa = Auth::user()->empresa;
        if (!$empresa) {
            abort(403, 'Acceso no autorizado para crear ofertas.');
        }
        $profesiones = profesion::all();
        return view('empresa.ofertas.create', compact('profesiones'));
    }

    public function store(Request $request)
    {
        $empresa = Auth::user()->empresa;
        if (!$empresa) {
            return redirect()->back()->with('error', 'Debes tener una empresa asociada para crear ofertas.');
        }

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
        if ($ofertaLaboral->empresa_id !== Auth::user()->empresa->id) {
            abort(403, 'Acceso no autorizado a esta oferta.');
        }
        return view('empresa.ofertas.show', compact('ofertaLaboral'));
    }

    public function edit(ofertaLaboral $ofertaLaboral)
    {
        $empresa = Auth::user()->empresa;
        if (!$empresa || $ofertaLaboral->empresa_id !== $empresa->id) {

            dd([
                'Oferta Empresa ID' => $ofertaLaboral->empresa_id,
                'Usuario Empresa ID' => $empresa ? $empresa->id : 'No Empresa', // Manejo si $empresa es null
                'Oferta ID' => $ofertaLaboral->id,
                'Usuario ID' => Auth::id(),
            ]);
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
        if ($ofertaLaboral->empresa_id !== Auth::user()->empresa->id) {
            abort(403, 'Acceso no autorizado para eliminar esta oferta.');
        }

        $ofertaLaboral->delete();
        return redirect()->route('empresa.ofertas.index')->with('success', 'Oferta eliminada correctamente.');
    }

    //Metodos extras
    //Acción para cambiar el estatus de una oferta (solo de activa a inactiva y viceversa).
    public function toggleStatus(OfertaLaboral $ofertaLaboral)
    {
        if ($ofertaLaboral->empresa_id !== Auth::user()->empresa->id) {
            return response()->json(['message' => 'Acceso no autorizado'], 403);
        }

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

    public function reporteOfertasPorProfesion()
    {
        $reporte = profesion::with(['ofertas.empresa'])
            ->withCount('ofertas')
            ->get();

        return view('hiring.reportes', compact('reporte'));
    }
}
