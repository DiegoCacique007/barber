<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServicioRequest;
use App\Http\Requests\UpdateServicioRequest;
use App\Models\Servicio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ServicioController extends Controller
{
    public function index(): View
    {
        $servicios = Servicio::latest('id')->paginate(10);

        return view('administrador.servicios.index', compact('servicios'));
    }

    public function create(): View
    {
        return view('administrador.servicios.create');
    }

    public function store(StoreServicioRequest $request): RedirectResponse
    {
        $datos = $request->validated();

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')
                ->store('servicios', 'public');
        }

        Servicio::create($datos);

        return redirect()
            ->route('administrador.servicios.index')
            ->with('success', 'Servicio registrado correctamente.');
    }

    public function show(Servicio $servicio): View
    {
        return view('administrador.servicios.show', compact('servicio'));
    }

    public function edit(Servicio $servicio): View
    {
        return view('administrador.servicios.edit', compact('servicio'));
    }

    public function update(
        UpdateServicioRequest $request,
        Servicio $servicio
    ): RedirectResponse {
        $datos = $request->validated();

        if ($request->hasFile('imagen')) {

            if ($servicio->imagen) {
                Storage::disk('public')->delete($servicio->imagen);
            }

            $datos['imagen'] = $request->file('imagen')
                ->store('servicios', 'public');
        }

        $servicio->update($datos);

        return redirect()
            ->route('administrador.servicios.index')
            ->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Servicio $servicio): RedirectResponse
    {
        if ($servicio->imagen) {
            Storage::disk('public')->delete($servicio->imagen);
        }

        $servicio->delete();

        return redirect()
            ->route('administrador.servicios.index')
            ->with('success', 'Servicio eliminado correctamente.');
    }
}
