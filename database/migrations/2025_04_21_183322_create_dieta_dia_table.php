<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dieta_dia', function (Blueprint $table) {
            $table->id('id_dieta_dia');
            $table->unsignedBigInteger('id_dieta');
            $table->enum('dia_semana', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']);
            $table->timestamps();

            // Clave foránea
            $table->foreign('id_dieta')
                ->references('id_dieta')
                ->on('dietas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dieta_dia');
    }
};
