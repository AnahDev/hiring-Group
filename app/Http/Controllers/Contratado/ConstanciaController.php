<?php

namespace App\Http\Controllers\Contratado;

use App\Http\Controllers\Controller;
use App\Models\contrato;
use App\Models\usuario;
use App\Models\postulacion;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConstanciaController extends Controller
{
    public function create()
    {
        return view('contratado.constancia.create');
    }
    public function store(Request $request)
    {
        $user = Auth::user();

        // 1. Verificar si el usuario es contratado y tiene perfil de candidato
        if ($user->tipo !== 'contratado' || !$user->candidato) {
            abort(403, 'Acceso no autorizado o perfil de candidato incompleto.');
        }

        $candidato = $user->candidato;

        // 2. Obtener el contrato más reciente y "activo" para el candidato
        // Esto asume que un contratado tiene un contrato asociado a su perfil de candidato.
        // Podrías necesitar ajustar esta lógica si un candidato puede tener múltiples contratos
        // o si solo quieres el contrato actual.
        $contrato = Contrato::whereHas('postulacion', function ($query) use ($candidato) {
            $query->where('candidato_id', $candidato->id);
            // Opcional: Filtrar por postulaciones con estado 'contratado' o similares
            // $query->where('estado', 'contratado');
        })
            ->with('postulacion.ofertaLaboral.empresa') // Cargar relaciones anidadas
            ->latest('fechaInicio') // Asume que el contrato más reciente es el relevante 
            ->first();

        if (!$contrato) {
            return redirect()->back()->with('error', 'No se encontró un contrato activo para generar la constancia.');
        }

        // 3. Extraer los datos de la constancia
        $nombreCompleto = $candidato->nombre . ' ' . $candidato->apellido;
        $fechaInicioLabores = Carbon::parse($contrato->fechaInicio)->format('d/m/Y');
        $salarioMensual = $contrato->salarioMensual;
        $cargo = $contrato->postulacion->ofertaLaboral->cargo;
        $nombreEmpresa = $contrato->postulacion->ofertaLaboral->empresa->nombre;

        // Fecha de la constancia (fecha actual)
        $fechaConstancia = Carbon::now()->format('d/m/Y');

        // 4. Renderizar la vista de la constancia
        return view('contratado.constancia.show', [
            'nombreCompleto' => $nombreCompleto,
            'fechaInicioLabores' => $fechaInicioLabores,
            'cargo' => $cargo,
            'nombreEmpresa' => $nombreEmpresa,
            'salarioMensual' => $salarioMensual,
            'fechaConstancia' => $fechaConstancia,
            'ciudad' => 'Puerto Ordaz',
        ]);
    }
}
