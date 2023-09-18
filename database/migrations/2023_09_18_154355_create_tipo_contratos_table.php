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
            $table->unsignedInteger('duracion_contrato');
            $table->unsignedInteger('tiempo_provision');
            $table->decimal('cantidad_minima', 10, 2);
            $table->decimal('cantidad_maxima', 10, 2);
            $table->string('descripcion', 50);
            $table->timestamps();

            $table->foreign('duracion_contrato')->references('idduracion')->on('duraciones');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipocontratos');
    }
}
