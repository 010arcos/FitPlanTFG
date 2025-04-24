<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pivot_dieta_dia', function (Blueprint $table) {
            $table->unsignedBigInteger('id_dieta');
            $table->enum('dia_semana', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']);
            $table->primary(['id_dieta', 'dia_semana']);
            $table->timestamps();
            $table->softDeletes(); 

            $table->foreign('id_dieta')->references('id_dieta')->on('dietas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_dieta_dia');
    }
};
