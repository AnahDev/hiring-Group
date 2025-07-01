<?php

namespace App\Policies;

use App\Models\ExperienciaLaboral;
use App\Models\usuario;
use Illuminate\Auth\Access\Response;

class ExperienciaLaboralPolicy
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
    public function view(usuario $usuario, ExperienciaLaboral $experienciaLaboral): bool
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

    //Un usuario puede actualizar una experiencia SI esa experiencia le pertenece.
    public function update(usuario $usuario, ExperienciaLaboral $experienciaLaboral): bool
    {
        return $usuario->candidato->id === $experienciaLaboral->candidato_id;
    }

    //Un usuario puede eliminar una experiencia SI esa experiencia le pertenece.
    public function delete(usuario $usuario, ExperienciaLaboral $experienciaLaboral): bool
    {
        return $usuario->candidato->id === $experienciaLaboral->candidato_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(usuario $usuario, ExperienciaLaboral $experienciaLaboral): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(usuario $usuario, ExperienciaLaboral $experienciaLaboral): bool
    {
        return false;
    }
}
