<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCitaPublicaRequest;
use App\Models\{Cita, EstadoCita, Horario, User};
use App\Notifications\NuevaCitaNotification;
use Carbon\Carbon;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};

class CitaController extends Controller
{
    public function store(StoreCitaPublicaRequest $request): RedirectResponse
    {
        $estado = EstadoCita::where('nombre', 'Pendiente')->firstOrFail();

        $cita = Cita::create([
            ...$request->validated(),
            'estado_cita_id' => $estado->id,
        ]);

        User::where('activo', true)
            ->get()
            ->each(function (User $usuario) use ($cita) {
                $usuario->notify(
                    new NuevaCitaNotification($cita)
                );
            });

        return redirect()
            ->route('inicio')
            ->with(
                'success',
                'Tu cita fue solicitada correctamente. Te avisaremos cuando sea confirmada.'
            );
    }

    public function horariosDisponibles(Request $request): JsonResponse
    {
        $request->validate([
            'fecha' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
        ]);

        $fecha = Carbon::parse($request->fecha);

        $horario = Horario::where(
            'dia_semana',
            $fecha->isoWeekday()
        )->first();

        if (
            !$horario ||
            $horario->cerrado ||
            !$horario->hora_apertura ||
            !$horario->hora_cierre
        ) {
            return response()->json([
                'horarios' => [],
            ]);
        }

        $ocupados = Cita::whereDate('fecha', $fecha)
            ->whereHas(
                'estadoCita',
                fn ($q) => $q->whereIn(
                    'nombre',
                    ['Pendiente', 'Confirmada']
                )
            )
            ->pluck('hora')
            ->map(
                fn ($hora) => Carbon::parse($hora)->format('H:i')
            )
            ->toArray();

        $inicio = Carbon::parse(
            $fecha->format('Y-m-d') . ' ' . $horario->hora_apertura
        );

        $fin = Carbon::parse(
            $fecha->format('Y-m-d') . ' ' . $horario->hora_cierre
        );

        $ahora = now();

        $disponibles = [];

        while ($inicio->lt($fin)) {

            $hora = $inicio->format('H:i');

            if (
                !in_array($hora, $ocupados) &&
                (!$fecha->isToday() || $inicio->gt($ahora))
            ) {
                $disponibles[] = [
                    'valor' => $hora,
                    'texto' => $inicio->format('h:i A'),
                ];
            }

            $inicio->addMinutes(30);
        }

        return response()->json([
            'horarios' => $disponibles,
        ]);
    }
}
