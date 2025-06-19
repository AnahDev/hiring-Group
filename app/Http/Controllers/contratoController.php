<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class contratoController extends Controller
{
    public function index()
    {
        return 'aqui va la vista del contrato';
        // Se va a reemplazar por la vista de contrato
    }

    public function crear()
    {
        return 'aqui va el formulario para crear un contrato';
        // Se va a reemplazar por la vista de crear contrato
    }

    public function guardar(Request $request)
    {
        return 'aqui se va a guardar el contrato';
        // Aquí se implementará la lógica para guardar el contrato
    }

    public function buscar(string $id)
    {
        return 'aqui se va a mostrar un contrato especifico';
        // Aquí se implementará la lógica para mostrar un contrato específico
    }

    public function modificar(string $id)
    {
        return 'aqui se va a mostrar el formulario para modificar un contrato';
        // Aquí se implementará la lógica para mostrar el formulario de edición de un contrato
    }

    public function actualizar(Request $request, string $id)
    {
        return 'aqui se va a actualizar el contrato';
        // Aquí se implementará la lógica para actualizar el contrato
    }

    public function eliminar(string $id)
    {
        return 'aqui se va a eliminar el contrato';
        // Aquí se implementará la lógica para eliminar el contrato
    }
}
