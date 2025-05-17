<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comida extends Model
{
    use SoftDeletes;
    protected $table = 'comidas';

    protected $primaryKey = 'id_comida';

    protected $fillable = [
        'id_dieta',
        'nombre',
        'alimentos',
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
