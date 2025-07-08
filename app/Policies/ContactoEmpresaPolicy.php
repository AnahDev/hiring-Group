<?php

namespace App\Policies;

use App\Models\contactoEmpresa;
use App\Models\usuario;

class ContactoEmpresaPolicy
{
    //Autorizar eliminacion de un sector de la empresa
    public function delete(usuario $usuario, contactoEmpresa $contactoEmpresa): bool
    {
        return $usuario->empresa && $usuario->empresa->id === $contactoEmpresa->empresa_id;
    }
}
