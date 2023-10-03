<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateDuracionesTable extends Migration
{
    public function up()
    {
        Schema::create('duraciones', function (Blueprint $table) {
            $table->increments('idduracion');
           
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('duraciones');
    }
}
