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
        //Admin
        usuario::create([
            'correo' => 'Admin@demo.com',
            'password' => Hash::make('admin333'),
            'tipo' => 'admin',
            'fechaRegistro' => now(),
        ]);

        //Hiring_Group
        usuario::create([
            'correo' => 'Hiring@demo.com',
            'password' => Hash::make('hiring123'),
            'tipo' => 'hiringGroup',
            'fechaRegistro' => now(),
        ]);

        /*  //Candidatos
        usuario::create([
            'correo' => 'Candidato1@demo.com',
            'password' => Hash::make('candidato123'),
            'tipo' => 'candidato',
            'fechaRegistro' => now(),
        ]);
        usuario::create([
            'correo' => 'Candidato2@demo.com',
            'password' => Hash::make('candidato123'),
            'tipo' => 'candidato',
            'fechaRegistro' => now(),
        ]);

        usuario::create([
            'correo' => 'Candidato3@demo.com',
            'password' => Hash::make('candidato123'),
            'tipo' => 'candidato',
            'fechaRegistro' => now(),
        ]);
        usuario::create([
            'correo' => 'Candidato4@demo.com',
            'password' => Hash::make('candidato123'),
            'tipo' => 'candidato',
            'fechaRegistro' => now(),
        ]);
        usuario::create([
            'correo' => 'Candidato5@demo.com',
            'password' => Hash::make('candidato123'),
            'tipo' => 'candidato',
            'fechaRegistro' => now(),
        ]);

        //Contratados
        usuario::create([
            'correo' => 'Contratado@demo1.com',
            'password' => Hash::make('contratado123'),
            'tipo' => 'contratado',
            'fechaRegistro' => now(),
        ]);
        usuario::create([
            'correo' => 'Contratado2@demo.com',
            'password' => Hash::make('contratado123'),
            'tipo' => 'contratado',
            'fechaRegistro' => now(),
        ]);
        usuario::create([
            'correo' => 'Contratado3@demo.com',
            'password' => Hash::make('contratado123'),
            'tipo' => 'contratado',
            'fechaRegistro' => now(),
        ]);
        usuario::create([
            'correo' => 'Contratado4@demo.com',
            'password' => Hash::make('contratado123'),
            'tipo' => 'contratado',
            'fechaRegistro' => now(),
        ]);
        usuario::create([
            'correo' => 'Contratado5@demo.com',
            'password' => Hash::make('contratado123'),
            'tipo' => 'contratado',
            'fechaRegistro' => now(),
        ]);

        //Empresas
        usuario::create([
            'correo' => 'Empresa1@demo.com',
            'password' => Hash::make('empresa123'),
            'tipo' => 'empresa',
            'fechaRegistro' => now(),
        ]);
        usuario::create([
            'correo' => 'Empresa2@demo.com',
            'password' => Hash::make('empresa123'),
            'tipo' => 'empresa',
            'fechaRegistro' => now(),
        ]);
        usuario::create([
            'correo' => 'Empresa3@demo.com',
            'password' => Hash::make('empresa123'),
            'tipo' => 'empresa',
            'fechaRegistro' => now(),
        ]);
        usuario::create([
            'correo' => 'Empresa4@demo.com',
            'password' => Hash::make('empresa123'),
            'tipo' => 'empresa',
            'fechaRegistro' => now(),
        ]);
        usuario::create([
            'correo' => 'Empresa5@demo.com',
            'password' => Hash::make('empresa123'),
            'tipo' => 'empresa',
            'fechaRegistro' => now(),
        ]); */
    }
}
