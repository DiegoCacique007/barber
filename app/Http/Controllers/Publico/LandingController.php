<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Models\{ConfiguracionBarberia, Horario, RedSocial, Servicio};
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        $configuracion = ConfiguracionBarberia::first();
        $servicios = Servicio::where('activo', true)->latest()->get();
        $horarios = Horario::orderBy('dia_semana')->get();
        $redes = RedSocial::where('activo', true)->get();

        return view('publico.inicio', compact('configuracion', 'servicios', 'horarios', 'redes'));
    }
}
