<?php

namespace App\Policies;

use App\Models\ofertaLaboral;
use App\Models\usuario;
use Illuminate\Auth\Access\Response;

class OfertaLaboralPolicy
{

    //Permitir a admin y hiringGroup hacer cualquier cosa
    public function before(usuario $usuario, string $ability): ?bool
    {
        if ($usuario->tipo === 'admin' || $usuario->tipo === 'hiringGroup') {
            return true;
        }
        return null; // Dejar que otros métodos decidan
    }

    // Quién puede ver una lista de ofertas (la suya o todas)
    public function viewAny(usuario $usuario): bool
    {
        return $usuario->tipo === 'empresa' || $usuario->tipo === 'candidato';
    }

    // Quién puede ver UNA oferta específica
    public function view(usuario $usuario, ofertaLaboral $ofertaLaboral): bool
    {
        // Una empresa puede ver su propia oferta
        if ($usuario->empresa && $ofertaLaboral->empresa_id === $usuario->empresa->id) {
            return true;
        }
        // Un candidato puede ver cualquier oferta activa (lógica para el futuro controlador de candidato)
        if ($usuario->tipo === 'candidato' && $ofertaLaboral->estado === 'activa') {
            return true;
        }
        return false;
    }

    // Quién puede crear ofertas
    public function create(usuario $usuario): bool
    {
        return $usuario->tipo === 'empresa' && $usuario->empresa !== null;
    }

    // Quién puede actualizar una oferta
    public function update(usuario $usuario, ofertaLaboral $ofertaLaboral): bool
    {
        return $usuario->empresa && $ofertaLaboral->empresa_id === $usuario->empresa->id;
        // esta funcion verifica si el usuario tiene una empresa asociada y si la oferta laboral pertenece a esa empresa
        // si se cumple, entonces puede actualizarla
    }

    // Quién puede eliminar una oferta
    public function delete(usuario $usuario, ofertaLaboral $ofertaLaboral): bool
    {
        return $usuario->empresa && $ofertaLaboral->empresa_id === $usuario->empresa->id;
    }

    /* public function restore(usuario $usuario, ofertaLaboral $ofertaLaboral): bool
    {
        return false;
    }


    public function forceDelete(usuario $usuario, ofertaLaboral $ofertaLaboral): bool
    {
        return false;
    }*/
}
