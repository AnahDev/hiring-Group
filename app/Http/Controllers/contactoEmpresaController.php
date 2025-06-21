<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class contactoEmpresaController extends Controller
{
    public function index()
    {
        return 'aqui va la vista del contacto de la empresa';
        // Se va a reemplazar por la vista de contacto de la empresa
    }

    public function create()
    {
        return 'aqui va el formulario para crear un contacto de la empresa';
        // Se va a reemplazar por la vista de crear contacto de la empresa
    }

    public function store(Request $request)
    {
        return 'aqui se va a guardar el contacto de la empresa';
        // Aquí se implementará la lógica para guardar el contacto de la empresa
    }

    public function show(string $id)
    {
        return 'aqui se va a mostrar un contacto de la empresa especifico';
        // Aquí se implementará la lógica para mostrar un contacto de la empresa específico
    }

    public function edit(string $id)
    {
        return 'aqui se va a mostrar el formulario para modificar un contacto de la empresa';
        // Aquí se implementará la lógica para mostrar el formulario de edición de un contacto de la empresa
    }

    public function update(Request $request, string $id)
    {
        return 'aqui se va a actualizar el contacto de la empresa';
        // Aquí se implementará la lógica para actualizar el contacto de la empresa
    }

    public function destroy(string $id)
    {
        return 'aqui se va a eliminar el contacto de la empresa';
        // Aquí se implementará la lógica para eliminar el contacto de la empresa
    }
}
