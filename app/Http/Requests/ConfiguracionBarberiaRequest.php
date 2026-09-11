<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfiguracionBarberiaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:120'],
            'eslogan' => ['nullable', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string', 'max:2000'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'correo' => ['nullable', 'email', 'max:150'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'imagen_portada' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la barbería es obligatorio.',
            'correo.email' => 'Ingresa un correo electrónico válido.',
            'logo.image' => 'El logo debe ser una imagen válida.',
            'logo.mimes' => 'El logo debe ser JPG, PNG o WEBP.',
            'imagen_portada.image' => 'La portada debe ser una imagen válida.',
            'imagen_portada.mimes' => 'La portada debe ser JPG, PNG o WEBP.',
        ];
    }
}
