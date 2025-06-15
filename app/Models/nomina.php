<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class nomina extends Model
{
    use HasFactory;
    protected $table = 'nomina';
    protected $fillable = [
        'empresa_id',
        'mes;',
        'año',
        'fechaGeneracion',
    ];
}
