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
    protected $table = 'detalleNomina';
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


    // --- ACCESORES PARA CALCULAR TOTALES DINÁMICAMENTE ---
    public function getSueldoBrutoAttribute(): float
    {
        return (float) ($this->attributes['sueldoBruto'] ?? 0);
    }

    public function getComisionHgAttribute(): float
    {
        return (float) ($this->attributes['comisionHg'] ?? 0);
    }

    public function getDeduccionIncesAttribute(): float
    {
        return (float) ($this->attributes['deduccionInces'] ?? 0);
    }

    public function getDeduccionIvssAttribute(): float
    {
        return (float) ($this->attributes['deduccionIvss'] ?? 0);
    }

    public function getSalarioNetoAttribute(): float
    {
        return (float) ($this->attributes['salarioNeto'] ?? 0);
    }
}
