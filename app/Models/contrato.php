<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use              Illuminate\Database\Eloquent\Factories\HasFactory;

class contrato extends Model
{
    use HasFactory;
    protected $table = 'contrato';
    protected $fillable = [
        'postulacion_id',
        'banco_id',
        'fechaInicio',
        'fechaFin',
        'duracion',
        'salarioMensual',
        'tipoSangre',
        'tlfEmergencia',
        'contactoEmergencia',
        'cuentaBanco',

    ];
}
