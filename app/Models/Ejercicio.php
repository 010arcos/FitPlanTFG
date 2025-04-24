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

    // Relación uno a muchos con ejercicios_dia
    public function ejerciciosDia()
    {
        return $this->hasMany(EjercicioDia::class, 'id_ejercicio', 'id_ejercicio');
    }
}
