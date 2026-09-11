@extends('layouts.administrador')

@section('title', 'Detalle de cita')

@section('content')

    <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3">

        <div>

            <h1>Detalle de cita</h1>

            <p>
                Consulta la información completa de la cita #{{ $cita->id }}.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('administrador.citas.index') }}"
                class="btn btn-outline-secondary"
            >
                Volver
            </a>

            <a
                href="{{ route('administrador.citas.edit', $cita) }}"
                class="btn"
                style="
                background:#c9a24d;
                color:#111;
                font-weight:600;
            "
            >
                Editar cita
            </a>

        </div>

    </div>


    <div class="row g-4">

        <div class="col-12 col-lg-8">

            <div class="admin-card">

                <div
                    class="d-flex justify-content-between align-items-start mb-4 pb-4"
                    style="
                    border-bottom:1px solid rgba(255,255,255,.07);
                "
                >

                    <div>

                        <div
                            class="text-secondary small mb-1"
                        >
                            Cliente
                        </div>

                        <h3 class="mb-0">
                            {{ $cita->nombre_cliente }}
                        </h3>

                    </div>

                    @php

                        $estadoNombre = $cita->estadoCita->nombre;

                        $estilosEstado = match($estadoNombre) {
                            'Pendiente' => [
                                'background' => 'rgba(255,193,7,.12)',
                                'color' => '#e9c968'
                            ],

                            'Confirmada' => [
                                'background' => 'rgba(13,110,253,.12)',
                                'color' => '#7db2ff'
                            ],

                            'Completada' => [
                                'background' => 'rgba(25,135,84,.12)',
                                'color' => '#75d49e'
                            ],

                            'Cancelada' => [
                                'background' => 'rgba(108,117,125,.15)',
                                'color' => '#aaa'
                            ],

                            'Rechazada' => [
                                'background' => 'rgba(220,53,69,.12)',
                                'color' => '#ff8793'
                            ],

                            default => [
                                'background' => '#222',
                                'color' => '#aaa'
                            ],
                        };

                    @endphp

                    <span
                        class="badge rounded-pill px-3 py-2"
                        style="
                        background:{{ $estilosEstado['background'] }};
                        color:{{ $estilosEstado['color'] }};
                    "
                    >
                    {{ $estadoNombre }}
                </span>

                </div>


                <div class="row g-4">

                    <div class="col-12 col-md-6">

                        <div class="text-secondary small mb-1">
                            Teléfono
                        </div>

                        <div class="fs-6">
                            {{ $cita->telefono }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-secondary small mb-1">
                            Correo electrónico
                        </div>

                        <div class="fs-6">
                            {{ $cita->correo ?: 'No proporcionado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-secondary small mb-1">
                            Fecha
                        </div>

                        <div class="fs-5">
                            {{ $cita->fecha->translatedFormat('d \d\e F \d\e Y') }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-secondary small mb-1">
                            Hora
                        </div>

                        <div class="fs-5">
                            {{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-12 col-lg-4">

            <div class="admin-card mb-4">

                <div class="admin-card-label">
                    Estado actual
                </div>

                <div
                    style="
                    font-size:21px;
                    font-weight:600;
                "
                >
                    {{ $cita->estadoCita->nombre }}
                </div>

                @if($cita->estadoCita->descripcion)

                    <p
                        class="mb-0 mt-2"
                        style="
                        color:#777;
                        font-size:13px;
                        line-height:1.6;
                    "
                    >
                        {{ $cita->estadoCita->descripcion }}
                    </p>

                @endif

            </div>


            <div class="admin-card">

                <div class="admin-card-label">
                    Registro
                </div>

                <div class="mb-3">

                    <div class="text-secondary small">
                        Creada
                    </div>

                    <div class="mt-1">
                        {{ $cita->created_at->format('d/m/Y h:i A') }}
                    </div>

                </div>

                <div>

                    <div class="text-secondary small">
                        Última actualización
                    </div>

                    <div class="mt-1">
                        {{ $cita->updated_at->format('d/m/Y h:i A') }}
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
