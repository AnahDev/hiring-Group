<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

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
    public function handle(Request $request, Closure $next): Response
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        return $next($request);
        if (!Auth::check() || !in_array(Auth::user()->tipo, $roles)) {
            // Si el usuario no está autenticado o su rol no está en la lista de roles permitidos,
            // se le deniega el acceso.
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}

