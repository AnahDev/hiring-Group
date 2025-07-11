<?php

namespace App\Http\Controllers\HiringGroup;

use App\Http\Controllers\Controller;
use App\Models\profesion;
use Illuminate\Http\Request;

class profesionController extends Controller
{

    //Muestra una lista paginada de todas las profesiones.
    public function index()
    {
        $profesiones = profesion::orderBy('id')->paginate(10);
        return view('hiringGroup.profesiones.index', compact('profesiones'));
    }

    //Muestra el formulario para crear una nueva profesión.
    public function create()
    {
        return view('hiringGroup.profesiones.create');
    }

    //Almacena una nueva profesión en la base de datos.
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        //crear profesion
        profesion::create($request->all());
        return redirect()->route('hiringGroup.profesiones.index')
            ->with('success', 'Profesión creada exitosamente.');
    }

    //Muestra los detalles de una profesión y todas las ofertas laborales asociadas.
    public function show(profesion $profesion)
    {
        // Carga todas las relaciones anidadas que necesitarás para acceder a los datos
        $profesion->load([
            'ofertaLaboral.postulaciones.contrato',
            'ofertaLaboral.postulaciones.candidato', // Cargar candidato
            'ofertaLaboral.postulaciones.candidato.usuario', // Si candidato se relaciona con usuario para la cédula
            'ofertaLaboral.postulaciones.ofertaLaboral', // Cargar oferta laboral para el cargo
        ]);

        return view('hiringGroup.profesiones.show', compact('profesion'));
    }

    //Muestra el formulario para editar una profesión existente.
    public function edit(profesion $profesion)
    {
        return view('hiringGroup.profesiones.edit', compact('profesion'));
    }

    //Actualiza una profesión en la base de datos.
    public function update(Request $request, profesion $profesion)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255|unique:profesion,descripcion,' . $profesion->id,
        ]);

        $profesion->update($request->all());

        return redirect()->route('hiringGroup.profesiones.index')->with('success', 'Profesión actualizada exitosamente.');
    }

    //Elimina una profesión de la base de datos.
    public function destroy(profesion $profesion)
    {
        // Adaptación Clave: Verificar si la profesión está en uso.
        // Una profesión está en uso si está asociada a una oferta laboral
        // o si un candidato la tiene en su perfil.
        $profesion->loadCount(['ofertaLaboral', 'candidatoProfesiones']);

        if ($profesion->oferta_laboral_count > 0 || $profesion->candidato_profesiones_count > 0) {
            // Si está en uso, no se puede eliminar.
            return redirect()->route('hiringGroup.profesiones.index')
                ->with('error', 'No se puede eliminar la profesión porque está siendo utilizada en ofertas laborales o perfiles de candidatos.');
        }

        $profesion->delete();

        return redirect()->route('hiringGroup.profesiones.index')->with('success', 'Profesión eliminada correctamente.');
    }
}
