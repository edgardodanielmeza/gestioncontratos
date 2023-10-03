<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoContratosTable extends Migration
{
    public function up()
    {
        Schema::create('tipocontratos', function (Blueprint $table) {
            $table->increments('idtipocontrato');
            $table->string('descripcion', 50);
            $table->string('duracion', 50);
            $table->integer('valorduracion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipocontratos');
    }
}
