<?php

namespace App\Http\Controllers\Contratado;

use App\Http\Controllers\Controller;
use App\Models\contrato;
use App\Models\reciboPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReciboPagoController extends Controller
{

    //Muestra la lista de recibos de pago (detalles de nómina) del usuario contratado.
    public function index(Request $request)
    {
        // 1. Encontrar el contrato del usuario autenticado.
        // La forma más segura es buscar el contrato a través de la cadena de relaciones.
        $contrato = contrato::whereHas('postulacion.candidato.usuario', function ($query) {
            $query->where('id', Auth::id());
        })->first();

        // Si por alguna razón no se encuentra un contrato, redirigir.
        if (!$contrato) {
            return redirect()->route('candidato.dashboard')->with('error', 'No se encontró información de su contrato.');
        }

        // 2. Obtener los detalles de nómina (recibos) de ese contrato.
        // Usamos 'with('nomina')' para poder acceder a los datos de la nómina (mes, año)
        // de forma optimizada.
        $recibosQuery = $contrato->detalleNomina()->with('nomina');

        // 3. Aplicar filtros si existen en la petición.
        if ($request->filled('mes')) {
            $recibosQuery->whereHas('nomina', function ($query) use ($request) {
                $query->where('mes', $request->mes);
            });
        }
        if ($request->filled('año')) {
            $recibosQuery->whereHas('nomina', function ($query) use ($request) {
                $query->where('año', $request->año);
            });
        }

        // 4. Ordenar por el más reciente y paginar los resultados.
        // Se ordena por la fecha de la tabla 'nomina' usando una subconsulta.
        $recibos = $recibosQuery->join('nomina', 'detalleNomina.nomina_id', '=', 'nomina.id')
            ->orderBy('nomina.año', 'desc')
            ->orderBy('nomina.mes', 'desc')
            ->select('detalleNomina.*') // Aseguramos que solo seleccionamos columnas de detalle_nomina
            ->paginate(12);

        // 5. Devolver la vista con los recibos para que el usuario los vea.
        return view('contratado.recibos.index', compact('recibos'));
    }
}
