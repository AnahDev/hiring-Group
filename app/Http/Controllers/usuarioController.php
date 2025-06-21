<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class usuarioController extends Controller
{
    public function index()
    {
        return 'aqui va la vista del usuario';
        // Se va a reemplazar por la vista de usuario
    }

    public function create()
    {
        return 'aqui va el formulario para crear un usuario';
        // Se va a reemplazar por la vista de crear usuario
    }

    public function store(Request $request)
    {
        return 'aqui se va a guardar el usuario';
        // Aquí se implementará la lógica para guardar el usuario
    }

    public function show(string $id)
    {
        return 'aqui se va a mostrar un usuario especifico';
        // Aquí se implementará la lógica para mostrar un usuario específico
    }

    public function edit(string $id)
    {
        return 'aqui se va a mostrar el formulario para modificar un usuario';
        // Aquí se implementará la lógica para mostrar el formulario de edición de un usuario
    }

    public function update(Request $request, string $id)
    {
        return 'aqui se va a actualizar el usuario';
        // Aquí se implementará la lógica para actualizar el usuario
    }

    public function destroy(string $id)
    {
        return 'aqui se va a eliminar el usuario';
        // Aquí se implementará la lógica para eliminar el usuario
    }
}
