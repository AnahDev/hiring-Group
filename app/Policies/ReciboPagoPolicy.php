<?php

namespace App\Policies;

use App\Models\usuario;

class ReciboPagoPolicy
{

    public function viewAny(usuario $usuario)
    {
        return $usuario->tipo === 'contratado';
    }
}
