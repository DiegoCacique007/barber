<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfiguracionBarberiaRequest;
use App\Models\ConfiguracionBarberia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ConfiguracionBarberiaController extends Controller
{
    public function edit(): View
    {
        $configuracion = ConfiguracionBarberia::first();

        return view(
            'administrador.configuracion.edit',
            compact('configuracion')
        );
    }

    public function update(
        ConfiguracionBarberiaRequest $request
    ): RedirectResponse {
        $configuracion = ConfiguracionBarberia::firstOrCreate(
            [],
            ['nombre' => 'BARBER']
        );

        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($configuracion->logo) {
                Storage::disk('public')->delete($configuracion->logo);
            }

            $data['logo'] = $request->file('logo')
                ->store('configuracion', 'public');
        }

        if ($request->hasFile('imagen_portada')) {
            if ($configuracion->imagen_portada) {
                Storage::disk('public')
                    ->delete($configuracion->imagen_portada);
            }

            $data['imagen_portada'] = $request
                ->file('imagen_portada')
                ->store('configuracion', 'public');
        }

        $configuracion->update($data);

        return redirect()
            ->route('administrador.configuracion.edit')
            ->with('success', 'Configuración actualizada correctamente.');
    }
}
