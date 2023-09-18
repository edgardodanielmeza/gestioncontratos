<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('idcontrato');
            $table->string('descripcion', 100);
            $table->string('alias', 50);
            $table->unsignedInteger('idtipocontrato');
            $table->unsignedInteger('idfiscal');
            $table->date('fechafirma');
            $table->unsignedInteger('idcontratista');
            $table->integer('anho');
            $table->unsignedInteger('idContrataciones');
            $table->unsignedInteger('idmonto');
            $table->date('fechainicio');
            $table->date('fecha_ARTP');
            $table->date('fecha_ARTD');
            $table->timestamps();

            $table->foreign('idtipocontrato')->references('idtipocontrato')->on('tipocontratos');
            $table->foreign('idfiscal')->references('idfiscal')->on('fiscales');
            $table->foreign('idcontratista')->references('idcontratista')->on('contratistas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
