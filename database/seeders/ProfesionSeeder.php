<?php

namespace Database\Seeders;

use App\Models\profesion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfesionSeeder extends Seeder
{

    public function run(): void
    {
        profesion::create([
            'id' => '1',
            'descripcion' => 'Desarrollador web',
        ]);
        profesion::create([
            'id' => '2',
            'descripcion' => 'Analista de datos',
        ]);
        profesion::create([
            'id' => '3',
            'descripcion' => 'Administrador/a',
        ]);
        profesion::create([
            'id' => '4',
            'descripcion' => 'Contador/a',
        ]);
        profesion::create([
            'id' => '5',
            'descripcion' => 'Programador',
        ]);
        profesion::create([
            'id' => '6',
            'descripcion' => 'DevOps',
        ]);
    }
}
