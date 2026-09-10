<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Servicio;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalServicios = Servicio::count();
        $totalCitas = Cita::count();

        return view('administrador.dashboard', compact(
            'totalServicios',
            'totalCitas'
        ));
    }
}
