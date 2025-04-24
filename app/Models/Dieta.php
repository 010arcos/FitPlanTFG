<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
    protected $table = 'dietas';

    protected $primaryKey = 'id_dieta';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
    ];

    // Relación muchos a muchos con Comida
    public function comidas()
    {
        return $this->belongsToMany(Comida::class, 'pivot_dieta_comida', 'id_dieta', 'id_comida')
                    ->withPivot('tipo_comida'); // Si quieres guardar más información en la tabla pivote
    }

    // Relación muchos a muchos con Usuario (usando la tabla pivote)
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'pivot_usuario_dieta', 'id_dieta', 'id_usuario')
                    ->withPivot('fecha_asignacion');
    }

   
}
