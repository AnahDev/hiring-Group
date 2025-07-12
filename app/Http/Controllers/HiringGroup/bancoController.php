<?php

namespace App\Http\Controllers\HiringGroup;

use App\Http\Controllers\Controller;
use App\Models\banco;
use Illuminate\Http\Request;

class bancoController extends Controller
{
    //Muestra una lista paginada de todos los bancos.
    public function index()
    {
        $bancos = banco::orderBy('id')->paginate(10);
        return view('hiringGroup.bancos.index', compact('bancos'));
    }

    //Muestra el formulario para crear un nuevo banco.
    public function create()
    {
        return view('hiringGroup.bancos.create');
    }

    //Almacena un nuevo banco en la base de datos.
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombreBanco' => 'required|string|max:255|unique:bancos,nombreBanco',
            /* 'codigoBanco' => 'required|string|max:10|unique:bancos,codigoBanco', */
            [
                'nombreBanco.unique' => 'Ya existe un banco con este nombre.',
                'nombreBanco.required' => 'El nombre del banco es obligatorio.',
            ]
        ]);

        // Crear el banco
        banco::create($request->all());

        return redirect()->route('hiringGroup.bancos.index')
            ->with('success', 'Banco creado exitosamente.');
    }

    //Muestra los detalles de un banco y todos los contratos asociados.
    public function show(banco $banco)
    {
        // Cargamos los contratos y, para cada contrato, la información del empleado.
        // La relación es: Banco -> Contrato -> Postulación -> Candidato -> Usuario
        $banco->load('contrato.postulacion.candidato.usuario');

        return view('hiringGroup.bancos.show', compact('banco'));
    }

    //Muestra el formulario para editar un banco existente.
    public function edit(banco $banco)
    {
        return view('hiringGroup.bancos.edit', compact('banco'));
    }

    //Actualiza un banco en la base de datos.
    public function update(Request $request, banco $banco)
    {
        $request->validate([
            'nombreBanco' => 'required|string|max:255|unique:banco,nombreBanco,' . $banco->id,
        ]);

        $banco->update($request->all());

        return redirect()->route('hiringGroup.bancos.index')->with('success', 'Banco actualizado exitosamente.');
    }

    //Elimina un banco de la base de datos.
    public function destroy(banco $banco)
    {
        // Requerimiento: Verificar si el banco tiene contratos asociados antes de eliminar.
        // Usamos withCount para contar las relaciones de forma eficiente.
        $banco->loadCount('contrato');

        if ($banco->contrato_count > 0) {
            // Si tiene contratos, no se puede eliminar.
            return redirect()->route('hiringGroup.bancos.index')->with('error', 'No se puede eliminar el banco porque tiene contratos asociados.');
        }

        $banco->delete();

        return redirect()->route('hiringGroup.bancos.index')->with('success', 'Banco eliminado exitosamente.');
    }
}
