<?php

namespace Database\Seeders;

use App\Models\empresa;
use App\Models\ofertaLaboral;
use App\Models\profesion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfertaLaboralSeeder extends Seeder
{

    public function run(): void
    {
        //IDs empresas
        $empresaOferta1 = empresa::where('id', '1')->first();

        //IDs profesiones
        $profesionOferta1 = profesion::where('id', '1')->first();
        $profesionOferta2 = profesion::where('id', '2')->first();
        $profesionOferta3 = profesion::where('id', '3')->first();
        $profesionOferta4 = profesion::where('id', '4')->first();
        $profesionOferta5 = profesion::where('id', '5')->first();

        if ($empresaOferta1 && $profesionOferta1) {
            ofertaLaboral::create([
                'empresa_id' => $empresaOferta1->id,
                'profesion_id' => $profesionOferta1->id,
                'cargo' => 'Analista de datos',
                'descripcion' => 'Hace cosas',
                'salario' => '20.2',
                'estado' => 'inactiva',
                'fechaCreacion' => now(),
                'ubicacion' => 'Los raudales',
            ]);
            ofertaLaboral::create([
                'empresa_id' => $empresaOferta1->id,
                'profesion_id' => $profesionOferta2->id,
                'cargo' => 'Analista de compras',
                'descripcion' => 'Hace cosas',
                'salario' => '20.2',
                'estado' => 'activa',
                'fechaCreacion' => now(),
                'ubicacion' => 'Los pueblos',
            ]);
            ofertaLaboral::create([
                'empresa_id' => $empresaOferta1->id,
                'profesion_id' => $profesionOferta3->id,
                'cargo' => 'Analista de ventas',
                'descripcion' => 'Hace cosas ',
                'salario' => '20.2',
                'estado' => 'inactiva',
                'fechaCreacion' => now(),
                'ubicacion' => 'San felix',
            ]);

            ofertaLaboral::create([
                'empresa_id' => $empresaOferta1->id,
                'profesion_id' => $profesionOferta4->id,
                'cargo' => 'Analista de datos',
                'descripcion' => 'Hace cosas de analita de datos',
                'salario' => '20.2',
                'estado' => 'activa',
                'fechaCreacion' => now(),
                'ubicacion' => 'Puerto Ordaz',
            ]);
            ofertaLaboral::create([
                'empresa_id' => $empresaOferta1->id,
                'profesion_id' => $profesionOferta5->id,
                'cargo' => 'Supervisor',
                'descripcion' => 'Supervisa obviamente',
                'salario' => '0.2',
                'estado' => 'activa',
                'fechaCreacion' => now(),
                'ubicacion' => 'En su casa',
            ]);
        }
    }
}
