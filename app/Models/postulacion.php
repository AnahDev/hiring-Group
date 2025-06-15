<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postulacion extends Model
{
    use HasFactory;

    protected $table = 'postulacion';

    protected $fillable = [
        'postulacion_id',
        'candidato_id',
        'oferta_laboral_id',
        'fechaPostulacion',
    ];
}
