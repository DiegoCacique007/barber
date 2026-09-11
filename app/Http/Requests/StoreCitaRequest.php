<?php

namespace App\Http\Requests;

use App\Models\Cita;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreCitaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'estado_cita_id' => [
                'required',
                'integer',
                'exists:estados_cita,id',
            ],

            'nombre_cliente' => [
                'required',
                'string',
                'max:120',
            ],

            'telefono' => [
                'required',
                'string',
                'max:20',
            ],

            'correo' => [
                'nullable',
                'email',
                'max:150',
            ],

            'fecha' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'hora' => [
                'required',
                'date_format:H:i',
            ],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {

                if (
                    !$this->filled('fecha') ||
                    !$this->filled('hora')
                ) {
                    return;
                }

                $ocupada = Cita::query()
                    ->whereDate('fecha', $this->fecha)
                    ->whereTime('hora', $this->hora)
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
                        'El horario seleccionado ya se encuentra ocupado.'
                    );
                }
            },
        ];
    }

    public function messages(): array
    {
        return [
            'estado_cita_id.required' =>
                'Selecciona un estado para la cita.',

            'estado_cita_id.exists' =>
                'El estado seleccionado no es válido.',

            'nombre_cliente.required' =>
                'El nombre del cliente es obligatorio.',

            'nombre_cliente.max' =>
                'El nombre no puede exceder los 120 caracteres.',

            'telefono.required' =>
                'El teléfono es obligatorio.',

            'telefono.max' =>
                'El teléfono no puede exceder los 20 caracteres.',

            'correo.email' =>
                'Ingresa un correo electrónico válido.',

            'fecha.required' =>
                'La fecha de la cita es obligatoria.',

            'fecha.date' =>
                'La fecha seleccionada no es válida.',

            'fecha.after_or_equal' =>
                'No puedes registrar una cita en una fecha pasada.',

            'hora.required' =>
                'La hora de la cita es obligatoria.',

            'hora.date_format' =>
                'La hora seleccionada no tiene un formato válido.',
        ];
    }
}
