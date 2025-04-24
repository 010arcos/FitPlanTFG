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
        Schema::create('pivot_dieta_comida', function (Blueprint $table) {
            $table->unsignedBigInteger('id_dieta');
            $table->unsignedBigInteger('id_comida');
            $table->enum('tipo_comida', ['desayuno', 'almuerzo', 'comida', 'merienda', 'cena', 'postentreno', 'preentreno']);
            $table->primary(['id_dieta', 'id_comida']);
            $table->timestamps();


             // Definición de las claves foráneas
             $table->foreign('id_dieta')->references('id_dieta')->on('dietas')->onDelete('cascade');
             $table->foreign('id_comida')->references('id_comida')->on('comidas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_dieta_comida');
    }
};
