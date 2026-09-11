<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('estado_cita_id')
                ->constrained('estados_cita')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('nombre_cliente', 120);
            $table->string('telefono', 20);
            $table->date('fecha');
            $table->time('hora');

            $table->timestamps();

            $table->index('fecha');
            $table->index(['fecha', 'hora']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
