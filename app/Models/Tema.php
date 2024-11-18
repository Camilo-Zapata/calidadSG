<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    // Tabla asociada al modelo
    protected $table = 'temas';

    // Atributos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'tipo',
        'objetivo',
        'facilitador_nombre',
        'facilitador_cargo',
    ];

    // Relaciones
    public function asistentes()
    {
        return $this->hasMany(Asistente::class, 'tema_id');
    }



    public function verificaciones()
    {
        return $this->hasMany(Verificacion::class, 'tema_id');
    }
}
