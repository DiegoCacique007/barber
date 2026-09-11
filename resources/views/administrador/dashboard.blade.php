@extends('layouts.administrador')

@section('title', 'Dashboard')

@push('styles')
    <style>
        /* =========================================================
           CABECERA
        ========================================================= */

        .dashboard-top {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 25px;
            margin-bottom: 28px;
        }

        .dashboard-top-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .dashboard-action {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 16px;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 100px;
            background: #1a1a1a;
            color: #c3c3c3;
            font-size: 11px;
            font-weight: 500;
            text-decoration: none;
            transition: .22s ease;
        }

        .dashboard-action:hover {
            border-color: rgba(213,173,85,.28);
            background: rgba(213,173,85,.07);
            color: #fff;
            transform: translateY(-2px);
        }

        .dashboard-action.primary {
            border-color: #d5ad55;
            background: #d5ad55;
            color: #111;
            font-weight: 700;
        }

        .dashboard-action.primary:hover {
            border-color: #e8c873;
            background: #e8c873;
            color: #111;
        }


        /* =========================================================
           ESTADÍSTICAS
        ========================================================= */

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 18px;
        }

        .dashboard-card {
            position: relative;
            min-height: 178px;
            overflow: hidden;
            padding: 22px;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 17px;
            background: #1a1a1a;
            box-shadow: 0 12px 30px rgba(0,0,0,.10);
            transition: transform .25s ease, border-color .25s ease, box-shadow .25s ease;
        }

        .dashboard-card:hover {
            border-color: rgba(213,173,85,.24);
            transform: translateY(-4px);
            box-shadow: 0 18px 38px rgba(0,0,0,.16);
        }

        .dashboard-card::after {
            content: "";
            position: absolute;
            top: -40px;
            right: -40px;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: rgba(213,173,85,.035);
            pointer-events: none;
        }

        .dashboard-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
        }

        .dashboard-label {
            margin-bottom: 16px;
            color: #b8b8b8;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .dashboard-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 11px;
            background: #202020;
            color: #ddb65a;
            font-size: 16px;
            transition: .22s ease;
        }

        .dashboard-card:hover .dashboard-icon {
            border-color: rgba(213,173,85,.24);
            background: rgba(213,173,85,.08);
        }

        .dashboard-value {
            color: #fff;
            font-size: 38px;
            font-weight: 700;
            line-height: 1;
            letter-spacing: -1px;
        }

        .dashboard-value.dashboard-accent {
            color: #ddb65a;
        }

        .dashboard-description {
            margin-top: 9px;
            color: #a0a0a0;
            font-size: 11px;
            line-height: 1.5;
        }

        .dashboard-progress {
            height: 4px;
            margin-top: 20px;
            overflow: hidden;
            border-radius: 20px;
            background: rgba(255,255,255,.08);
        }

        .dashboard-progress span {
            display: block;
            width: var(--progress);
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg,#a98235,#d5ad55,#e8c873);
            transition: width 1s ease;
        }


        /* =========================================================
           CONTENIDO PRINCIPAL
        ========================================================= */

        .dashboard-content-grid {
            display: grid;
            grid-template-columns: 1.4fr .6fr;
            gap: 20px;
            margin-top: 22px;
        }

        .dashboard-panel {
            padding: 25px;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 17px;
            background: #1a1a1a;
            box-shadow: 0 12px 30px rgba(0,0,0,.10);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .panel-header h5 {
            margin: 0;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
        }

        .panel-header p {
            margin: 5px 0 0;
            color: #a0a0a0;
            font-size: 11px;
        }

        .panel-link {
            color: #ddb65a;
            font-size: 11px;
            font-weight: 500;
            text-decoration: none;
            transition: .2s ease;
        }

        .panel-link:hover {
            color: #e8c873;
        }


        /* =========================================================
           PRÓXIMA CITA
        ========================================================= */

        .next-appointment {
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 22px;
            padding: 21px;
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 14px;
            background: #171717;
            transition: .22s ease;
        }

        .next-appointment:hover {
            border-color: rgba(213,173,85,.22);
            background: #191919;
        }

        .appointment-time {
            min-width: 105px;
            padding-right: 22px;
            border-right: 1px solid rgba(255,255,255,.10);
        }

        .appointment-time strong {
            display: block;
            color: #fff;
            font-size: 20px;
            font-weight: 700;
        }

        .appointment-time span {
            display: block;
            margin-top: 5px;
            color: #aaa;
            font-size: 10px;
        }

        .appointment-client strong {
            display: block;
            color: #f0f0f0;
            font-size: 14px;
            font-weight: 600;
        }

        .appointment-client span {
            display: block;
            margin-top: 5px;
            color: #aaa;
            font-size: 11px;
        }

        .appointment-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
        }

        .appointment-status::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-pendiente {
            border: 1px solid rgba(221,182,90,.22);
            background: rgba(221,182,90,.09);
            color: #e0b85d;
        }

        .status-confirmada {
            border: 1px solid rgba(121,169,230,.23);
            background: rgba(121,169,230,.09);
            color: #90b9eb;
        }

        .appointment-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 14px;
        }

        .appointment-footer span {
            color: #999;
            font-size: 10px;
        }

        .appointment-button {
            color: #bbb;
            font-size: 11px;
            text-decoration: none;
            transition: .2s ease;
        }

        .appointment-button:hover {
            color: #ddb65a;
        }

        .empty-next {
            padding: 36px 20px;
            border: 1px dashed rgba(255,255,255,.11);
            border-radius: 14px;
            background: #171717;
            color: #aaa;
            text-align: center;
            font-size: 12px;
        }

        .empty-next-icon {
            display: block;
            margin-bottom: 10px;
            color: #ddb65a;
            font-size: 24px;
        }


        /* =========================================================
           MINI RESUMEN
        ========================================================= */

        .dashboard-mini-grid {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .dashboard-mini-card {
            padding: 18px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 13px;
            background: #171717;
            transition: .22s ease;
        }

        .dashboard-mini-card:hover {
            border-color: rgba(213,173,85,.20);
            background: #191919;
        }

        .mini-label {
            color: #aaa;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .mini-value {
            margin-top: 8px;
            color: #fff;
            font-size: 20px;
            font-weight: 700;
        }

        .mini-value span {
            color: #ddb65a;
        }

        .mini-description {
            margin-top: 5px;
            color: #999;
            font-size: 10px;
            line-height: 1.4;
        }


        /* =========================================================
           ACCESOS RÁPIDOS
        ========================================================= */

        .quick-list {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .quick-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 13px 14px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 10px;
            background: #171717;
            color: #c1c1c1;
            font-size: 11px;
            text-decoration: none;
            transition: .2s ease;
        }

        .quick-link:hover {
            border-color: rgba(213,173,85,.22);
            background: rgba(213,173,85,.06);
            color: #fff;
            transform: translateX(2px);
        }

        .quick-link-left {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .quick-icon {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 8px;
            background: #202020;
            color: #aaa;
            font-size: 12px;
        }

        .quick-link:hover .quick-icon {
            background: rgba(213,173,85,.10);
            color: #ddb65a;
        }

        .quick-value {
            color: #ddb65a;
            font-weight: 700;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media(max-width:1200px) {
            .dashboard-grid {
                grid-template-columns: repeat(2,1fr);
            }

            .dashboard-content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:800px) {
            .dashboard-top {
                align-items: flex-start;
                flex-direction: column;
            }

            .dashboard-mini-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:650px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-card {
                min-height: 160px;
            }

            .next-appointment {
                grid-template-columns: 1fr;
            }

            .appointment-time {
                padding: 0 0 15px;
                border-right: 0;
                border-bottom: 1px solid rgba(255,255,255,.10);
            }

            .panel-header {
                align-items: flex-start;
            }

            .appointment-status {
                width: fit-content;
            }

            .dashboard-top-actions {
                width: 100%;
            }

            .dashboard-action {
                flex: 1;
            }
        }

        @media(max-width:450px) {
            .dashboard-top-actions {
                flex-direction: column;
            }

            .dashboard-action {
                width: 100%;
            }

            .appointment-footer {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
@endpush


@section('content')

    @php
        $baseTotal = max($totalCitas,1);

        $porcentajePendientes = min(100,round(($citasPendientes / $baseTotal) * 100));
        $porcentajeHoy = min(100,round(($citasHoy / $baseTotal) * 100));
        $porcentajeConfirmadas = min(100,round(($citasConfirmadas / $baseTotal) * 100));
        $porcentajeCompletadas = min(100,round(($citasCompletadas / $baseTotal) * 100));

        $citasActivas = $citasPendientes + $citasConfirmadas;

        $tasaCompletadas = $totalCitas > 0
            ? round(($citasCompletadas / $totalCitas) * 100)
            : 0;
    @endphp


    {{-- =========================================================
         CABECERA
    ========================================================= --}}

    <div class="dashboard-top">

        <div class="page-header mb-0">

            <h1>
                Dashboard
            </h1>

            <p>
                Resumen general y actividad reciente de la barbería.
            </p>

        </div>


        <div class="dashboard-top-actions">

            <a href="{{ route('administrador.citas.create') }}"
               class="dashboard-action primary">

                <span>＋</span>
                Nueva cita

            </a>


            <a href="{{ route('administrador.servicios.create') }}"
               class="dashboard-action">

                <span>✂</span>
                Nuevo servicio

            </a>


            <a href="{{ route('inicio') }}"
               target="_blank"
               rel="noopener noreferrer"
               class="dashboard-action">

                <span>↗</span>
                Ver sitio

            </a>

        </div>

    </div>


    {{-- =========================================================
         ESTADÍSTICAS
    ========================================================= --}}

    <div class="dashboard-grid">

        <div class="dashboard-card">

            <div class="dashboard-card-top">

                <div>

                    <div class="dashboard-label">
                        Citas pendientes
                    </div>

                    <div class="dashboard-value dashboard-accent counter"
                         data-count="{{ $citasPendientes }}">
                        0
                    </div>

                    <div class="dashboard-description">
                        Solicitudes esperando revisión
                    </div>

                </div>

                <div class="dashboard-icon">
                    ◷
                </div>

            </div>

            <div class="dashboard-progress">
                <span style="--progress:{{ $porcentajePendientes }}%;"></span>
            </div>

        </div>


        <div class="dashboard-card">

            <div class="dashboard-card-top">

                <div>

                    <div class="dashboard-label">
                        Citas de hoy
                    </div>

                    <div class="dashboard-value counter"
                         data-count="{{ $citasHoy }}">
                        0
                    </div>

                    <div class="dashboard-description">
                        Citas activas programadas para hoy
                    </div>

                </div>

                <div class="dashboard-icon">
                    ◉
                </div>

            </div>

            <div class="dashboard-progress">
                <span style="--progress:{{ $porcentajeHoy }}%;"></span>
            </div>

        </div>


        <div class="dashboard-card">

            <div class="dashboard-card-top">

                <div>

                    <div class="dashboard-label">
                        Confirmadas
                    </div>

                    <div class="dashboard-value counter"
                         data-count="{{ $citasConfirmadas }}">
                        0
                    </div>

                    <div class="dashboard-description">
                        Reservaciones listas para atender
                    </div>

                </div>

                <div class="dashboard-icon">
                    ✓
                </div>

            </div>

            <div class="dashboard-progress">
                <span style="--progress:{{ $porcentajeConfirmadas }}%;"></span>
            </div>

        </div>


        <div class="dashboard-card">

            <div class="dashboard-card-top">

                <div>

                    <div class="dashboard-label">
                        Completadas
                    </div>

                    <div class="dashboard-value counter"
                         data-count="{{ $citasCompletadas }}">
                        0
                    </div>

                    <div class="dashboard-description">
                        Citas atendidas correctamente
                    </div>

                </div>

                <div class="dashboard-icon">
                    ✓
                </div>

            </div>

            <div class="dashboard-progress">
                <span style="--progress:{{ $porcentajeCompletadas }}%;"></span>
            </div>

        </div>

    </div>


    {{-- =========================================================
         CONTENIDO INFERIOR
    ========================================================= --}}

    <div class="dashboard-content-grid">

        {{-- PRÓXIMA CITA --}}

        <div class="dashboard-panel">

            <div class="panel-header">

                <div>

                    <h5>
                        Próxima cita
                    </h5>

                    <p>
                        Siguiente reservación pendiente o confirmada
                    </p>

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


                    <span class="appointment-status {{ $claseEstado }}">
                    {{ $estado }}
                </span>

                </div>


                <div class="appointment-footer">

                <span>
                    Próxima reservación registrada
                </span>

                    <a href="{{ route('administrador.citas.show',$proximaCita) }}"
                       class="appointment-button">

                        Ver detalles →

                    </a>

                </div>

            @else

                <div class="empty-next">

                <span class="empty-next-icon">
                    ◷
                </span>

                    No hay próximas citas programadas.

                </div>

            @endif


            {{-- MINI RESUMEN --}}

            <div class="dashboard-mini-grid">

                <div class="dashboard-mini-card">

                    <div class="mini-label">
                        Citas activas
                    </div>

                    <div class="mini-value">
                        {{ $citasActivas }}
                    </div>

                    <div class="mini-description">
                        Pendientes + confirmadas
                    </div>

                </div>


                <div class="dashboard-mini-card">

                    <div class="mini-label">
                        Tasa completada
                    </div>

                    <div class="mini-value">
                        {{ $tasaCompletadas }}<span>%</span>
                    </div>

                    <div class="mini-description">
                        Respecto al total registrado
                    </div>

                </div>


                <div class="dashboard-mini-card">

                    <div class="mini-label">
                        Redes activas
                    </div>

                    <div class="mini-value">
                        {{ $redesActivas }}
                    </div>

                    <div class="mini-description">
                        Visibles en el sitio público
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             ACCESOS RÁPIDOS
        ========================================================= --}}

        <div class="dashboard-panel">

            <div class="panel-header">

                <div>

                    <h5>
                        Accesos rápidos
                    </h5>

                    <p>
                        Administra las principales áreas
                    </p>

                </div>

            </div>


            <div class="quick-list">

                <a href="{{ route('administrador.citas.index') }}"
                   class="quick-link">

                    <div class="quick-link-left">

                    <span class="quick-icon">
                        ◷
                    </span>

                        <span>
                        Total de citas
                    </span>

                    </div>

                    <span class="quick-value">
                    {{ $totalCitas }}
                </span>

                </a>


                <a href="{{ route('administrador.servicios.index') }}"
                   class="quick-link">

                    <div class="quick-link-left">

                    <span class="quick-icon">
                        ✂
                    </span>

                        <span>
                        Servicios
                    </span>

                    </div>

                    <span class="quick-value">
                    {{ $totalServicios }}
                </span>

                </a>


                <a href="{{ route('administrador.horarios.index') }}"
                   class="quick-link">

                    <div class="quick-link-left">

                    <span class="quick-icon">
                        ◫
                    </span>

                        <span>
                        Horarios
                    </span>

                    </div>

                    <span class="quick-value">
                    →
                </span>

                </a>


                <a href="{{ route('administrador.redes.index') }}"
                   class="quick-link">

                    <div class="quick-link-left">

                    <span class="quick-icon">
                        ◎
                    </span>

                        <span>
                        Redes sociales
                    </span>

                    </div>

                    <span class="quick-value">
                    {{ $redesActivas }}
                </span>

                </a>


                <a href="{{ route('administrador.configuracion.edit') }}"
                   class="quick-link">

                    <div class="quick-link-left">

                    <span class="quick-icon">
                        ⚙
                    </span>

                        <span>
                        Configuración
                    </span>

                    </div>

                    <span class="quick-value">
                    →
                </span>

                </a>


                <a href="{{ route('inicio') }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="quick-link">

                    <div class="quick-link-left">

                    <span class="quick-icon">
                        ↗
                    </span>

                        <span>
                        Sitio público
                    </span>

                    </div>

                    <span class="quick-value">
                    ↗
                </span>

                </a>

            </div>

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const counters = document.querySelectorAll('.counter');

            const iniciarContador = counter => {
                const target = Number(counter.dataset.count || 0);
                const duration = 650;
                const start = performance.now();

                const animar = now => {
                    const progress = Math.min((now - start) / duration,1);

                    counter.textContent = Math.floor(target * progress);

                    if (progress < 1) {
                        requestAnimationFrame(animar);
                    } else {
                        counter.textContent = target;
                    }
                };

                requestAnimationFrame(animar);
            };

            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver(entries => {

                    entries.forEach(entry => {

                        if (!entry.isIntersecting) return;

                        iniciarContador(entry.target);
                        observer.unobserve(entry.target);

                    });

                },{
                    threshold:.35
                });

                counters.forEach(counter => observer.observe(counter));

            } else {
                counters.forEach(iniciarContador);
            }

        });
    </script>
@endpush
