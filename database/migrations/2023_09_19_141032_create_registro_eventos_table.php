<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroEventosTable extends Migration
{
    public function up()
    {
        Schema::create('registroeventos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idcontrato');
            $table->string('evento', 100);
            $table->text('descripcion');
            $table->timestamp('fecha')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();

            $table->foreign('idcontrato')->references('idcontrato')->on('contratos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('registroeventos');
    }
}

