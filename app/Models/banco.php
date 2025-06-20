<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class banco extends Model
{
    use HasFactory;
    protected $table = 'banco';
    protected $fillable = [
        'nombreBanco',
    ];

    // Relaciones
    public function contrato(): HasMany
    {
        return $this->hasMany(contrato::class, 'banco_id');
    }
}
