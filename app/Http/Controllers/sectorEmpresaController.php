<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sectorEmpresaController extends Controller
{
    public function index()
    {
        return 'aqui va la vista del sector ';
        // Se va a reemplazar por la vista de sector 
    }

    public function create()
    {
        return 'aqui va el formulario para crear un sector ';
        // Se va a reemplazar por la vista de crear sector 
    }

    public function store(Request $request)
    {
        return 'aqui se va a guardar el sector ';
        // Aquí se implementará la lógica para guardar el sector 
    }

    public function show(string $id)
    {
        return 'aqui se va a mostrar un sector  especifico';
        // Aquí se implementará la lógica para mostrar un sector  específico
    }

    public function edit(string $id)
    {
        return 'aqui se va a mostrar el formulario para modificar un sector ';
        // Aquí se implementará la lógica para mostrar el formulario de edición de un sector 
    }

    public function update(Request $request, string $id)
    {
        return 'aqui se va a actualizar el sector ';
        // Aquí se implementará la lógica para actualizar el sector 
    }

    public function destroy(string $id)
    {
        return 'aqui se va a eliminar el sector ';
        // Aquí se implementará la lógica para eliminar el sector 
    }
}
