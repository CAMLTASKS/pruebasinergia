<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacienteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('paciente')->insert([
            [
                'tipo_documento_id' => 1,
                'numero_documento'  => 100000001,
                'nombre1'           => 'Carlos',
                'nombre2'           => 'Andrés',
                'apellido1'         => 'Maldonado',
                'apellido2'         => 'López',
                'genero_id'         => 1,
                'departamento_id'   => 1,
                'municipio_id'      => 1,
                'correo'            => 'carlos@example.com',
            ],
            [
                'tipo_documento_id' => 2,
                'numero_documento'  => 100000002,
                'nombre1'           => 'Laura',
                'nombre2'           => 'María',
                'apellido1'         => 'García',
                'apellido2'         => 'Pérez',
                'genero_id'         => 2,
                'departamento_id'   => 2,
                'municipio_id'      => 3,
                'correo'            => 'laura@example.com',
            ],
            [
                'tipo_documento_id' => 1,
                'numero_documento'  => 100000003,
                'nombre1'           => 'Miguel',
                'nombre2'           => 'Ángel',
                'apellido1'         => 'Torres',
                'apellido2'         => 'Ramírez',
                'genero_id'         => 1,
                'departamento_id'   => 3,
                'municipio_id'      => 5,
                'correo'            => 'miguel@example.com',
            ],
            [
                'tipo_documento_id' => 1,
                'numero_documento'  => 100000004,
                'nombre1'           => 'Valentina',
                'nombre2'           => 'Sofía',
                'apellido1'         => 'Castro',
                'apellido2'         => 'Gómez',
                'genero_id'         => 2,
                'departamento_id'   => 4,
                'municipio_id'      => 7,
                'correo'            => 'valentina@example.com',
            ],
            [
                'tipo_documento_id' => 2,
                'numero_documento'  => 100000005,
                'nombre1'           => 'Andrés',
                'nombre2'           => 'Felipe',
                'apellido1'         => 'Sánchez',
                'apellido2'         => 'Ortiz',
                'genero_id'         => 1,
                'departamento_id'   => 5,
                'municipio_id'      => 9,
                'correo'            => 'andres@example.com',
            ],
        ]);
    }
}
