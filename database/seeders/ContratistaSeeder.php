<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContratistaSeeder extends Seeder
{
    public function run()
    {
        DB::table('contratistas')->insert([
            [
                'idcontratista' => 1,
                'descripcion' => 'Contratista 1',
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'contacto' => 'contacto1@example.com',
                'created_at' => '2023-09-19 14:13:10',
                'updated_at' => '2023-09-19 14:13:10',
            ],
            [
                'idcontratista' => 2,
                'descripcion' => 'Contratista 2',
                'nombre' => 'María',
                'apellido' => 'Gómez',
                'contacto' => 'contacto2@example.com',
                'created_at' => '2023-09-19 14:13:10',
                'updated_at' => '2023-09-19 14:13:10',
            ],
            [
                'idcontratista' => 3,
                'descripcion' => 'Contratista 3',
                'nombre' => 'Carlos',
                'apellido' => 'López',
                'contacto' => 'contacto3@example.com',
                'created_at' => '2023-09-19 14:13:10',
                'updated_at' => '2023-09-19 14:13:10',
            ],
        ]);
    }
}

