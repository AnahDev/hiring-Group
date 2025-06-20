<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class candidato extends Model
{
    use HasFactory;
    protected $table = 'candidato';
    protected $fillable = [
        'usuario_id',
        'nombre',
        'apellido',
        'direccion',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(usuario::class, 'usuario_id');
    }

    public function estudios(): HasMany
    {
        return $this->hasMany(estudio::class, 'candidato_id');
    }

    public function telefonos(): HasMany
    {
        return $this->hasMany(telefono::class, 'candidato_id');
    }

    public function experienciasLaborales(): HasMany
    {
        return $this->hasMany(experienciaLaboral::class, 'candidato_id');
    }

    public function candidatoProfesiones(): HasMany
    {
        return $this->hasMany(candidato_profesion::class, 'candidato_id');
    }
}
