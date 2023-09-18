<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->increments('idequipo');
            $table->unsignedInteger('idprovision');
            $table->string('descripcion_equipo', 100);
            $table->string('mac', 20);
            $table->text('descripcion_accesorios');
            $table->timestamps();

            $table->foreign('idprovision')->references('idprovision')->on('provisionescontratos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipos');
    }
}
