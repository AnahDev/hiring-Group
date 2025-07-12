<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    //Opciones validas en el campo enum de Duracion, no se consulta la BD
    public static function getDuracionOptions(): array
    {
        return [
            '1 Mes',
            '3 Meses',
            '6 Meses',
            '1 Año',
            'Indefinido',
        ];
    }
    //Relaciones uno a muchos
    public function banco(): BelongsTo
    {
        return $this->belongsTo(banco::class, 'banco_id');
    }

    public function postulacion(): BelongsTo
    {
        return $this->belongsTo(postulacion::class, 'postulacion_id');
    }

    public function detalleNomina(): HasMany
    {
        return $this->hasMany(detalleNomina::class, 'contrato_id');
    }
}
