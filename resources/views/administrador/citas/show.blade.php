@extends('layouts.administrador')

@section('title', 'Detalle de cita')

@push('styles')
    <style>
        .cita-show-header{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:25px}

        .cita-header-actions{display:flex;gap:9px}

        .btn-show-secondary,.btn-show-primary{min-height:40px;display:inline-flex;align-items:center;justify-content:center;padding:0 16px;border-radius:9px;font-size:11px;font-weight:600;text-decoration:none;transition:.2s}

        .btn-show-secondary{border:1px solid rgba(255,255,255,.14);background:#1a1a1a;color:#bbb}
        .btn-show-secondary:hover{border-color:rgba(213,173,85,.25);color:#fff}

        .btn-show-primary{border:1px solid #d5ad55;background:#d5ad55;color:#111}
        .btn-show-primary:hover{border-color:#e8c873;background:#e8c873;color:#111}

        .cita-show-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}

        .cita-info-card{padding:25px;border:1px solid rgba(255,255,255,.10);border-radius:16px;background:#1a1a1a;box-shadow:0 15px 35px rgba(0,0,0,.10)}

        .cita-card-header{display:flex;align-items:center;gap:12px;margin-bottom:20px;padding-bottom:18px;border-bottom:1px solid rgba(255,255,255,.07)}

        .cita-card-icon{width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid rgba(213,173,85,.18);border-radius:10px;background:rgba(213,173,85,.07);color:#ddb65a;font-size:16px}

        .cita-card-header h5{margin:0;color:#fff;font-size:14px;font-weight:600}
        .cita-card-header p{margin:4px 0 0;color:#999;font-size:10px}

        .cita-data{padding:14px 0;border-bottom:1px solid rgba(255,255,255,.06)}
        .cita-data:first-of-type{padding-top:0}
        .cita-data:last-child{padding-bottom:0;border-bottom:0}

        .cita-data-label{display:block;margin-bottom:6px;color:#aaa;font-size:10px;font-weight:600;letter-spacing:.3px}

        .cita-data-value{color:#fff;font-size:13px;font-weight:500;line-height:1.6}

        .cita-date-highlight{color:#fff;font-size:21px;font-weight:700}

        .cita-time{display:block;margin-top:4px;color:#ddb65a;font-size:13px;font-weight:600}

        .estado-cita{display:inline-flex;align-items:center;gap:7px;padding:7px 11px;border-radius:100px;font-size:10px;font-weight:600}
        .estado-cita::before{content:"";width:6px;height:6px;border-radius:50%;background:currentColor}

        .estado-pendiente{border:1px solid rgba(221,182,90,.25);background:rgba(221,182,90,.10);color:#e4bd62}
        .estado-confirmada{border:1px solid rgba(100,160,235,.25);background:rgba(100,160,235,.10);color:#8db9ee}
        .estado-completada{border:1px solid rgba(95,205,145,.25);background:rgba(95,205,145,.10);color:#89d8ac}
        .estado-cancelada{border:1px solid rgba(235,110,120,.25);background:rgba(220,70,80,.10);color:#ee9ca4}
        .estado-rechazada{border:1px solid rgba(190,130,140,.25);background:rgba(190,130,140,.10);color:#d8a4ac}

        @media(max-width:850px){
            .cita-show-grid{grid-template-columns:1fr}
        }

        @media(max-width:600px){
            .cita-show-header{align-items:flex-start;flex-direction:column}
            .cita-header-actions{width:100%}
            .btn-show-secondary,.btn-show-primary{flex:1}
            .cita-info-card{padding:20px}
        }
    </style>
@endpush

@section('content')

    @php
        $estadoNombre = $cita->estadoCita?->nombre ?? 'Pendiente';

        $estadoClase = match($estadoNombre) {
            'Confirmada' => 'estado-confirmada',
            'Completada' => 'estado-completada',
            'Cancelada' => 'estado-cancelada',
            'Rechazada' => 'estado-rechazada',
            default => 'estado-pendiente'
        };
    @endphp


    <div class="cita-show-header">

        <div class="page-header mb-0">

            <h1>
                Cita #{{ str_pad($cita->id,4,'0',STR_PAD_LEFT) }}
            </h1>

            <p>
                Información completa de la reservación.
            </p>

        </div>


        <div class="cita-header-actions">

            <a href="{{ route('administrador.citas.index') }}"
               class="btn-show-secondary">
                Volver
            </a>

            <a href="{{ route('administrador.citas.edit',$cita) }}"
               class="btn-show-primary">
                Editar
            </a>

        </div>

    </div>


    <div class="cita-show-grid">

        {{-- CLIENTE --}}

        <div class="cita-info-card">

            <div class="cita-card-header">

                <div class="cita-card-icon">
                    ♙
                </div>

                <div>
                    <h5>Información del cliente</h5>
                    <p>Datos registrados para la reservación</p>
                </div>

            </div>


            <div class="cita-data">

            <span class="cita-data-label">
                Nombre
            </span>

                <div class="cita-data-value">
                    {{ $cita->nombre_cliente }}
                </div>

            </div>


            <div class="cita-data">

            <span class="cita-data-label">
                Teléfono
            </span>

                <div class="cita-data-value">
                    {{ $cita->telefono }}
                </div>

            </div>


        </div>


        {{-- RESERVACIÓN --}}

        <div class="cita-info-card">

            <div class="cita-card-header">

                <div class="cita-card-icon">
                    ◷
                </div>

                <div>
                    <h5>Reservación</h5>
                    <p>Fecha, hora y estado actual</p>
                </div>

            </div>


            <div class="cita-data">

            <span class="cita-data-label">
                Fecha y hora
            </span>

                <div class="cita-date-highlight">
                    {{ $cita->fecha->format('d/m/Y') }}
                </div>

                <span class="cita-time">
                {{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}
            </span>

            </div>


            <div class="cita-data">

            <span class="cita-data-label">
                Estado
            </span>

                <span class="estado-cita {{ $estadoClase }}">
                {{ $estadoNombre }}
            </span>

            </div>


            <div class="cita-data">

            <span class="cita-data-label">
                Registrada
            </span>

                <div class="cita-data-value">
                    {{ $cita->created_at?->format('d/m/Y h:i A') }}
                </div>

            </div>

        </div>

    </div>

@endsection
