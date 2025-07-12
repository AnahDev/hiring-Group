<?php

namespace App\Http\Controllers\Contratado;

use App\Http\Controllers\Controller;
use App\Models\contrato;
use App\Models\detalleNomina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReciboPagoController extends Controller
{

    //Muestra la lista de recibos de pago (detalles de nómina) del usuario contratado.
    public function index(Request $request)
    {

        // 1. Iniciamos la consulta directamente desde el modelo detalleNomina (el recibo).
        // Le decimos que cargue la relación 'nomina' para tener acceso a la fecha.
        $recibosQuery = detalleNomina::with('nomina')
            // Y le pedimos que solo traiga los recibos cuyo contrato pertenezca al usuario autenticado.
            ->whereHas('contrato.postulacion.candidato.usuario', function ($query) {
                $query->where('id', Auth::id());
            });

        // 2. Aplicar filtros si existen en la petición.
        if ($request->filled('mes')) {
            // Filtramos en la relación 'nomina' que ya cargamos.
            $recibosQuery->whereHas('nomina', function ($query) use ($request) {
                $query->where('mes', $request->mes);
            });
        }
        if ($request->filled('año')) {
            $recibosQuery->whereHas('nomina', function ($query) use ($request) {
                $query->where('año', $request->año);
            });
        }

        // 3. Ordenar por el más reciente y ejecutar la consulta para obtener los resultados paginados.
        $recibos = $recibosQuery
            // Para ordenar por fecha, necesitamos unir la tabla nomina.
            ->join('nomina', 'detalleNomina.nomina_id', '=', 'nomina.id')
            ->orderBy('nomina.año', 'desc')
            ->orderBy('nomina.mes', 'desc')
            // Seleccionamos solo las columnas de detalle_nomina para evitar conflictos de 'id'.
            ->select('detalleNomina.*')
            ->paginate(12);

        // 4. Devolver la vista con los recibos.
        // Si la consulta no encuentra nada, $recibos será una colección vacía
        return view('contratado.recibos.index', compact('recibos'));
    }
}
