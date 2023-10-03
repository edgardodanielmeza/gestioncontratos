<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateequiposTable extends Migration
{
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->increments('idequipo');
            $table->unsignedInteger('idprovision');
            $table->date('fecha_provision');
            $table->string('serial', 60);
            $table->string('mac', 60);
            $table->timestamps();
            $table->foreign('idprovision')->references('idprovision')->on('provisionescontratos')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('provisionescontratos');
    }
}

