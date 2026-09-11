<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class HorarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['cerrado' => $this->boolean('cerrado')]);

        if ($this->boolean('cerrado')) {
            $this->merge([
                'hora_apertura' => null,
                'hora_cierre' => null,
            ]);
        }
    }

    public function rules(): array
    {
        $horario = $this->route('horario');

        return [
            'dia_semana' => [
                'required',
                'integer',
                'between:1,7',
                Rule::unique('horarios', 'dia_semana')->ignore($horario?->id),
            ],
            'hora_apertura' => [
                Rule::requiredIf(!$this->boolean('cerrado')),
                'nullable',
                'date_format:H:i',
            ],
            'hora_cierre' => [
                Rule::requiredIf(!$this->boolean('cerrado')),
                'nullable',
                'date_format:H:i',
            ],
            'cerrado' => ['boolean'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (
                    !$this->boolean('cerrado') &&
                    $this->hora_apertura &&
                    $this->hora_cierre &&
                    $this->hora_cierre <= $this->hora_apertura
                ) {
                    $validator->errors()->add(
                        'hora_cierre',
                        'La hora de cierre debe ser posterior a la hora de apertura.'
                    );
                }
            },
        ];
    }

    public function messages(): array
    {
        return [
            'dia_semana.required' => 'Selecciona un día.',
            'dia_semana.between' => 'El día seleccionado no es válido.',
            'dia_semana.unique' => 'Ese día ya tiene un horario registrado.',
            'hora_apertura.required' => 'Ingresa la hora de apertura.',
            'hora_cierre.required' => 'Ingresa la hora de cierre.',
            'hora_apertura.date_format' => 'La hora de apertura no es válida.',
            'hora_cierre.date_format' => 'La hora de cierre no es válida.',
        ];
    }
}
