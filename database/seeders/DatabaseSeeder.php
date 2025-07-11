<?php

namespace Database\Seeders;


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

        /* //Seeders relacionadas a Candidatos
        $this->call(CandidatoSeeder::class);
        $this->call(ExperienciaLaboralSeeder::class);
        $this->call(TelefonoSeeder::class);
        $this->call(EstudioSeeder::class);

        //Seeders relacionadas a empresas
        $this->call(EmpresaSeeder::class);
        $this->call(ContactoEmpresaSeeder::class);
        $this->call(SectorEmpresaSeeder::class);

        //Hacer las que faltan
        $this->call(ProfesionSeeder::class);
        $this->call(BancoSeeder::class);
        $this->call(OfertaLaboralSeeder::class);
        $this->call(PostulacionSeeder::class);
        $this->call(ContratoSeeder::class);
        $this->call(NominaSeeder::class); */
    }
}
