<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ofertaLaboral extends Model
{
    use HasFactory;
    protected $table = 'ofertas_laborales';
    protected $fillable = [
        'oferta_id',
        'empresa_id',
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
}
