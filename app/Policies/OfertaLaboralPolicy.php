<?php

namespace App\Policies;

use App\Models\ofertaLaboral;
use App\Models\usuario;
use Illuminate\Auth\Access\Response;

class OfertaLaboralPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(usuario $usuario): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(usuario $usuario, ofertaLaboral $ofertaLaboral): bool
    {
        return $usuario->empresa && $ofertaLaboral->empresa_id === $usuario->empresa->id;
        // esta funcion verifica si el usuario tiene una empresa asociada y si la oferta laboral pertenece a esa empresa
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(usuario $usuario): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(usuario $usuario, ofertaLaboral $ofertaLaboral): bool
    {
        return $usuario->empresa && $ofertaLaboral->empresa_id === $usuario->empresa->id;
        // esta funcion verifica si el usuario tiene una empresa asociada y si la oferta laboral pertenece a esa empresa
        // si el usuario es una empresa y la oferta laboral pertenece a esa empresa, entonces puede actualizarla
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(usuario $usuario, ofertaLaboral $ofertaLaboral): bool
    {
        return $usuario->empresa && $ofertaLaboral->empresa_id === $usuario->empresa->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(usuario $usuario, ofertaLaboral $ofertaLaboral): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(usuario $usuario, ofertaLaboral $ofertaLaboral): bool
    {
        return false;
    }
}
