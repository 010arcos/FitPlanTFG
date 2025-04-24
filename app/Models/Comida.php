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

    // Relación muchos a muchos con Dieta
    public function dietas()
    {
        return $this->belongsToMany(Dieta::class, 'pivot_dieta_comida', 'id_comida', 'id_dieta')
                    ->withPivot('tipo_comida'); // Si quieres guardar más información en la tabla pivote
    }
}
