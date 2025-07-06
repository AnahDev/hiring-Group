<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class nomina extends Model
{
    use HasFactory;
    protected $table = 'nomina';
    protected $fillable = [
        'empresa_id',
        'mes',
        'año',
        'fechaGeneracion',
    ];

    protected $casts = [
        'fechaGeneracion' => 'datetime',
    ];

    // Relacion uno a muchos

    public function detalleNomina(): HasMany
    {
        return $this->hasMany(detalleNomina::class, 'nomina_id');
    }

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(empresa::class, 'empresa_id');
    }


    // --- ACCESORES PARA CALCULAR TOTALES DINÁMICAMENTE ---

    // Accesor para el total bruto pagado
    public function getTotalBrutoPagadoAttribute(): float
    {
        // Asegúrate de cargar la relación detalleNomina para evitar el problema N+1
        // Si ya sabes que vas a necesitar los detalles, haz un eager load: Nomina::with('detalleNomina')->find(...)
        return $this->detalleNomina->sum('sueldoBruto');
    }

    // Accesor para el total neto pagado
    public function getTotalNetoPagadoAttribute(): float
    {
        return $this->detalleNomina->sum('salarioNeto');
    }

    // Accesor para el total de la comisión de Hiring Group
    public function getTotalComisionHgAttribute(): float
    {
        return $this->detalleNomina->sum('comisionHg');
    }

    // Si quieres que estos campos aparezcan automáticamente cuando serialices el modelo (ej. a JSON)
    protected $appends = ['total_bruto_pagado', 'total_neto_pagado', 'total_comision_hg'];
}
