<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class profesion extends Model
{
    use HasFactory;
    protected $table = 'profesion';
    protected $fillable = [
        'descripcion',
    ];

    public function candidatoProfesiones(): HasMany
    {
        return $this->hasMany(candidato_profesion::class, 'profesion_id');
    }

    public function ofertaLaboral(): HasMany
    {
        return $this->hasMany(ofertaLaboral::class, 'profesion_id');
    }


    public function ofertas(): HasMany
    {
        return $this->hasMany(ofertaLaboral::class, 'profesion_id');
    }
}
