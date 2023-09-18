<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvisionesContratosTable extends Migration
{
    public function up()
    {
        Schema::create('provisionescontratos', function (Blueprint $table) {
            $table->increments('idprovision');
            $table->unsignedInteger('idcontrato');
            $table->unsignedInteger('iditem');
            $table->decimal('cantidad_provision', 10, 2);
            $table->date('fecha_provision');
            $table->integer('duracion_garantia');
            $table->timestamps();

            $table->foreign('idcontrato')->references('idcontrato')->on('contratos');
            $table->foreign('iditem')->references('iditem')->on('items');
        });
    }

    public function down()
    {
        Schema::dropIfExists('provisionescontratos');
    }
}
