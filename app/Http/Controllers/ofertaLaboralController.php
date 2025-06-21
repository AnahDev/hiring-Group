<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ofertaLaboralController extends Controller
{
    public function index()
    {
        return 'aqui va la vista del oferta laboral';
        // Se va a reemplazar por la vista de oferta laboral
    }

    public function create()
    {
        return 'aqui va el formulario para crear un oferta laboral';
        // Se va a reemplazar por la vista de crear oferta laboral
    }

    public function store(Request $request)
    {
        return 'aqui se va a guardar el oferta laboral';
        // Aquí se implementará la lógica para guardar el oferta laboral
    }

    public function show(string $id)
    {
        return 'aqui se va a mostrar un oferta laboral especifico';
        // Aquí se implementará la lógica para mostrar un oferta laboral específico
    }

    public function edit(string $id)
    {
        return 'aqui se va a mostrar el formulario para modificar un oferta laboral';
        // Aquí se implementará la lógica para mostrar el formulario de edición de un oferta laboral
    }

    public function update(Request $request, string $id)
    {
        return 'aqui se va a actualizar el oferta laboral';
        // Aquí se implementará la lógica para actualizar el oferta laboral
    }

    public function destroy(string $id)
    {
        return 'aqui se va a eliminar el oferta laboral';
        // Aquí se implementará la lógica para eliminar el oferta laboral
    }
}
