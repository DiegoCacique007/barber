<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstadoCita extends Model
{
    use HasFactory;

    protected $table = 'estados_cita';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'estado_cita_id');
    }
}
