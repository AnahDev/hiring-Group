<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudio extends Model
{
    use HasFactory;
    protected $table = 'estudios';

    protected $fillable = [
        'candidato_id',
        'nombreUni',
        'carrera',
        'fechaEgreso',
    ];
}
