<?php

namespace Database\Seeders;

use App\Models\banco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BancoSeeder extends Seeder
{
    public function run(): void
    {
        banco::create([
            'id' => '1',
            'nombreBanco' => 'BBVA'
        ]);

        banco::create([
            'id' => '2',
            'nombreBanco' => 'BDV'
        ]);
        banco::create([
            'id' => '3',
            'nombreBanco' => 'BANESCO'
        ]);
        banco::create([
            'id' => '4',
            'nombreBanco' => 'BCN'
        ]);
        banco::create([
            'id' => '5',
            'nombreBanco' => 'BCV'
        ]);
    }
}
