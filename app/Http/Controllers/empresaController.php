<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'Aqui se va la vista de empresa';
        // Se va a reemplazar por la vista de empresa
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'Aqui se va el formulario para crear una empresa';
        // Se va a reemplazar por la vista de crear empresa
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'Aqui se va a guardar la empresa';
        // Aquí se implementará la lógica para guardar la empresa
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'Aqui se va a mostrar una empresa especifica';
        // Aquí se implementará la lógica para mostrar una empresa específica;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return 'Aqui se va a mostrar el formulario para modificar una empresa';
        // Aquí se implementará la lógica para mostrar el formulario de edición de una empresa
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return 'Aqui se va a actualizar la empresa';
        // Aquí se implementará la lógica para actualizar la empresa
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return 'Aqui se va a eliminar la empresa';
        // Aquí se implementará la lógica para eliminar la empresa
    }
}
