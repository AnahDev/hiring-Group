<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

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
}
