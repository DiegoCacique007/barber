<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RedSocialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'activo' => $this->boolean('activo'),
        ]);
    }

    public function rules(): array
    {
        $redSocial = $this->route('redSocial');

        return [
            'nombre' => [
                'required',
                'string',
                'max:50',
                Rule::unique('redes_sociales', 'nombre')->ignore($redSocial?->id),
            ],
            'url' => ['required', 'url', 'max:2048'],
            'icono' => ['nullable', 'string', 'max:100'],
            'activo' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la red social es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder los 50 caracteres.',
            'nombre.unique' => 'Esta red social ya está registrada.',
            'url.required' => 'Ingresa el enlace de la red social.',
            'url.url' => 'Ingresa una URL válida.',
            'url.max' => 'La URL es demasiado larga.',
            'icono.max' => 'El icono no puede exceder los 100 caracteres.',
        ];
    }
}
