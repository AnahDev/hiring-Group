<?php

namespace App\Http\Controllers\HiringGroup;

use App\Http\Controllers\Controller;
use App\Models\ofertaLaboral;
use App\Models\postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContratacionController extends Controller
{
    public function showPostulantes(ofertaLaboral $ofertaLaboral)
    {
        // Recibe una oferta, carga sus postulaciones con la información del candidato y muestra una vista con la lista.
        $postulaciones = $ofertaLaboral->postulaciones()->with('candidato.usuario')->get();
        return view('hiringGroup.contrataciones.postulantes', compact('postulaciones'));
    }

    public function showPostulante(postulacion $postulacion)
    {
        // Recibe la postulación elegida y muestra un formulario con los campos del modelo Contrato
        return view('contrataciones.create', compact('postulacion'));
    }

    public function storeContrato(Request $request, postulacion $postulacion)
    {
        // Almacena un nuevo contrato asociado a la postulación y actualiza el estado del usuario y la oferta laboral.
        DB::transaction(function () use ($request, $postulacion) {
            // Valida los datos del formulario y crea un nuevo contrato asociado a la postulación
            $request->validate([
                'postulacion_id' => 'required|exists:postulaciones,id',
                'banco_id' => 'required|exists:bancos,id',
                'fechaInicio' => 'required|date',
                'fechaFin' => 'required|date|after_or_equal:fechaInicio',
                'duracion' => 'required|integer|min:1',
                'salarioMensual' => 'required|numeric|min:0',
                'tipoSangre' => 'required|string|max:3',
                'tlfEmergencia' => 'required|string|max:15',
                'contactoEmergencia' => 'required|string|max:255',
                'cuentaBanco' => 'required|string|max:20',
            ]);

            $contrato = $postulacion->contratos()->create($request->all());

            // Actualiza el usuario asociado al candidato
            $postulacion->candidato->usuario->update(['tipo' => 'contratado']);

            // Actualiza la oferta laboral
            $postulacion->ofertaLaboral->update(['estado' => 'inactiva']);
        });

        return redirect()->route('hiringGroup.contrataciones.postulantes', $postulacion->ofertaLaboral)
            ->with('success', 'Contrato creado exitosamente.');
    }
}
