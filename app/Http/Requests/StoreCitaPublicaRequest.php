<?php

namespace App\Http\Requests;

use App\Models\{Cita, Horario};
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreCitaPublicaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_cliente' => ['required', 'string', 'max:120'],
            'telefono' => ['required', 'string', 'max:20'],
            'correo' => ['nullable', 'email', 'max:150'],
            'fecha' => ['required', 'date', 'after_or_equal:today'],
            'hora' => ['required', 'date_format:H:i'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (
                    $validator->errors()->has('fecha') ||
                    $validator->errors()->has('hora')
                ) {
                    return;
                }

                $fecha = Carbon::parse($this->fecha);
                $horaSeleccionada = Carbon::parse(
                    $this->fecha . ' ' . $this->hora
                );

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
                    $validator->errors()->add(
                        'fecha',
                        'La barbería no ofrece citas en la fecha seleccionada.'
                    );

                    return;
                }

                $apertura = Carbon::parse(
                    $this->fecha . ' ' . $horario->hora_apertura
                );

                $cierre = Carbon::parse(
                    $this->fecha . ' ' . $horario->hora_cierre
                );

                if ($fecha->isToday() && $horaSeleccionada->lte(now())) {
                    $validator->errors()->add(
                        'hora',
                        'No puedes seleccionar un horario que ya pasó.'
                    );

                    return;
                }

                if (
                    $horaSeleccionada->lt($apertura) ||
                    $horaSeleccionada->copy()->addMinutes(30)->gt($cierre)
                ) {
                    $validator->errors()->add(
                        'hora',
                        'El horario seleccionado está fuera del horario de atención.'
                    );

                    return;
                }

                $minutosDesdeApertura = $apertura->diffInMinutes(
                    $horaSeleccionada,
                    false
                );

                if ($minutosDesdeApertura % 30 !== 0) {
                    $validator->errors()->add(
                        'hora',
                        'Selecciona uno de los horarios disponibles.'
                    );

                    return;
                }

                $ocupada = Cita::query()
                    ->whereDate('fecha', $this->fecha)
                    ->whereTime(
                        'hora',
                        Carbon::createFromFormat(
                            'H:i',
                            $this->hora
                        )->format('H:i:s')
                    )
                    ->whereHas('estadoCita', function ($query) {
                        $query->whereIn('nombre', [
                            'Pendiente',
                            'Confirmada',
                        ]);
                    })
                    ->exists();

                if ($ocupada) {
                    $validator->errors()->add(
                        'hora',
                        'Ese horario acaba de ser ocupado. Selecciona otro.'
                    );
                }
            },
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_cliente.required' => 'Ingresa tu nombre.',
            'nombre_cliente.max' => 'El nombre no puede exceder los 120 caracteres.',

            'telefono.required' => 'Ingresa tu número de teléfono.',
            'telefono.max' => 'El teléfono no puede exceder los 20 caracteres.',

            'fecha.required' => 'Selecciona una fecha.',
            'fecha.date' => 'La fecha seleccionada no es válida.',
            'fecha.after_or_equal' => 'No puedes seleccionar una fecha anterior al día actual.',

            'hora.required' => 'Selecciona un horario disponible.',
            'hora.date_format' => 'El horario seleccionado no es válido.',
        ];
    }
}
