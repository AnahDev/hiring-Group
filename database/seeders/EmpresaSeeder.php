<?php

namespace Database\Seeders;

use App\Models\empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{


    public function run(): void
    {
        $empresa = new empresa();

        $empresa->usuario_id = 1;
        $empresa->nombre = 'CVG';
        $empresa->email = 'empresaCVG@gmail.com';
        $empresa->save();
    }
}
