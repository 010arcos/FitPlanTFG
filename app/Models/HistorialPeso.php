<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialPeso extends Model
{
    use HasFactory, SoftDeletes;    
    protected $table = 'historial_pesos';
    protected $primaryKey = 'id_historial';
    protected $fillable = [
        'id_usuario',
        'peso',
        'altura',
        'imc',
        'fecha_registro',
        'notas'
    ];

    protected $casts = [
        'peso' => 'float',
        'altura' => 'float',
        'imc' => 'float',
        'fecha_registro' => 'date'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    protected static function boot()
{
    parent::boot();
    
    static::saving(function ($historial) {
        if ($historial->peso > 0 && $historial->altura > 0) {
            $historial->imc = round($historial->peso / ($historial->altura * $historial->altura), 2);
        }
    });
}

    public static function calcularCategoriaIMC($imc)
    {
        if (!$imc) return 'No calculado';
        if ($imc < 18.5) return 'Bajo peso';
        if ($imc < 25) return 'Normal';
        if ($imc < 30) return 'Sobrepeso';
        return 'Obesidad';
    }

}
