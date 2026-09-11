<?php

use App\Http\Controllers\Administrador\{
    CitaController,
    DashboardController,
    HorarioController,
    ServicioController
};

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Publico\{
    CitaController as CitaPublicaController,
    LandingController
};

use Illuminate\Support\Facades\Route;

/* =========================
   RUTAS PÚBLICAS
========================= */

Route::get('/', [LandingController::class, 'index'])
    ->name('inicio');

Route::post('/agendar-cita', [CitaPublicaController::class, 'store'])
    ->name('citas.publica.store');

Route::get('/horarios-disponibles', [CitaPublicaController::class, 'horariosDisponibles'])
    ->name('citas.horarios');


/* =========================
   AUTENTICACIÓN
========================= */

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.submit');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/* =========================
   ADMINISTRADOR
========================= */

Route::middleware('auth')
    ->prefix('admin')
    ->name('administrador.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('servicios', ServicioController::class);

        Route::patch('citas/{cita}/estado', [CitaController::class, 'cambiarEstado'])
            ->name('citas.estado');

        Route::resource('citas', CitaController::class);

        Route::resource('horarios', HorarioController::class)
            ->except(['show']);
    });
