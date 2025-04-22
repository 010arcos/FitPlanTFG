<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comida extends Model
{
    protected $table = 'comidas';

    protected $primaryKey = 'id_comida';

    protected $fillable = [
        'id_dieta',
        'tipo_comida',
        'descripcion',
        'calorias',
        'macros',
    ];

    // Relación muchos a uno con Dieta
    public function dieta()
    {
        return $this->belongsTo(Dieta::class, 'id_dieta', 'id_dieta');
    }
}
