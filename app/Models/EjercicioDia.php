<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EjercicioDia extends Model
{
    use SoftDeletes; 
    protected $table = 'ejercicios_dia';

    protected $primaryKey = 'id_ejercicio_dia';

    protected $fillable = [
        'id_rutina',
        'id_ejercicio',
        'dia_semana',
        'repeticiones',
        'series',
    ];

    // Relación muchos a uno con Rutina
    public function rutina()
    {
        return $this->belongsTo(Rutina::class, 'id_rutina', 'id_rutina');
    }

    // Relación muchos a uno con Ejercicio
    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class, 'id_ejercicio', 'id_ejercicio');
    }
}
