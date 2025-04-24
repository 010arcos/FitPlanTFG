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
        Schema::create('pivot_usuario_dieta', function (Blueprint $table) {
            // Usamos 'id' ya que la tabla 'users' tiene como clave primaria 'id'.
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_dieta');

            
            // Definir la clave primaria compuesta por 'id_usuario' y 'id_dieta'.
            $table->primary(['id_usuario', 'id_dieta']);
            
            // Definir la relación con la tabla 'users', usando 'id' como clave foránea.
            $table->foreign('id_usuario')
                ->references('id')
                ->on('users') // Ahora referenciamos 'users' y no 'usuarios'.
                ->onDelete('cascade'); // Si un usuario es eliminado, se eliminan las asignaciones correspondientes.

            // Definir la relación con la tabla 'dietas'.
            $table->foreign('id_dieta')
                ->references('id_dieta')
                ->on('dietas') // Relación con la tabla 'dietas'.
                ->onDelete('cascade'); // Si una dieta es eliminada, se eliminan las asignaciones correspondientes.


                 // Crear las columnas 'created_at' y 'updated_at'
            $table->timestamps(); 
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_usuario_dieta');
    }
};
