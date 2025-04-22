<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    protected $table = 'rutinas';

    protected $primaryKey = 'id_rutina';

    protected $fillable = [
        'id_usuario',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
    ];

    // Relación muchos a uno con Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    // Relación uno a muchos con ejercicios_dia
    public function ejerciciosDia()
    {
        return $this->hasMany(EjercicioDia::class, 'id_rutina', 'id_rutina');
    }
}
