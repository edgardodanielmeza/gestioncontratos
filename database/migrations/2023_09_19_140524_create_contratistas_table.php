<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateContratistasTable extends Migration
{
    public function up()
    {
        Schema::create('contratistas', function (Blueprint $table) {
            $table->increments('idcontratista');
            $table->string('descripcion', 100);
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('contacto', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contratistas');
    }
}
