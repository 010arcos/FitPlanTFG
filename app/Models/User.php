<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable //implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'apellido',
        'genero',  // Agregado
        'edad',      // Agregado
        'altura',    // Agregado
        'peso',      // Agregado
        'activo',    // Agregado
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación muchos a muchos con Dieta
    public function dietas()
    {
        return $this->belongsToMany(Dieta::class, 'pivot_usuario_dieta', 'id_usuario', 'id_dieta')
            ->withTimestamps();
    }

    // En el modelo User
    public function rutinas()
    {
        return $this->belongsToMany(Rutina::class, 'pivot_usuario_rutina', 'id_usuario', 'id_rutina')
            ->withPivot('fecha_inicio', 'fecha_fin')
            ->withTimestamps();
    }

    public function historialPesos(){
        return $this->hasMany(HistorialPeso::class, 'id_usuario', 'id');
    }

    public function ultimoPeso(){
        return $this->hasOne(HistorialPeso::class, 'id_usuario', 'id')->latest('fecha_registro');
    }

    public function obtenerDatosGraficos()
    {
        $historial = $this->historialPesos()
            ->orderBy('fecha_registro', 'asc')
            ->get(['fecha_registro', 'peso', 'imc']);

        return [
            'fechas' => $historial->pluck('fecha_registro')->map(fn($fecha) => $fecha->format('d/m/Y')),
            'pesos' => $historial->pluck('peso'),
            'imcs' => $historial->pluck('imc'),
            'total' => $historial->count()
        ];
    }
}
