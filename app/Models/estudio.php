<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class estudio extends Model
{
    use HasFactory;
    protected $table = 'estudios';

    protected $fillable = [
        'candidato_id',
        'nombreUni',
        'carrera',
        'fechaEgreso',
    ];

    // Relaciones
    public function candidato(): BelongsTo
    {
        return $this->belongsTo(candidato::class, 'candidato_id');
    }
}
