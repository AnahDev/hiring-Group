<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class nomina extends Model
{
    use HasFactory;
    protected $table = 'nomina';
    protected $fillable = [
        'empresa_id',
        'mes;',
        'año',
        'fechaGeneracion',
    ];

    // Relacion uno a muchos
    public function empresa(): BelongsTo
    {
        return $this->belongsTo(empresa::class, 'empresa_id');
    }
}
