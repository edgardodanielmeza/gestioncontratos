<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
    class FiscalSeeder extends Seeder
    {
        public function run()
        {
            DB::table('fiscales')->insert([
                [
                    'idfiscal' => 1,
                    'nombresyapellido' => 'Edgardo Daniel Meza',
                    'carnet' => '10170',
                    'contacto' => '0961331213',
                    'correo' => 'emeza@copaco.com.py',
                    'created_at' => '2023-09-19 14:13:10',
                    'updated_at' => '2023-09-19 14:13:10',
                ],
                [
                    'idfiscal' => 2,
                    'nombresyapellido' => 'Fiscal 2',
                    'carnet' => '789012',
                    'contacto' => 'contacto2@example.com',
                    'correo' => 'fiscal2@example.com',
                    'created_at' => '2023-09-19 14:13:10',
                    'updated_at' => '2023-09-19 14:13:10',
                ],
                [
                    'idfiscal' => 3,
                    'nombresyapellido' => 'Fiscal 3',
                    'carnet' => '345678',
                    'contacto' => 'contacto3@example.com',
                    'correo' => 'fiscal3@example.com',
                    'created_at' => '2023-09-19 14:13:10',
                    'updated_at' => '2023-09-19 14:13:10',
                ],
            ]);
        }
    }

