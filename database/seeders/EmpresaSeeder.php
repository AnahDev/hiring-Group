<?php

namespace Database\Seeders;

use App\Models\empresa;
use App\Models\usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{


    public function run(): void
    {
        $usuarioEmpresa1 = usuario::where('correo', 'Empresa1@demo.com')->first();
        $usuarioEmpresa2 = usuario::where('correo', 'Empresa2@demo.com')->first();
        $usuarioEmpresa3 = usuario::where('correo', 'Empresa3@demo.com')->first();
        $usuarioEmpresa4 = usuario::where('correo', 'Empresa4@demo.com')->first();
        $usuarioEmpresa5 = usuario::where('correo', 'Empresa5@demo.com')->first();

        if ($usuarioEmpresa1) {
            empresa::create([
                'usuario_id' => $usuarioEmpresa1->id,
                'nombre' => 'Empresa Generica 1',
                'email' => 'correoCreadoEmpresa1@demo.com',
            ]);
        }
        if ($usuarioEmpresa2) {
            empresa::create([
                'usuario_id' => $usuarioEmpresa2->id,
                'nombre' => 'Empresa Generica 2',
                'email' => 'correoCreadoEmpresa2@demo.com',
            ]);
        }
        if ($usuarioEmpresa3) {
            empresa::create([
                'usuario_id' => $usuarioEmpresa3->id,
                'nombre' => 'Empresa Generica 3',
                'email' => 'correoCreadoEmpresa3@demo.com',
            ]);
        }
        if ($usuarioEmpresa4) {
            empresa::create([
                'usuario_id' => $usuarioEmpresa4->id,
                'nombre' => 'Empresa Generica 4',
                'email' => 'correoCreadoEmpresa4@demo.com',
            ]);
        }
        if ($usuarioEmpresa5) {
            empresa::create([
                'usuario_id' => $usuarioEmpresa5->id,
                'nombre' => 'Empresa Generica 5',
                'email' => 'correoCreadoEmpresa5@demo.com',
            ]);
        }
    }
}
