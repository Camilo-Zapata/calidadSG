<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'tema_id',
        'fecha_verificacion',
        'responsable',
    ];

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }
}
