<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class nominaController extends Controller
{
    public function index()
    {
        return 'aqui va la vista del nomina';
        // Se va a reemplazar por la vista de nomina
    }

    public function crear()
    {
        return 'aqui va el formulario para crear un nomina';
        // Se va a reemplazar por la vista de crear nomina
    }

    public function guardar(Request $request)
    {
        return 'aqui se va a guardar el nomina';
        // Aquí se implementará la lógica para guardar el nomina
    }

    public function buscar(string $id)
    {
        return 'aqui se va a mostrar un nomina especifico';
        // Aquí se implementará la lógica para mostrar un nomina específico
    }

    public function modificar(string $id)
    {
        return 'aqui se va a mostrar el formulario para modificar un nomina';
        // Aquí se implementará la lógica para mostrar el formulario de edición de un nomina
    }

    public function actualizar(Request $request, string $id)
    {
        return 'aqui se va a actualizar el nomina';
        // Aquí se implementará la lógica para actualizar el nomina
    }

    public function eliminar(string $id)
    {
        return 'aqui se va a eliminar el nomina';
        // Aquí se implementará la lógica para eliminar el nomina
    }
}
