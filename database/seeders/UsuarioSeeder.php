<?php

namespace Database\Seeders;

use App\Models\usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        usuario::create([
            'correo' => 'Admin@demo.com',
            'password' => Hash::make('admin333'),
            'tipo' => 'admin',
            'fechaRegistro' => "2025/01/11",
        ]);

        usuario::create([
            'correo' => 'Candidato@demo.com',
            'password' => Hash::make('candidato123'),
            'tipo' => 'candidato',
            'fechaRegistro' => "2025/01/11",
        ]);

        usuario::create([
            'correo' => 'Hiring@demo.com',
            'password' => Hash::make('hiring123'),
            'tipo' => 'hiringGroup',
            'fechaRegistro' => "2025/01/11",
        ]);

        usuario::create([
            'correo' => 'Contratado@demo.com',
            'password' => Hash::make('contratado123'),
            'tipo' => 'contratado',
            'fechaRegistro' => "2025/01/11",
        ]);

        usuario::create([
            'correo' => 'Empresa@demo.com',
            'password' => Hash::make('empresa123'),
            'tipo' => 'empresa',
            'fechaRegistro' => "2025/01/11",
        ]);
    }
}
