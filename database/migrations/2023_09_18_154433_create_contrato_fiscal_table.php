<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratoFiscalTable extends Migration
{
    public function up()
    {
        Schema::create('contratofiscal', function (Blueprint $table) {
            $table->unsignedInteger('idcontrato');
            $table->unsignedInteger('idfiscal');
            $table->primary(['idcontrato', 'idfiscal']);
            $table->timestamps();

            $table->foreign('idcontrato')->references('idcontrato')->on('contratos');
            $table->foreign('idfiscal')->references('idfiscal')->on('fiscales');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contratofiscal');
    }
}
