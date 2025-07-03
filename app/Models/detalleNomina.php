<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class detalleNomina extends Model
{
    /*Tambien se puede ver como recibos_pago pues cada registro 
    representa el pago 
    de un empleado individual para una nómina específica.*/
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

    //relaciones

    public function nomina(): BelongsTo
    {
        return $this->belongsTo(nomina::class, 'nomina_id');
    }

    public function contrato(): BelongsTo
    {
        return $this->belongsTo(contrato::class, 'contrato_id');
    }
}
