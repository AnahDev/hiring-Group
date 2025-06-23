<?php

namespace Database\Seeders;

use App\Models\empresa;
use App\Models\usuario;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(UsuarioSeeder::class);
        $this->call(EmpresaSeeder::class);
    }
}
