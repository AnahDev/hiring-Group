<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class empresa extends Model
{
    use HasFactory;
    protected $table = 'empresa';
    protected $fillable = [
        'usuario_id',
        'nombre',
        'correo',
    ];
}
