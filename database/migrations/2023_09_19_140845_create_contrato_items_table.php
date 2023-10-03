<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratoItemsTable extends Migration
{
    public function up()
    {
        Schema::create('contratoitems', function (Blueprint $table) {
            $table->unsignedInteger('idcontrato');
            $table->unsignedInteger('iditem');
            $table->decimal('cantidad_minima', 10, 2);
            $table->decimal('cantidad_maxima', 10, 2);
            $table->string('descripcion', 100);
            $table->unsignedIntege('precio');
            $table->integer('tiempoentrega')->nullable();
            $table->enum('unidad_entrega', ['Dias', 'Meses'])->nullable();
            $table->timestamps();
            $table->primary(['idcontrato', 'iditem']);
            $table->foreign('idcontrato')->references('idcontrato')->on('contratos')->onDelete('cascade');
            $table->foreign('iditem')->references('iditem')->on('items')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contratoitems');
    }
}
