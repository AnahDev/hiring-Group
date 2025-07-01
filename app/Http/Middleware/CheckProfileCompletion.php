<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $usuario = Auth::user();

        // Si el usuario es un candidato y no tiene un perfil de candidato creado...
        if ($usuario->tipo === 'candidato' && is_null($usuario->candidato)) {
            // ...y no está ya intentando crear su perfil, lo redirigimos.
            if (!$request->routeIs('candidato.perfil.crear') && !$request->routeIs('candidato.perfil.store')) {
                return redirect()->route('candidato.perfil.crear')
                    ->with('info', 'Por favor, completa tu perfil para continuar.');
            }
        }

        // Aquí podrías añadir una lógica similar para el tipo 'empresa'
        // if ($usuario->tipo === 'empresa' && is_null($usuario->empresa)) { ... }
        return $next($request);
    }
}
