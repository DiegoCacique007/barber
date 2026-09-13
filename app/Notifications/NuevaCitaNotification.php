<?php

namespace App\Notifications;

use App\Models\Cita;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class NuevaCitaNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Cita $cita
    ) {}

    public function via(object $notifiable): array
    {
        return [
            'database',
            WebPushChannel::class,
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'cita_id' => $this->cita->id,
            'titulo' => 'Nueva solicitud de cita',
            'mensaje' => "{$this->cita->nombre_cliente} solicitó una nueva cita.",
            'nombre_cliente' => $this->cita->nombre_cliente,
            'telefono' => $this->cita->telefono,
            'fecha' => $this->cita->fecha->format('Y-m-d'),
            'hora' => $this->cita->hora,
        ];
    }

    public function toWebPush(
        object $notifiable,
        Notification $notification
    ): WebPushMessage {
        return (new WebPushMessage)
            ->title('Nueva solicitud de cita')
            ->body(
                $this->cita->nombre_cliente
                . ' solicitó una cita para '
                . $this->cita->fecha->format('d/m/Y')
                . ' a las '
                . date('h:i A', strtotime($this->cita->hora))
            )
            ->icon('/favicon.ico')
            ->badge('/favicon.ico')
            ->data([
                'url' => route(
                    'administrador.notificaciones.ver',
                    $notification->id,
                    false
                ),
                'cita_id' => $this->cita->id,
            ])
            ->tag('cita-' . $this->cita->id)
            ->options([
                'TTL' => 3600,
            ]);
    }
}
