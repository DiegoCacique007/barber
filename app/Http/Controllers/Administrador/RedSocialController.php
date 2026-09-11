<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\RedSocialRequest;
use App\Models\RedSocial;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RedSocialController extends Controller
{
    public function index(): View
    {
        $redes = RedSocial::orderByDesc('activo')
            ->orderBy('nombre')
            ->paginate(10);

        $totalRedes = RedSocial::count();
        $redesActivas = RedSocial::where('activo', true)->count();
        $redesInactivas = RedSocial::where('activo', false)->count();

        return view('administrador.redes.index', compact(
            'redes',
            'totalRedes',
            'redesActivas',
            'redesInactivas'
        ));
    }

    public function create(): View
    {
        return view('administrador.redes.create');
    }

    public function store(RedSocialRequest $request): RedirectResponse
    {
        RedSocial::create($request->validated());

        return redirect()
            ->route('administrador.redes.index')
            ->with('success', 'Red social registrada correctamente.');
    }

    public function edit(RedSocial $redSocial): View
    {
        return view('administrador.redes.edit', compact('redSocial'));
    }

    public function update(RedSocialRequest $request, RedSocial $redSocial): RedirectResponse
    {
        $redSocial->update($request->validated());

        return redirect()
            ->route('administrador.redes.index')
            ->with('success', 'Red social actualizada correctamente.');
    }

    public function destroy(RedSocial $redSocial): RedirectResponse
    {
        $redSocial->delete();

        return redirect()
            ->route('administrador.redes.index')
            ->with('success', 'Red social eliminada correctamente.');
    }
}
