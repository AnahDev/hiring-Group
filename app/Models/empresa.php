<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class empresa extends Model
{
    use HasFactory;
    protected $table = 'empresa';
    protected $fillable = [
        'usuario_id',
        'nombre',
        'correo',
    ];

    //Relaciones uno a uno

    //Relaciones uno a muchos

    //Relaciones muchos a muchos
}
