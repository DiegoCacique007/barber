<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreCitaRequest, UpdateCitaRequest};
use App\Models\{Cita, EstadoCita};
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\View\View;

class CitaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Cita::with('estadoCita')
            ->orderBy('fecha')
            ->orderBy('hora');

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;

            $query->where(function ($q) use ($buscar) {
                $q->where('nombre_cliente', 'like', "%{$buscar}%")
                    ->orWhere('telefono', 'like', "%{$buscar}%")
                    ->orWhere('correo', 'like', "%{$buscar}%");
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado_cita_id', $request->estado);
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        $citas = $query->paginate(10)->withQueryString();
        $estados = EstadoCita::orderBy('nombre')->get();

        return view('administrador.citas.index', compact('citas', 'estados'));
    }

    public function create(): View
    {
        $estados = EstadoCita::orderBy('nombre')->get();

        return view('administrador.citas.create', compact('estados'));
    }

    public function store(StoreCitaRequest $request): RedirectResponse
    {
        Cita::create($request->validated());

        return redirect()
            ->route('administrador.citas.index')
            ->with('success', 'La cita fue registrada correctamente.');
    }

    public function show(Cita $cita): View
    {
        $cita->load('estadoCita');

        return view('administrador.citas.show', compact('cita'));
    }

    public function edit(Cita $cita): View
    {
        $estados = EstadoCita::orderBy('nombre')->get();

        return view('administrador.citas.edit', compact('cita', 'estados'));
    }

    public function update(UpdateCitaRequest $request, Cita $cita): RedirectResponse
    {
        $cita->update($request->validated());

        return redirect()
            ->route('administrador.citas.index')
            ->with('success', 'La cita fue actualizada correctamente.');
    }

    public function cambiarEstado(Request $request, Cita $cita): RedirectResponse
    {
        $request->validate([
            'estado' => [
                'required',
                'string',
                'in:Pendiente,Confirmada,Completada,Cancelada,Rechazada',
            ],
        ]);

        $cita->load('estadoCita');

        $actual = $cita->estadoCita->nombre;

        $transiciones = [
            'Pendiente' => ['Confirmada', 'Rechazada', 'Cancelada'],
            'Confirmada' => ['Completada', 'Cancelada'],
            'Completada' => [],
            'Cancelada' => [],
            'Rechazada' => [],
        ];

        if (!in_array($request->estado, $transiciones[$actual] ?? [])) {
            return back()->with(
                'error',
                "No se puede cambiar una cita de {$actual} a {$request->estado}."
            );
        }

        $estado = EstadoCita::where('nombre', $request->estado)->firstOrFail();

        $cita->update([
            'estado_cita_id' => $estado->id,
        ]);

        return back()->with(
            'success',
            "La cita de {$cita->nombre_cliente} fue marcada como {$estado->nombre}."
        );
    }

    public function destroy(Cita $cita): RedirectResponse
    {
        $cita->delete();

        return redirect()
            ->route('administrador.citas.index')
            ->with('success', 'La cita fue eliminada correctamente.');
    }
}
