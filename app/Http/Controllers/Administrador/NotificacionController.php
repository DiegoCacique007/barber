<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function ver(
        Request $request,
        string $notificacion
    ): RedirectResponse {

        $notification = $request->user()
            ->notifications()
            ->where('id', $notificacion)
            ->firstOrFail();

        $notification->markAsRead();

        $citaId = $notification->data['cita_id'] ?? null;

        if (!$citaId) {
            return redirect()
                ->route('administrador.dashboard');
        }

        $cita = Cita::find($citaId);

        if (!$cita) {
            return redirect()
                ->route('administrador.citas.index');
        }

        return redirect()
            ->route('administrador.citas.show', $cita);
    }

    public function marcarTodas(
        Request $request
    ): RedirectResponse {

        $request->user()
            ->unreadNotifications
            ->markAsRead();

        return back();
    }
}
