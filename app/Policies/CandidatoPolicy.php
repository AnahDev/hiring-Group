<?php

namespace App\Policies;

use App\Models\candidato;
use App\Models\usuario;

class CandidatoPolicy
{

    public function update(usuario $usuario, candidato $candidato)
    {
        return $usuario->id === $candidato->usuario_id;
    }

    public function view(usuario $usuario, candidato $candidato): bool
    {
        return $usuario->id === $candidato->usuario_id;
    }

    public function delete(usuario $usuario, candidato $candidato): bool
    {
        return $usuario->id === $candidato->usuario_id;
    }
}
