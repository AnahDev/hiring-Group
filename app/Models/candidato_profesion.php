<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class candidato_profesion extends Model
{
    use HasFactory;
    protected $table = 'candidato_profesion';
    protected $fillable = [
        'candidato_id',
        'profesion_id',
    ];

    // Relacion uno a muchos
    public function candidato(): BelongsTo
    {
        return $this->belongsTo(candidato::class, 'candidato_id');
    }
    public function profesion(): BelongsTo
    {
        return $this->belongsTo(profesion::class, 'profesion_id');
    }
}
