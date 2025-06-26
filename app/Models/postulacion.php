<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class postulacion extends Model
{
    use HasFactory;

    protected $table = 'postulacion';

    protected $fillable = [
        'postulacion_id',
        'candidato_id',
        'oferta_laboral_id',
        'fechaPostulacion',
    ];

    // Relaciones
    public function contrato(): BelongsTo
    {
        return $this->belongsTo(contrato::class, 'contrato_id');
    }

    public function candidato(): BelongsTo
    {
        return $this->belongsTo(candidato::class, 'candidato_id');
    }

    public function ofertaLaboral(): BelongsTo
    {
        return $this->belongsTo(ofertaLaboral::class, 'oferta_laboral_id');
    }
}
