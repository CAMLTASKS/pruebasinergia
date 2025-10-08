<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('municipios')->insert([
            ['nombre' => 'Medellín', 'departamento_id' => 1],
            ['nombre' => 'Bello', 'departamento_id' => 1],
            ['nombre' => 'Bogotá', 'departamento_id' => 2],
            ['nombre' => 'Soacha', 'departamento_id' => 2],
            ['nombre' => 'Cali', 'departamento_id' => 3],
            ['nombre' => 'Palmira', 'departamento_id' => 3],
            ['nombre' => 'Cartagena', 'departamento_id' => 4],
            ['nombre' => 'Magangué', 'departamento_id' => 4],
            ['nombre' => 'Bucaramanga', 'departamento_id' => 5],
            ['nombre' => 'Floridablanca', 'departamento_id' => 5],
        ]);
    }
}
