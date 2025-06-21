<?php

namespace App\Http\Controllers;

use App\Models\banco;
use Illuminate\Http\Request;

class bancoController extends Controller
{
    public function index()
    {
        $bancos = banco::all();
        if ($bancos->isEmpty()) {
            return response()->json(['message' => 'No hay bancos disponibles'], 404);
        }
        return $bancos;
        //return 'aqui va la vista de bancos';
    }

    public function crear()
    {
        $banco = new banco;
        $banco->nombreBanco = 'Banco de Prueba 1';
        $banco->save();
        return $banco;
        //return 'aqui va el formulario para crear un banco';
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombreBanco' => 'required|string|max:255',
        ]);
        $banco = new banco;
        $banco->nombreBanco = $request->input('nombreBanco');
        $banco->save();
        return response()->json(['message' => 'Banco creado exitosamente', 'banco' => $banco], 201);
        return 'aqui se va a guardar el banco';
    }

    public function buscarID(string $id)
    {
        $banco = banco::find($id);
        if (!$banco) {
            return response()->json(['message' => 'Banco no encontrado'], 404);
        }
        return $banco;
        //return 'aqui se va a mostrar un banco especifico';
    }

    public function buscar(string $nombre)
    {
        $banco = banco::where('nombreBanco', $nombre)->first();
        if (!$banco) {
            return response()->json(['message' => 'Banco no encontrado'], 404);
        }
        return $banco;
        // Aquí se implementará la lógica para buscar un banco por nombre
    }

    public function modificar(string $nombre)
    {
        $banco = banco::where('nombreBanco', $nombre)->first();
        if (!$banco) {
            return response()->json(['message' => 'Banco no encontrado'], 404);
        }
        $banco->nombreBanco = $nombre;
        $banco->save();
        return $banco;
        //return 'aqui se va a mostrar el formulario para modificar un banco';
    }

    public function actualizar(Request $request, string $id)
    {
        return 'aqui se va a actualizar el banco';
        // Aquí se implementará la lógica para actualizar el banco
    }

    public function eliminar(string $nombre)
    {
        $banco = banco::find($nombre);
        if (!$banco) {
            return response()->json(['message' => 'Banco no encontrado'], 404);
        }
        $banco->delete();
        return response()->json(['message' => 'Banco eliminado exitosamente'], 200);
        //return 'aqui se va a eliminar el banco';
    }
}
