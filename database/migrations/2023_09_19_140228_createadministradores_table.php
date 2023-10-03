<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministradoresTable extends Migration
{
    public function up()
    {
        Schema::create('administradores', function (Blueprint $table) {
            $table->increments('idadministrador');
            $table->string('nombres', 100);
            $table->string('dependencia', 100);
            $table->string('contacto', 50);
            $table->string('correo', 100);
            $table->string('carnet', 20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('administradores');
    }
}
