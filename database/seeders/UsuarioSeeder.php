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
        $usuario = new usuario();

        $usuario->correo = 'Administrador';
        $usuario->password = Hash::make('admin333');
        $usuario->tipo = 'admin';
        $usuario->fechaRegistro = "2025/01/11";
        $usuario->save();
    }
}
