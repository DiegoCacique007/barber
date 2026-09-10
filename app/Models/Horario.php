<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia_semana',
        'hora_apertura',
        'hora_cierre',
        'cerrado',
    ];

    protected function casts(): array
    {
        return [
            'dia_semana' => 'integer',
            'cerrado' => 'boolean',
        ];
    }
}
