<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profesionController extends Controller
{
    public function index()
    {
        return 'aqui va la vista del contacto de la profesion';
        // Se va a reemplazar por la vista de contacto de la profesion
    }

    public function crear()
    {
        return 'aqui va el formulario para crear un contacto de la profesion';
        // Se va a reemplazar por la vista de crear contacto de la profesion
    }

    public function guardar(Request $request)
    {
        return 'aqui se va a guardar el contacto de la profesion';
        // Aquí se implementará la lógica para guardar el contacto de la profesion
    }

    public function buscar(string $id)
    {
        return 'aqui se va a mostrar un contacto de la profesion especifico';
        // Aquí se implementará la lógica para mostrar un contacto de la profesion específico
    }

    public function modificar(string $id)
    {
        return 'aqui se va a mostrar el formulario para modificar un contacto de la profesion';
        // Aquí se implementará la lógica para mostrar el formulario de edición de un contacto de la profesion
    }

    public function actualizar(Request $request, string $id)
    {
        return 'aqui se va a actualizar el contacto de la profesion';
        // Aquí se implementará la lógica para actualizar el contacto de la profesion
    }

    public function eliminar(string $id)
    {
        return 'aqui se va a eliminar el contacto de la profesion';
        // Aquí se implementará la lógica para eliminar el contacto de la profesion
    }
}
