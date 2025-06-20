<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class telefono extends Model
{
    use HasFactory;
    protected $table = 'telefono';
    protected $fillable = ['candidato_id', 'numero'];

    // Relaciones
    public function candidato(): BelongsTo
    {
        return $this->belongsTo(candidato::class, 'candidato_id');
    }
}
