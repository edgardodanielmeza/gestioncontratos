<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministradoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administradores')->insert([
            'idadministrador' => 1,
            'nombres' => 'adminstrador1',
            'dependencia' => 'gerencia tecnica',
            'contacto' => '09961111111',
            'correo' => 'asadsa@f.com',
            'carnet' => '1213123',
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
