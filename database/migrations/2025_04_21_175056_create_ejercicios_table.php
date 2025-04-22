<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ejercicios', function (Blueprint $table) {
            $table->id('id_ejercicio');
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->enum('zona', ['pecho', 'pierna', 'brazos', 'espalda', 'gluteos', 'hombros', 'abdomen']);
            $table->enum('tipo', ['fuerza', 'cardio', 'resistencia']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ejercicios');
    }
};
