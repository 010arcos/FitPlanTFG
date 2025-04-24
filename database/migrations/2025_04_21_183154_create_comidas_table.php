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
            $table->string('nombre');
            $table->json('alimentos')->nullable();
            $table->integer('calorias');
            $table->json('macros');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('comidas');
    }
};
