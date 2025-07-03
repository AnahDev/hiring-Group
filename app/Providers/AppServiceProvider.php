<?php

namespace App\Providers;

use App\Models\contrato;
use App\Models\estudio;
use App\Models\experienciaLaboral;
use App\Models\ofertaLaboral;
use App\Models\postulacion;
use App\Models\reciboPago;
use App\Policies\ContratoPolicy;
use App\Policies\EstudioPolicy;
use App\Policies\ExperienciaLaboralPolicy;
use App\Policies\OfertaLaboralPolicy;
use App\Policies\PostulacionPolicy;
use App\Policies\ReciboPagoPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //LÍNEA PARA REGISTRAR TU POLICY
        Gate::policy(ofertaLaboral::class, OfertaLaboralPolicy::class);
        Gate::policy(experienciaLaboral::class, ExperienciaLaboralPolicy::class);
        Gate::policy(estudio::class, EstudioPolicy::class);
        Gate::policy(postulacion::class, PostulacionPolicy::class);
        Gate::policy(contrato::class, ContratoPolicy::class);
        Gate::policy(reciboPago::class, ReciboPagoPolicy::class);
    }
}
