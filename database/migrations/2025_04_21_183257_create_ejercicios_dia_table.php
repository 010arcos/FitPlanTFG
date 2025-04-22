<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ejercicios_dia', function (Blueprint $table) {
            $table->id('id_ejercicio_dia');
            $table->unsignedBigInteger('id_rutina');
            $table->unsignedBigInteger('id_ejercicio');
            $table->enum('dia_semana', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']);
            $table->integer('repeticiones');
            $table->integer('series');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('id_rutina')
                ->references('id_rutina')
                ->on('rutinas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_ejercicio')
                ->references('id_ejercicio')
                ->on('ejercicios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ejercicios_dia');
    }
};
