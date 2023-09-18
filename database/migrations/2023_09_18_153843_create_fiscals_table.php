<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiscalsTable extends Migration
{
    public function up()
    {
        Schema::create('fiscales', function (Blueprint $table) {
            $table->increments('idfiscal');
            $table->string('nombresyapellido', 100);
            $table->string('carnet', 20);
            $table->string('contacto', 50);
            $table->string('correo', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fiscales');
    }
}
