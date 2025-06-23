<?php

namespace Database\Seeders;

use App\Models\contactoEmpresa;
use App\Models\empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactoEmpresaSeeder extends Seeder
{

    public function run(): void
    {
        $contactoEmpresa1 = empresa::where('nombre', 'Empresa Generica 1')->first();
        $contactoEmpresa2 = empresa::where('nombre', 'Empresa Generica 2')->first();
        $contactoEmpresa3 = empresa::where('nombre', 'Empresa Generica 3')->first();
        $contactoEmpresa4 = empresa::where('nombre', 'Empresa Generica 4')->first();
        $contactoEmpresa5 = empresa::where('nombre', 'Empresa Generica 5')->first();

        if ($contactoEmpresa1) {
            contactoEmpresa::create([
                'empresa_id' => $contactoEmpresa1->id,
                'personaContacto' => 'Carlos Garcia',
                'tlfContacto' => '0424-555-55-55'
            ]);
            contactoEmpresa::create([
                'empresa_id' => $contactoEmpresa1->id,
                'personaContacto' => 'Ana Santamaria',
                'tlfContacto' => '0424-444-55-55'
            ]);
        }

        if ($contactoEmpresa2) {
            contactoEmpresa::create([
                'empresa_id' => $contactoEmpresa2->id,
                'personaContacto' => 'Fernado Fernandez',
                'tlfContacto' => '0426-185-55-45'
            ]);
        }

        if ($contactoEmpresa3) {
            contactoEmpresa::create([
                'empresa_id' => $contactoEmpresa3->id,
                'personaContacto' => 'Elio Salazar',
                'tlfContacto' => '0412-158-33-45'
            ]);
        }
        if ($contactoEmpresa4) {
            contactoEmpresa::create([
                'empresa_id' => $contactoEmpresa4->id,
                'personaContacto' => 'Marío Gaeza',
                'tlfContacto' => '0414-123-45-65'
            ]);
        }
        if ($contactoEmpresa5) {
            contactoEmpresa::create([
                'empresa_id' => $contactoEmpresa5->id,
                'personaContacto' => 'Fernan Floo ',
                'tlfContacto' => '0412-789-55-60'
            ]);
            contactoEmpresa::create([
                'empresa_id' => $contactoEmpresa5->id,
                'personaContacto' => 'Fernan Floo 2',
                'tlfContacto' => '0412-789-55-61'
            ]);
        }
    }
}
