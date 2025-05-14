<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ejercicio extends Model
{
    use SoftDeletes; 
    protected $table = 'ejercicios';

    protected $primaryKey = 'id_ejercicio';

    protected $fillable = [
        'nombre',
        'descripcion',
        'zona',
        'tipo',
    ];


    // Relación muchos a muchos con Rutinas
    public function rutinas()
    {
        return $this->belongsToMany(Rutina::class, 'pivot_ejercicio_rutina', 'id_ejercicio', 'id_rutina')
            ->withPivot('dia', 'repeticiones', 'series')
            ->withTimestamps();
    }

    
}
