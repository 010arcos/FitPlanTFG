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
        Schema::create('historial_pesos', function (Blueprint $table) {
            $table->id('id_historial');
            $table->unsignedBigInteger('id_usuario');
            $table->float('peso', 5, 2);
            $table->float('altura', 3, 2)->nullable();
            $table->float('imc', 5, 2)->nullable();
            $table->date('fecha_registro')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('id_usuario')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');


             $table->index(['id_usuario', 'fecha_registro']); // indice para optimizar las consultas
             $table->unique(['id_usuario', 'fecha_registro']); // evita duplicados
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_pesos');
    }
};
