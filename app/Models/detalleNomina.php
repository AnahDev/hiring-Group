<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class detalleNomina extends Model
{
    use HasFactory;
    protected $table = 'detalle_nomina';
    protected $fillable = [
        'nomina_id',
        'contrato_id',
        'sueldoBruto',
        'comisionHg',
        'deduccionInces',
        'deduccionIvss',
        'salarioNeto',
    ];
}
