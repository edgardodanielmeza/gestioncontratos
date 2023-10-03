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
            $table->date('fecha');
            $table->integer('duracion_garantia');
            $table->timestamps();
            $table->foreign('idcontrato')->references('idcontrato')->on('contratoitems')->onDelete('cascade');
            $table->foreign('iditem')->references('iditem')->on('contratoitems')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('provisionescontratos');
    }
}


