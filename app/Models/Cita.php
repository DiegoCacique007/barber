<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'estado_cita_id',
        'nombre_cliente',
        'telefono',
        'correo',
        'fecha',
        'hora',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function estadoCita(): BelongsTo
    {
        return $this->belongsTo(EstadoCita::class, 'estado_cita_id');
    }
}
