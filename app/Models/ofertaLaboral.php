<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ofertaLaboral extends Model
{
    use HasFactory;
    protected $table = 'oferta_laboral';
    protected $fillable = [
        'empresa_id',
        'profesion_id',
        'cargo',
        'descripcion',
        'salario',
        'estado',
        'fechaCreacion',
        'ubicacion',
    ];

    //muchos a uno
    public function empresa(): BelongsTo
    {
        return $this->belongsTo(empresa::class, 'empresa_id');
    }
    public function profesion(): BelongsTo
    {
        return $this->belongsTo(profesion::class, 'profesion_id');
    }

    // Relacion uno a muchos
    public function postulaciones(): HasMany
    {
        return $this->hasMany(postulacion::class, 'oferta_laboral_id');
    }
}
