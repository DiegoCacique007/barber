<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuracion_barberia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 120);
            $table->string('eslogan', 200)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('logo')->nullable();
            $table->string('imagen_portada')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('correo', 150)->nullable();
            $table->string('direccion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion_barberia');
    }
};
