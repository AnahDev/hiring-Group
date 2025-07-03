<?php

namespace App\Policies;

use App\Models\usuario;

class ContratoPolicy
{
    //Detarmina si el usuario puede crear un contrato
    public function create(usuario $usuario)
    {
        return $usuario->tipo === 'hiringGroup';
    }
}
