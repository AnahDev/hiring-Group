<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidato_profesion extends Model
{
    use HasFactory;
    protected $table = 'candidato_profesion';
    protected $fillable = [
        'candidato_profesion_id',
        'candidato_id',
        'profesion_id',
    ];
}
