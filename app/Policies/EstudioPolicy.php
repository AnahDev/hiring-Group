<?php

namespace App\Policies;

use App\Models\Estudio;
use App\Models\usuario;
use Illuminate\Auth\Access\Response;

class EstudioPolicy
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
    public function view(usuario $usuario, Estudio $estudio): bool
    {
        return false;
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
    public function update(usuario $usuario, Estudio $estudio): bool
    {
        return $usuario->candidato->id === $estudio->candidato_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(usuario $usuario, Estudio $estudio): bool
    {
        return $usuario->candidato->id === $estudio->candidato_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(usuario $usuario, Estudio $estudio): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(usuario $usuario, Estudio $estudio): bool
    {
        return false;
    }
}
