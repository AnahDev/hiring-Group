<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class experienciaLaboral extends Model
{
    use HasFactory;
    protected $table = 'experienciaLaboral';
    protected $fillable = [
        'candidato_id',
        'empresa',
        'cargo',
        'fechaInicio',
        'fechaFin',
    ];
}
