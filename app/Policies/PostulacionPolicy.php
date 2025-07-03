<?php

namespace App\Policies;

use App\Models\ofertaLaboral;
use App\Models\usuario;

class PostulacionPolicy
{
    public function create(usuario $usuario, ofertaLaboral $oferta)
    {
        return $usuario->tipo === 'candidato' && $oferta->estado === 'activa';
    }
}
