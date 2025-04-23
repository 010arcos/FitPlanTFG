<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dietas', function (Blueprint $table) {
            $table->id('id_dieta');
            // $table->unsignedBigInteger('id_usuario');
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->timestamps();

            // // Definir la clave foránea manualmente para Laravel
            // $table->foreign('id_usuario')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('cascade')
            //     ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dietas');
    }
};
