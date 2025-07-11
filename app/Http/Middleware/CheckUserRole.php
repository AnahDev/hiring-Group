<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles Los roles permitidos para acceder a la ruta.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        Log::info('--- Debug Middleware de Rol ---');
        Log::info('URL solicitada: ' . $request->fullUrl());
        Log::info('Roles esperados por el middleware: ' . implode(', ', $roles));

        // 1. Verificar si el usuario está autenticado
        if (!Auth::check()) {
            Log::warning('DEBUG_ROLE: Usuario NO autenticado. Redirigiendo o abortando 403.');
            abort(403, 'Acceso no autorizado: Necesitas iniciar sesión.');
        }

        $user = Auth::user();
        Log::info('DEBUG_ROLE: Usuario autenticado ID: ' . $user->id);
        Log::info('DEBUG_ROLE: Tipo de usuario autenticado: ' . $user->tipo);

        // 2. Verificar si el tipo de usuario está en los roles permitidos
        if (!in_array($user->tipo, $roles)) {
            Log::warning("DEBUG_ROLE: Tipo de usuario '{$user->tipo}' NO PERMITIDO. Roles requeridos: " . implode(', ', $roles) . ". Abortando 403.");
            abort(403, 'Acceso no autorizado: Tu tipo de usuario no tiene permiso.');
        }

        Log::info('DEBUG_ROLE: Verificación de rol exitosa. Procediendo con la solicitud.');
        return $next($request);

        /*  // La lógica de validación debe ir antes de pasar la petición
        if (!Auth::check() || !in_array(Auth::user()->tipo, $roles)) {
            abort(403, 'Acceso no autorizado.');
        }
        return $next($request); */
    }
}
