<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
