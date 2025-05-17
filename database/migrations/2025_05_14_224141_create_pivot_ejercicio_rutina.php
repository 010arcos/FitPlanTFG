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
        Schema::create('pivot_ejercicio_rutina', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ejercicio');
            $table->unsignedBigInteger('id_rutina');
            $table->integer('repeticiones')->nullable();
            $table->integer('series')->nullable();
            $table->timestamps();


            $table->foreign('id_ejercicio')->references('id_ejercicio')->on('ejercicios')->onDelete('cascade');
            $table->foreign('id_rutina')->references('id_rutina')->on('rutinas')->onDelete('cascade');
            $table->unique(['id_ejercicio', 'id_rutina']);
            $table->softDeletes();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_ejercicio_rutina');
    }
};
