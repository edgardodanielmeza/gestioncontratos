<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratoFiscalesTable extends Migration
{
    public function up()
    {
        Schema::create('contratofiscales', function (Blueprint $table) {
            $table->unsignedInteger('idcontrato');
            $table->unsignedInteger('idfiscal');
            $table->timestamps();

            $table->primary(['idcontrato', 'idfiscal']);
            $table->foreign('idcontrato')->references('idcontrato')->on('contratos')->onDelete('cascade');
            $table->foreign('idfiscal')->references('idfiscal')->on('fiscales')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contratofiscales');
    }
}
