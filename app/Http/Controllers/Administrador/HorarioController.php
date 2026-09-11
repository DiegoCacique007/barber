<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\HorarioRequest;
use App\Models\Horario;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HorarioController extends Controller
{
    public function index(): View
    {
        $horarios = Horario::orderBy('dia_semana')->get()->keyBy('dia_semana');

        return view('administrador.horarios.index', compact('horarios'));
    }

    public function create(): View
    {
        $diasOcupados = Horario::pluck('dia_semana')->toArray();

        return view('administrador.horarios.create', compact('diasOcupados'));
    }

    public function store(HorarioRequest $request): RedirectResponse
    {
        Horario::create($request->validated());

        return redirect()
            ->route('administrador.horarios.index')
            ->with('success', 'Horario registrado correctamente.');
    }

    public function edit(Horario $horario): View
    {
        return view('administrador.horarios.edit', compact('horario'));
    }

    public function update(HorarioRequest $request, Horario $horario): RedirectResponse
    {
        $horario->update($request->validated());

        return redirect()
            ->route('administrador.horarios.index')
            ->with('success', 'Horario actualizado correctamente.');
    }

    public function destroy(Horario $horario): RedirectResponse
    {
        $horario->delete();

        return redirect()
            ->route('administrador.horarios.index')
            ->with('success', 'Horario eliminado correctamente.');
    }
}
