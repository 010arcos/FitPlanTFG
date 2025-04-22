<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
    protected $table = 'dietas';

    protected $primaryKey = 'id_dieta';

    protected $fillable = [
        'id_usuario',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
    ];

    // Relación muchos a uno con Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    // Relación uno a muchos con comidas
    public function comidas()
    {
        return $this->hasMany(Comida::class, 'id_dieta', 'id_dieta');
    }

    // Relación uno a muchos con dieta_dia
    public function dietaDias()
    {
        return $this->hasMany(DietaDia::class, 'id_dieta', 'id_dieta');
    }
}
