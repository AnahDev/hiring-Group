<?php

namespace App\Http\Controllers\Contratado;

use App\Http\Controllers\Controller;
use App\Models\reciboPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReciboPagoController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', reciboPago::class);

        $usuario = Auth::user();

        // Filtros por mes y año
        $query = reciboPago::where('usuario_id', $usuario->id);

        if ($request->filled('mes')) {
            $query->whereMonth('fecha', $request->mes);
        }
        if ($request->filled('anio')) {
            $query->whereYear('fecha', $request->anio);
        }

        $recibos = $query->orderByDesc('fecha')->get();

        return view('contratado.recibos.index', compact('recibos'));
    }
}
