@extends('layouts.administrador')

@section('title', 'Dashboard')

@push('styles')
    <style>
        .dashboard-grid {
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:18px;
        }

        .dashboard-card {
            position:relative;
            overflow:hidden;
            min-height:150px;
            padding:22px;
            border:1px solid rgba(255,255,255,.07);
            border-radius:17px;
            background:#131313;
            transition:.25s ease;
        }

        .dashboard-card:hover {
            transform:translateY(-3px);
            border-color:rgba(201,162,77,.18);
        }

        .dashboard-card::after {
            content:"";
            position:absolute;
            width:90px;
            height:90px;
            right:-35px;
            top:-35px;
            border-radius:50%;
            background:rgba(201,162,77,.035);
        }

        .dashboard-label {
            margin-bottom:18px;
            color:#777;
            font-size:10px;
            font-weight:600;
            letter-spacing:1.3px;
            text-transform:uppercase;
        }

        .dashboard-value {
            color:#f4f1e8;
            font-size:34px;
            font-weight:700;
            line-height:1;
        }

        .dashboard-description {
            margin-top:10px;
            color:#626262;
            font-size:11px;
        }

        .dashboard-accent {
            color:#c9a24d;
        }

        .dashboard-content-grid {
            display:grid;
            grid-template-columns:1.4fr .6fr;
            gap:20px;
            margin-top:22px;
        }

        .dashboard-panel {
            padding:25px;
            border:1px solid rgba(255,255,255,.07);
            border-radius:17px;
            background:#131313;
        }

        .panel-header {
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:20px;
            margin-bottom:24px;
        }

        .panel-header h5 {
            margin:0;
            color:#eee;
            font-size:15px;
            font-weight:600;
        }

        .panel-header span {
            display:block;
            margin-top:5px;
            color:#666;
            font-size:11px;
        }

        .panel-link {
            color:#c9a24d;
            font-size:11px;
            text-decoration:none;
            transition:.2s;
        }

        .panel-link:hover {
            color:#e2c36e;
        }

        .next-appointment {
            display:grid;
            grid-template-columns:auto 1fr auto;
            align-items:center;
            gap:22px;
            padding:20px;
            border:1px solid rgba(255,255,255,.055);
            border-radius:14px;
            background:#0f0f0f;
        }

        .appointment-time {
            min-width:100px;
            padding-right:22px;
            border-right:1px solid rgba(255,255,255,.07);
        }

        .appointment-time strong {
            display:block;
            color:#f2f2f2;
            font-size:19px;
            font-weight:700;
        }

        .appointment-time span {
            display:block;
            margin-top:5px;
            color:#666;
            font-size:10px;
        }

        .appointment-client strong {
            display:block;
            color:#ddd;
            font-size:14px;
        }

        .appointment-client span {
            display:block;
            margin-top:5px;
            color:#666;
            font-size:11px;
        }

        .appointment-status {
            display:inline-flex;
            align-items:center;
            gap:6px;
            padding:6px 10px;
            border-radius:100px;
            font-size:10px;
            font-weight:600;
        }

        .appointment-status::before {
            content:"";
            width:6px;
            height:6px;
            border-radius:50%;
            background:currentColor;
        }

        .status-pendiente {
            color:#ddb65a;
            border:1px solid rgba(221,182,90,.18);
            background:rgba(221,182,90,.07);
        }

        .status-confirmada {
            color:#79a9e6;
            border:1px solid rgba(121,169,230,.18);
            background:rgba(121,169,230,.07);
        }

        .empty-next {
            padding:35px 20px;
            border:1px dashed rgba(255,255,255,.08);
            border-radius:14px;
            color:#666;
            text-align:center;
            font-size:12px;
        }

        .quick-list {
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .quick-link {
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:14px 15px;
            border:1px solid rgba(255,255,255,.06);
            border-radius:11px;
            background:#0f0f0f;
            color:#929292;
            font-size:12px;
            text-decoration:none;
            transition:.2s;
        }

        .quick-link:hover {
            color:#fff;
            border-color:rgba(201,162,77,.18);
            transform:translateX(2px);
        }

        .quick-link span:last-child {
            color:#c9a24d;
        }

        @media(max-width:1200px) {
            .dashboard-grid {
                grid-template-columns:repeat(2,1fr);
            }

            .dashboard-content-grid {
                grid-template-columns:1fr;
            }
        }

        @media(max-width:650px) {
            .dashboard-grid {
                grid-template-columns:1fr;
            }

            .next-appointment {
                grid-template-columns:1fr;
            }

            .appointment-time {
                padding:0 0 15px;
                border-right:0;
                border-bottom:1px solid rgba(255,255,255,.07);
            }

            .panel-header {
                align-items:flex-start;
            }
        }
    </style>
@endpush


@section('content')

    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Resumen general de la actividad de la barbería.</p>
    </div>


    {{-- ESTADÍSTICAS PRINCIPALES --}}

    <div class="dashboard-grid">

        <div class="dashboard-card">

            <div class="dashboard-label">
                Citas pendientes
            </div>

            <div class="dashboard-value dashboard-accent">
                {{ $citasPendientes }}
            </div>

            <div class="dashboard-description">
                Solicitudes esperando revisión
            </div>

        </div>


        <div class="dashboard-card">

            <div class="dashboard-label">
                Citas de hoy
            </div>

            <div class="dashboard-value">
                {{ $citasHoy }}
            </div>

            <div class="dashboard-description">
                Citas activas programadas para hoy
            </div>

        </div>


        <div class="dashboard-card">

            <div class="dashboard-label">
                Confirmadas
            </div>

            <div class="dashboard-value">
                {{ $citasConfirmadas }}
            </div>

            <div class="dashboard-description">
                Citas actualmente confirmadas
            </div>

        </div>


        <div class="dashboard-card">

            <div class="dashboard-label">
                Completadas
            </div>

            <div class="dashboard-value">
                {{ $citasCompletadas }}
            </div>

            <div class="dashboard-description">
                Citas atendidas correctamente
            </div>

        </div>

    </div>


    <div class="dashboard-content-grid">

        {{-- PRÓXIMA CITA --}}

        <div class="dashboard-panel">

            <div class="panel-header">

                <div>
                    <h5>Próxima cita</h5>
                    <span>Siguiente reservación pendiente o confirmada</span>
                </div>

                <a href="{{ route('administrador.citas.index') }}"
                   class="panel-link">
                    Ver todas →
                </a>

            </div>


            @if($proximaCita)

                @php
                    $estado = $proximaCita->estadoCita?->nombre ?? 'Pendiente';

                    $claseEstado = $estado === 'Confirmada'
                        ? 'status-confirmada'
                        : 'status-pendiente';
                @endphp

                <div class="next-appointment">

                    <div class="appointment-time">

                        <strong>
                            {{ \Carbon\Carbon::parse($proximaCita->hora)->format('h:i A') }}
                        </strong>

                        <span>
                        {{ $proximaCita->fecha->format('d/m/Y') }}
                    </span>

                    </div>


                    <div class="appointment-client">

                        <strong>
                            {{ $proximaCita->nombre_cliente }}
                        </strong>

                        <span>
                        {{ $proximaCita->telefono }}
                    </span>

                        @if($proximaCita->correo)
                            <span>
                            {{ $proximaCita->correo }}
                        </span>
                        @endif

                    </div>


                    <div>

                    <span class="appointment-status {{ $claseEstado }}">
                        {{ $estado }}
                    </span>

                    </div>

                </div>

            @else

                <div class="empty-next">
                    No hay próximas citas programadas.
                </div>

            @endif

        </div>


        {{-- INFORMACIÓN GENERAL --}}

        <div class="dashboard-panel">

            <div class="panel-header">

                <div>
                    <h5>Resumen</h5>
                    <span>Información general del sistema</span>
                </div>

            </div>


            <div class="quick-list">

                <a href="{{ route('administrador.citas.index') }}"
                   class="quick-link">

                <span>
                    Total de citas
                </span>

                    <span>
                    {{ $totalCitas }}
                </span>

                </a>


                <a href="{{ route('administrador.servicios.index') }}"
                   class="quick-link">

                <span>
                    Servicios registrados
                </span>

                    <span>
                    {{ $totalServicios }}
                </span>

                </a>


                <a href="{{ route('administrador.horarios.index') }}"
                   class="quick-link">

                <span>
                    Administrar horarios
                </span>

                    <span>
                    →
                </span>

                </a>


                <a href="{{ route('inicio') }}"
                   target="_blank"
                   class="quick-link">

                <span>
                    Ver sitio público
                </span>

                    <span>
                    ↗
                </span>

                </a>

            </div>

        </div>

    </div>

@endsection
