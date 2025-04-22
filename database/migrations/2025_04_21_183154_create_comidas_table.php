<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comidas', function (Blueprint $table) {
            $table->id('id_comida');
            $table->unsignedBigInteger('id_dieta');
            $table->enum('tipo_comida', ['desayuno', 'almuerzo', 'comida', 'merienda', 'cena', 'postentreno', 'preentreno']);
            $table->text('descripcion')->nullable();
            $table->integer('calorias');
            $table->json('macros');
            $table->timestamps();

            // Clave foránea de dietas
            $table->foreign('id_dieta')
                ->references('id_dieta')
                ->on('dietas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comidas');
    }
};
