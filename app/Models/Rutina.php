<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rutina extends Model
{
    use SoftDeletes; 
    protected $table = 'rutinas';

    protected $primaryKey = 'id_rutina';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'pivot_usuario_rutina', 'id_rutina', 'id_usuario')
            ->withPivot('fecha_inicio', 'fecha_fin')
            ->withTimestamps();
    }

    // Relación muchos a muchos con Ejercicios
    public function ejercicios()
    {
        return $this->belongsToMany(Ejercicio::class, 'pivot_ejercicio_rutina', 'id_rutina', 'id_ejercicio')
            ->withPivot('dia', 'repeticiones', 'series')
            ->withTimestamps();
    }
}
