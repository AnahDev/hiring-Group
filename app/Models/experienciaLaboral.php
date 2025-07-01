<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class experienciaLaboral extends Model
{
    use HasFactory;
    protected $table = 'experienciaLaboral';
    protected $fillable = [
        'candidato_id',
        'empresa',
        'cargo',
        'fechaInicio',
        'fechaFin',
    ];

    // Relacion uno a muchos
    public function candidato(): BelongsTo
    {
        return $this->belongsTo(candidato::class, 'candidato_id');
    }
}
