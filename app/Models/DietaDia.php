<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietaDia extends Model
{
    protected $table = 'dieta_dia';

    protected $primaryKey = 'id_dieta_dia';

    protected $fillable = [
        'id_dieta',
        'dia_semana',
    ];

    // Relación muchos a uno con Dieta
    public function dieta()
    {
        return $this->belongsTo(Dieta::class, 'id_dieta', 'id_dieta');
    }
}
