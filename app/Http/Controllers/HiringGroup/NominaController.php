<?php

namespace App\Http\Controllers\HiringGroup;

use App\Http\Controllers\Controller;
use App\Models\contrato;
use App\Models\detalleNomina;
use App\Models\empresa;
use App\Models\nomina;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NominaController extends Controller
{
    // Muestra el formulario para seleccionar la empresa, mes y año para la nómina.
    public function showPreparacionForm()
    {
        $empresas = Empresa::orderBy('nombre')->get();
        return view('hiringGroup.nomina.preparar', compact('empresas'));
    }

    //Genera y muestra un reporte de vista previa de la nómina antes de ejecutarla.
    public function generarReporte(Request $request)
    {

        $request->validate([
            'empresa_id' => 'required|exists:empresa,id', // Corregido a 'empresas'
            'mes' => 'required|integer|min:1|max:12',
            'año' => 'required|integer|min:2020|max:' . (Carbon::now()->year + 1), // Rango más dinámico
        ]);

        $empresa = Empresa::findOrFail($request->empresa_id);
        $mes = $request->mes;
        $año = $request->año;

        // Verificar si ya existe una nómina para este mes/año/empresa
        $nominaExistente = Nomina::where('empresa_id', $empresa->id)
            ->where('mes', $mes)
            ->where('año', $año)
            ->first(); // Usar first() para obtener el objeto

        if ($nominaExistente) {
            return redirect()->back()->with('warning', 'Ya existe una nómina procesada para esta empresa en el mes y año seleccionados. Por favor, revise el historial.');
        }

        // Buscamos todos los contratos activos asociados a la empresa seleccionada.
        $contratos = Contrato::whereHas('postulacion.ofertaLaboral', function ($query) use ($empresa) {
            $query->where('empresa_id', $empresa->id);
        })
            ->where('fechaInicio', '<=', Carbon::now()) // Considera solo contratos que ya han iniciado
            ->where(function ($query) { // Y que no han finalizado o su fecha fin es en el futuro
                $query->whereNull('fechaFin')
                    ->orWhere('fechaFin', '>=', Carbon::now()->startOfMonth()); // O >= al inicio del mes actual
            })
            ->with('postulacion.candidato.usuario') // Cargamos datos del empleado para mostrarlos
            ->get();

        // Pasa los datos a la vista de reporte
        return view('hiringGroup.nomina.reporte', compact('empresa', 'mes', 'año', 'contratos'));
    }


    //Ejecuta la corrida de nómina, realizando los cálculos y guardando los registros.
    public function ejecutarCorrida(Request $request)
    {
        $request->validate([
            'empresa_id' => 'required|exists:empresa,id',
            'mes' => 'required|integer|min:1|max:12',
            'año' => 'required|integer|min:2020',
        ]);

        $empresa_id = $request->empresa_id;
        $mes = $request->mes;
        $año = $request->año;

        // Verificamos que no se haya corrido ya esta nómina
        $nominaExistente = nomina::where('empresa_id', $empresa_id)->where('mes', $mes)->where('año', $año)->exists();
        if ($nominaExistente) {
            return redirect()->back()->with('error', "La nómina para esta empresa en $mes/$año ya fue ejecutada.");
        }

        // Definición de porcentajes 
        $incestPorcentaje = 0.005; // 0.5%
        $ivssPorcentaje = 0.01;   // 1%
        $comisionHgPorcentaje = 0.02; // 2%

        // Inicia una transacción de base de datos
        DB::beginTransaction();
        try {
            // 1. Crear el registro principal de la nómina (encabezado)

            $nomina = Nomina::create([
                'empresa_id' => $empresa_id,
                'mes' => $mes,
                'año' => $año,
                'fechaGeneracion' => Carbon::now(),
            ]);


            // 2. Obtener los contratos activos de la empresa (misma lógica que generarReporte)
            $contratos = Contrato::whereHas('postulacion.ofertaLaboral', function ($query) use ($empresa_id) {
                $query->where('empresa_id', $empresa_id);
            })
                ->where('fechaInicio', '<=', Carbon::now())
                ->where(function ($query) {
                    $query->whereNull('fechaFin')->orWhere('fechaFin', '>=', Carbon::now()->startOfMonth());
                })
                ->get();

            if ($contratos->isEmpty()) {
                // Lanza una excepción para revertir la transacción si no hay empleados
                throw new \Exception('No hay empleados activos para procesar en esta nómina.');
            }

            // 3. Iterar sobre cada contrato para generar su detalle de nómina
            foreach ($contratos as $contrato) {
                $sueldoBruto = $contrato->salarioMensual;

                // 4. Calcular deducciones y comisiones
                $deduccionInces = $sueldoBruto * $incestPorcentaje;
                $deduccionIvss = $sueldoBruto * $ivssPorcentaje;
                $comisionHg = $sueldoBruto * $comisionHgPorcentaje;
                $salarioNeto = $sueldoBruto - $deduccionInces - $deduccionIvss;


                // El salario neto es el bruto menos las deducciones del trabajador.
                // La comisión de HG es un costo para la empresa, no una deducción para el empleado.
                $salarioNeto = $sueldoBruto - $deduccionInces - $deduccionIvss;

                // 5. Crear el registro en detalle_nomina
                detalleNomina::create([
                    'nomina_id' => $nomina->id,
                    'contrato_id' => $contrato->id,
                    'sueldoBruto' => $sueldoBruto,
                    'comisionHg' => $comisionHg,
                    'deduccionInces' => $deduccionInces,
                    'deduccionIvss' => $deduccionIvss,
                    'salarioNeto' => $salarioNeto,
                ]);
            }
            DB::commit(); // Confirma la transacción si todo sale bien
        } catch (\Exception $e) {
            DB::rollBack(); // Revierte la transacción en caso de error
            Log::error("Error en corrida de nómina: " . $e->getMessage());
            return redirect()->back()->with('error', "Error al ejecutar la nómina: " . $e->getMessage());
        }

        return redirect()->route('hiringGroup.dashboard')->with('success', "Nómina para $mes/$año ejecutada correctamente.");
    }

    // Muestra el historial de nóminas procesadas.
    public function historial()
    {
        // Obtener todas las nóminas, ordenadas por año y mes descendente
        // Carga la relación 'empresa' para mostrar el nombre de la empresa
        // También carga 'detalleNomina' para que los accesores de totales funcionen correctamente en la vista de lista si los usas.
        $nominas = Nomina::with('empresa', 'detalleNomina')
            ->orderByDesc('año')
            ->orderByDesc('mes')
            ->get();

        return view('hiringGroup.nomina.historial', compact('nominas'));
    }

    public function showHistorial(Nomina $nomina)
    {
        // Carga las relaciones necesarias para el detalle:
        // - 'empresa' para el nombre de la empresa
        // - 'detalleNomina' para los pagos individuales
        // - 'detalleNomina.contrato.postulacion.candidato.usuario' para obtener la información del empleado
        $nomina->load([
            'empresa',
            'detalleNomina.contrato.postulacion.candidato.usuario'
        ]);
        return view('hiringGroup.nomina.historial_show', compact('nomina'));
    }
}
