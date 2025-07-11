<?php

namespace App\Http\Controllers\HiringGroup;

use App\Http\Controllers\Controller;
use App\Models\banco;
use App\Models\contrato;
use App\Models\detalleNomina;
use App\Models\ofertaLaboral;
use App\Models\postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContratacionController extends Controller
{
    public function index()
    {
        // Muestra todas las postulaciones con información de los candidato y la oferta laboral.
        $postulaciones = postulacion::with([
            'candidato',
            'ofertaLaboral.empresa'
        ])->get();

        return view('hiringGroup.contrataciones.index', compact('postulaciones'));
    }

    public function create(postulacion $postulacion)
    {
        $this->authorize('create', contrato::class);
        $bancos = banco::all();
        return view('hiringGroup.contrataciones.create', compact('postulacion', 'bancos'));
    }

    public function show(ofertaLaboral $ofertaLaboral)
    {
        // Recibe una oferta, carga sus postulaciones con la información del candidato y muestra una vista con la lista.
        $postulaciones = $ofertaLaboral->postulaciones()->with('candidato.usuario')->get();
        return view('hiringGroup.contrataciones.show', compact('postulaciones', 'ofertaLaboral'));
    }

    public function store(Request $request, postulacion $postulacion)
    {
        $this->authorize('create', contrato::class);

        // Valida los datos del formulario y crea un nuevo contrato asociado a la postulación
        $validatedData = $request->validate([
            'banco_id' => 'required|exists:banco,id',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'duracion' => 'required|integer|min:1',
            'salarioMensual' => 'required|numeric|min:0',
            'tipoSangre' => 'required|string|max:3',
            'tlfEmergencia' => 'required|string|max:15',
            'contactoEmergencia' => 'required|string|max:255',
            'cuentaBanco' => 'required|string|max:20',
        ]);

        try {
            // 2. Usamos una transacción para garantizar la integridad de los datos.
            // Si algo falla dentro de este bloque, todas las operaciones se revierten.
            DB::transaction(function () use ($validatedData, $postulacion) {
                // Paso A: Crear el contrato.
                // Asociamos el 'postulacion_id' para mantener el vínculo histórico.
                contrato::create(array_merge($validatedData, [
                    'postulacion_id' => $postulacion->id,
                ]));

                // Paso B: Actualizar el rol del usuario.
                // El candidato ahora es oficialmente un contratado.
                $usuario = $postulacion->candidato->usuario;
                $usuario->tipo = 'contratado';
                $usuario->save();

                // Paso C: Desactivar la oferta laboral.
                // La vacante ha sido cubierta y ya no debe aceptar más postulaciones.
                $oferta = $postulacion->ofertaLaboral;
                $oferta->estado = 'inactiva';
                $oferta->save();
            });
        } catch (\Exception $e) {
            // Si ocurre cualquier error, lo registramos para depuración
            // y devolvemos al usuario con un mensaje de error.
            Log::error('Error al crear contrato: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error inesperado al procesar la contratación. Por favor, inténtelo de nuevo.')->withInput();
        }

        // 3. Si todo fue exitoso, redirigimos al dashboard con un mensaje de éxito.
        return redirect()->route('hiringGroup.contrataciones.index')->with('success', '¡Candidato contratado exitosamente!');


        /* DB::transaction(function () use ($request, $postulacion) {
            // Crear el contrato
            $contrato = $postulacion->contrato()->create($request->all());

            // Crear el detalle de nómina asociado
            detalleNomina::create([
                'nomina_id' => $contrato->nomina_id,
                'contrato_id' => $contrato->id,
                'sueldoBruto' => $contrato->salarioMensual,
                'comisionHg' => 0,
                'deduccionInces' => 0,
                'deduccionIvss' => 0,
                'salarioNeto' => $contrato->salarioMensual,
            ]);

            // Actualiza el usuario asociado al candidato
            $postulacion->candidato->usuario->update(['tipo' => 'contratado']);

            // Actualiza la oferta laboral
            $postulacion->ofertaLaboral->update(['estado' => 'inactiva']);
        });
        return redirect()->route('hiringGroup.dashboard')
            ->with('success', 'Contrato y detalle de nómina creados correctamente.'); */
    }
}
