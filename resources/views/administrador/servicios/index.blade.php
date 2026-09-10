@extends('layouts.administrador')

@section('title', 'Servicios')

@section('content')

    <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3">

        <div>
            <h1>Servicios</h1>
            <p>Administra los cortes y servicios que se mostrarán en la landing page.</p>
        </div>

        <a href="{{ route('administrador.servicios.create') }}"
           class="btn"
           style="background:#c9a24d; color:#111; font-weight:600;">
            + Nuevo servicio
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-card p-0 overflow-hidden">

        <div class="table-responsive">

            <table class="table table-dark table-hover align-middle mb-0">

                <thead>
                <tr>
                    <th class="ps-4">Imagen</th>
                    <th>Servicio</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th class="text-end pe-4">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @forelse($servicios as $servicio)

                    <tr>

                        <td class="ps-4">

                            @if($servicio->imagen)

                                <img
                                    src="{{ asset('storage/' . $servicio->imagen) }}"
                                    alt="{{ $servicio->nombre }}"
                                    width="62"
                                    height="62"
                                    class="rounded-3"
                                    style="object-fit:cover;"
                                >

                            @else

                                <div
                                    class="rounded-3 d-flex align-items-center justify-content-center"
                                    style="width:62px;height:62px;background:#222;color:#666;"
                                >
                                    ✂
                                </div>

                            @endif

                        </td>

                        <td>
                            <strong>{{ $servicio->nombre }}</strong>

                            @if($servicio->descripcion)
                                <div class="text-secondary small mt-1">
                                    {{ \Illuminate\Support\Str::limit($servicio->descripcion, 60) }}
                                </div>
                            @endif
                        </td>

                        <td>
                            ${{ number_format($servicio->precio, 2) }}
                        </td>

                        <td>
                            @if($servicio->activo)

                                <span class="badge rounded-pill text-bg-success">
                                Activo
                            </span>

                            @else

                                <span class="badge rounded-pill text-bg-secondary">
                                Inactivo
                            </span>

                            @endif
                        </td>

                        <td class="text-end pe-4">

                            <div class="d-inline-flex gap-2">

                                <a
                                    href="{{ route('administrador.servicios.show', $servicio) }}"
                                    class="btn btn-sm btn-outline-light"
                                >
                                    Ver
                                </a>

                                <a
                                    href="{{ route('administrador.servicios.edit', $servicio) }}"
                                    class="btn btn-sm btn-outline-warning"
                                >
                                    Editar
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('administrador.servicios.destroy', $servicio) }}"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar este servicio?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                    >
                                        Eliminar
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5"
                            class="text-center text-secondary py-5">

                            No hay servicios registrados todavía.

                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-4">
        {{ $servicios->links() }}
    </div>

@endsection
