<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class experienciaLaboralController extends Controller
{
    public function index()
    {
        return 'aqui va la vista de la experiencia laboral';
        // Se va a reemplazar por la vista de experiencia laboral
    }

    public function create()
    {
        return 'aqui va el formulario para crear una experiencia laboral';
        // Se va a reemplazar por la vista de crear experiencia laboral
    }

    public function store(Request $request)
    {
        return 'aqui se va a guardar la experiencia laboral';
        // Aquí se implementará la lógica para guardar el experiencia laboral
    }

    public function show(string $id)
    {
        return 'aqui se va a mostrar una experiencia laboral especifico';
        // Aquí se implementará la lógica para mostrar un experiencia laboral específico
    }

    public function edit(string $id)
    {
        return 'aqui se va a mostrar el formulario para modificar un experiencia laboral';
        // Aquí se implementará la lógica para mostrar el formulario de edición de un experiencia laboral
    }

    public function update(Request $request, string $id)
    {
        return 'aqui se va a actualizar el experiencia laboral';
        // Aquí se implementará la lógica para actualizar el experiencia laboral
    }

    public function destroy(string $id)
    {
        return 'aqui se va a eliminar el experiencia laboral';
        // Aquí se implementará la lógica para eliminar el experiencia laboral
    }
}
