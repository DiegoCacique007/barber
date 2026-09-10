<?php

namespace Database\Seeders;

use App\Models\EstadoCita;
use Illuminate\Database\Seeder;

class EstadoCitaSeeder extends Seeder
{
    public function run(): void
    {
        EstadoCita::create([
            'nombre' => 'Pendiente',
            'descripcion' => 'La solicitud está esperando revisión del administrador.',
        ]);

        EstadoCita::create([
            'nombre' => 'Confirmada',
            'descripcion' => 'La cita fue confirmada por el administrador.',
        ]);

        EstadoCita::create([
            'nombre' => 'Completada',
            'descripcion' => 'La cita fue atendida correctamente.',
        ]);

        EstadoCita::create([
            'nombre' => 'Cancelada',
            'descripcion' => 'La cita fue cancelada.',
        ]);

        EstadoCita::create([
            'nombre' => 'Rechazada',
            'descripcion' => 'La solicitud fue rechazada por el administrador.',
        ]);
    }
}
