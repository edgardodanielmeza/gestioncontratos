<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratoItemTable extends Migration
{
    public function up()
    {
        Schema::create('contratoitem', function (Blueprint $table) {
            $table->unsignedInteger('idcontrato');
            $table->unsignedInteger('iditem');
            $table->primary(['idcontrato', 'iditem']);
            $table->timestamps();

            $table->foreign('idcontrato')->references('idcontrato')->on('contratos');
            $table->foreign('iditem')->references('iditem')->on('items');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contratoitem');
    }
}
