<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profesion extends Model
{
    use HasFactory;
    protected $table = 'profesion';
    protected $fillable = [
        'profesion_id',
        'descripcion',
    ];
}
