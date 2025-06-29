<?php

namespace App\Providers;

use App\Models\ofertaLaboral;
use App\Policies\OfertaLaboralPolicy;
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
    }
}
