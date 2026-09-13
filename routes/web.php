<?php

use App\Http\Controllers\Administrador\{
    CitaController,
    ConfiguracionBarberiaController,
    DashboardController,
    HorarioController,
    NotificacionController,
    PushSubscriptionController,
    RedSocialController,
    ServicioController
};

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Publico\{
    CitaController as CitaPublicaController,
    LandingController
};

use Illuminate\Support\Facades\Route;


/* =========================================================
   RUTAS PÚBLICAS
========================================================= */

Route::get(
    '/',
    [LandingController::class, 'index']
)->name('inicio');


Route::post(
    '/agendar-cita',
    [CitaPublicaController::class, 'store']
)->name('citas.publica.store');


Route::get(
    '/horarios-disponibles',
    [CitaPublicaController::class, 'horariosDisponibles']
)->name('citas.horarios');


/* =========================================================
   AUTENTICACIÓN
========================================================= */

Route::middleware('guest')
    ->group(function () {

        Route::get(
            '/login',
            [LoginController::class, 'showLoginForm']
        )->name('login');


        Route::post(
            '/login',
            [LoginController::class, 'login']
        )->name('login.submit');

    });


Route::post(
    '/logout',
    [LoginController::class, 'logout']
)
    ->middleware('auth')
    ->name('logout');


/* =========================================================
   ADMINISTRADOR
========================================================= */

Route::middleware('auth')
    ->prefix('admin')
    ->name('administrador.')
    ->group(function () {


        /* =====================================================
           DASHBOARD
        ====================================================== */

        Route::get(
            '/',
            [DashboardController::class, 'index']
        )->name('dashboard');


        /* =====================================================
           PUSH NOTIFICATIONS
        ====================================================== */

        Route::post(
            'push/subscribe',
            [PushSubscriptionController::class, 'store']
        )->name('push.subscribe');


        Route::delete(
            'push/unsubscribe',
            [PushSubscriptionController::class, 'destroy']
        )->name('push.unsubscribe');


        /* =====================================================
           NOTIFICACIONES INTERNAS
        ====================================================== */

        Route::patch(
            'notificaciones/marcar-todas',
            [NotificacionController::class, 'marcarTodas']
        )->name('notificaciones.marcar-todas');


        Route::get(
            'notificaciones/{notificacion}',
            [NotificacionController::class, 'ver']
        )->name('notificaciones.ver');


        /* =====================================================
           SERVICIOS
        ====================================================== */

        Route::resource(
            'servicios',
            ServicioController::class
        );


        /* =====================================================
           CITAS
        ====================================================== */

        Route::patch(
            'citas/{cita}/estado',
            [CitaController::class, 'cambiarEstado']
        )->name('citas.estado');


        Route::resource(
            'citas',
            CitaController::class
        );


        /* =====================================================
           HORARIOS
        ====================================================== */

        Route::resource(
            'horarios',
            HorarioController::class
        )->except([
            'show'
        ]);


        /* =====================================================
           REDES SOCIALES
        ====================================================== */

        Route::resource(
            'redes',
            RedSocialController::class
        )
            ->parameters([
                'redes' => 'redSocial'
            ])
            ->except([
                'show'
            ]);


        /* =====================================================
           CONFIGURACIÓN
        ====================================================== */

        Route::get(
            'configuracion',
            [ConfiguracionBarberiaController::class, 'edit']
        )->name('configuracion.edit');


        Route::put(
            'configuracion',
            [ConfiguracionBarberiaController::class, 'update']
        )->name('configuracion.update');

    });
