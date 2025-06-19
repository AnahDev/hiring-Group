<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class bancoController extends Controller
{
    public function index()
    {
        return 'aqui va la vista del banco';
        // Se va a reemplazar por la vista de banco
    }

    public function crear()
    {
        return 'aqui va el formulario para crear un banco';
        // Se va a reemplazar por la vista de crear banco
    }

    public function guardar(Request $request)
    {
        return 'aqui se va a guardar el banco';
        // Aquí se implementará la lógica para guardar el banco
    }

    public function buscar(string $id)
    {
        return 'aqui se va a mostrar un banco especifico';
        // Aquí se implementará la lógica para mostrar un banco específico
    }

    public function modificar(string $id)
    {
        return 'aqui se va a mostrar el formulario para modificar un banco';
        // Aquí se implementará la lógica para mostrar el formulario de edición de un banco
    }

    public function actualizar(Request $request, string $id)
    {
        return 'aqui se va a actualizar el banco';
        // Aquí se implementará la lógica para actualizar el banco
    }

    public function eliminar(string $id)
    {
        return 'aqui se va a eliminar el banco';
        // Aquí se implementará la lógica para eliminar el banco
    }
}
