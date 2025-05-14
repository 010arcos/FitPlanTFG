<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rutinas', function (Blueprint $table) {
            $table->id('id_rutina');
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->timestamps();
            $table->softDeletes(); 


        });
    }

    public function down()
    {
        Schema::dropIfExists('rutinas');
    }
};
