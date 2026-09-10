<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionBarberia extends Model
{
    use HasFactory;

    protected $table = 'configuracion_barberia';

    protected $fillable = [
        'nombre',
        'eslogan',
        'descripcion',
        'logo',
        'imagen_portada',
        'telefono',
        'whatsapp',
        'correo',
        'direccion',
    ];
}
