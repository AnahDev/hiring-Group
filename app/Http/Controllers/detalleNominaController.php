<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class detalleNominaController extends Controller
{
    public function index()
    {
        return 'aqui va la vista del detalle de la nomina';
        // Se va a reemplazar por la vista de detalle de la nomina
    }

    public function crear()
    {
        return 'aqui va el formulario para crear un detalle de la nomina';
        // Se va a reemplazar por la vista de crear detalle de la nomina
    }

    public function guardar(Request $request)
    {
        return 'aqui se va a guardar el detalle de la nomina';
        // Aquí se implementará la lógica para guardar el detalle de la nomina
    }

    public function buscar(string $id)
    {
        return 'aqui se va a mostrar un detalle de la nomina especifico';
        // Aquí se implementará la lógica para mostrar un detalle de la nomina específico
    }

    public function modificar(string $id)
    {
        return 'aqui se va a mostrar el formulario para modificar un detalle de la nomina';
        // Aquí se implementará la lógica para mostrar el formulario de edición de un detalle de la nomina
    }

    public function actualizar(Request $request, string $id)
    {
        return 'aqui se va a actualizar el detalle de la nomina';
        // Aquí se implementará la lógica para actualizar el detalle de la nomina
    }

    public function eliminar(string $id)
    {
        return 'aqui se va a eliminar el detalle de la nomina';
        // Aquí se implementará la lógica para eliminar el detalle de la nomina
    }
}
