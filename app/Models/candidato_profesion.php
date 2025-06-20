<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidato_profesion extends Model
{
    use HasFactory;
    protected $table = 'candidato_profesion';
    protected $fillable = [
        'candidato_id',
        'profesion_id',
    ];

    // Relacion uno a muchos
    public function candidato()
    {
        return $this->belongsTo(candidato::class, 'candidato_id');
    }
    public function profesion()
    {
        return $this->belongsTo(profesion::class, 'profesion_id');
    }
}
