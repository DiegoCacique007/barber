@extends('layouts.administrador')

@section('title', 'Detalle del servicio')

@section('content')

    <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3">

        <div>
            <h1>{{ $servicio->nombre }}</h1>
            <p>Información completa del servicio.</p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('administrador.servicios.index') }}"
               class="btn btn-outline-secondary">
                Volver
            </a>

            <a href="{{ route('administrador.servicios.edit', $servicio) }}"
               class="btn"
               style="background:#c9a24d; color:#111;">
                Editar
            </a>

        </div>

    </div>

    <div class="row g-4">

        <div class="col-12 col-lg-5">

            <div class="admin-card">

                @if($servicio->imagen)

                    <img
                        src="{{ asset('storage/' . $servicio->imagen) }}"
                        alt="{{ $servicio->nombre }}"
                        class="img-fluid rounded-4"
                        style="width:100%; max-height:500px; object-fit:cover;"
                    >

                @else

                    <div
                        class="rounded-4 d-flex align-items-center justify-content-center text-secondary"
                        style="height:350px;background:#1b1b1b;font-size:50px;"
                    >
                        ✂
                    </div>

                @endif

            </div>

        </div>

        <div class="col-12 col-lg-7">

            <div class="admin-card">

                <div class="mb-4">
                    <div class="text-secondary small mb-1">
                        Nombre
                    </div>

                    <div class="fs-5">
                        {{ $servicio->nombre }}
                    </div>
                </div>

                <div class="mb-4">
                    <div class="text-secondary small mb-1">
                        Descripción
                    </div>

                    <div>
                        {{ $servicio->descripcion ?: 'Sin descripción.' }}
                    </div>
                </div>

                <div class="mb-4">
                    <div class="text-secondary small mb-1">
                        Precio
                    </div>

                    <div class="fs-4">
                        ${{ number_format($servicio->precio, 2) }}
                    </div>
                </div>

                <div>
                    <div class="text-secondary small mb-2">
                        Estado
                    </div>

                    @if($servicio->activo)

                        <span class="badge text-bg-success">
                        Activo
                    </span>

                    @else

                        <span class="badge text-bg-secondary">
                        Inactivo
                    </span>

                    @endif
                </div>

            </div>

        </div>

    </div>

@endsection
