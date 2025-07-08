<?php

namespace App\Policies;

use App\Models\sectorEmpresa;
use App\Models\usuario;
use Illuminate\Support\Facades\Log;

class SectorEmpresaPolicy
{
    //Autorizar eliminacion de un sector de la empresa
    public function delete(usuario $usuario, sectorEmpresa $sectorEmpresa): bool
    {
        return $usuario->empresa && $usuario->empresa->id === $sectorEmpresa->empresa_id;
    }
}
