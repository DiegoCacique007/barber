<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\{Cita, Servicio};
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalServicios = Servicio::count();
        $totalCitas = Cita::count();

        $citasPendientes = Cita::whereHas(
            'estadoCita',
            fn ($q) => $q->where('nombre', 'Pendiente')
        )->count();

        $citasConfirmadas = Cita::whereHas(
            'estadoCita',
            fn ($q) => $q->where('nombre', 'Confirmada')
        )->count();

        $citasCompletadas = Cita::whereHas(
            'estadoCita',
            fn ($q) => $q->where('nombre', 'Completada')
        )->count();

        $citasHoy = Cita::whereDate('fecha', today())
            ->whereHas(
                'estadoCita',
                fn ($q) => $q->whereIn('nombre', [
                    'Pendiente',
                    'Confirmada'
                ])
            )
            ->count();

        $proximaCita = Cita::with('estadoCita')
            ->whereHas(
                'estadoCita',
                fn ($q) => $q->whereIn('nombre', [
                    'Pendiente',
                    'Confirmada'
                ])
            )
            ->where(function ($q) {
                $q->whereDate('fecha', '>', today())
                    ->orWhere(function ($q) {
                        $q->whereDate('fecha', today())
                            ->whereTime('hora', '>=', now()->format('H:i:s'));
                    });
            })
            ->orderBy('fecha')
            ->orderBy('hora')
            ->first();

        return view('administrador.dashboard', compact(
            'totalServicios',
            'totalCitas',
            'citasPendientes',
            'citasConfirmadas',
            'citasCompletadas',
            'citasHoy',
            'proximaCita'
        ));
    }
}
