@extends('layouts.administrador')

@section('title', 'Horarios')

@push('styles')
    <style>
        /* =========================================================
           ENCABEZADO
        ========================================================= */

        .horarios-header{
            display:flex;
            align-items:flex-end;
            justify-content:space-between;
            gap:20px;
            margin-bottom:25px;
        }

        .btn-horario-primary{
            min-height:42px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            padding:0 18px;
            border:1px solid #d5ad55;
            border-radius:100px;
            background:#d5ad55;
            color:#111;
            font-size:12px;
            font-weight:700;
            text-decoration:none;
            transition:.22s ease;
        }

        .btn-horario-primary:hover{
            border-color:#e8c873;
            background:#e8c873;
            color:#111;
            transform:translateY(-2px);
        }

        /* =========================================================
           TABLA
        ========================================================= */

        .horarios-card{
            overflow:hidden;
            border:1px solid rgba(255,255,255,.10);
            border-radius:16px;
            background:#1a1a1a;
            box-shadow:0 15px 35px rgba(0,0,0,.12);
        }

        .horarios-table{
            width:100%;
            margin:0;
            border-collapse:collapse;
            background:#1a1a1a!important;
        }

        .horarios-table thead{
            background:#171717!important;
        }

        .horarios-table th{
            padding:15px 20px;
            border-bottom:1px solid rgba(255,255,255,.10);
            background:#171717!important;
            color:#c5c5c5!important;
            font-size:10px;
            font-weight:700;
            letter-spacing:1px;
            text-transform:uppercase;
        }

        .horarios-table td{
            padding:17px 20px;
            border-bottom:1px solid rgba(255,255,255,.07);
            background:#1a1a1a!important;
            color:#e5e5e5!important;
            font-size:12px;
            vertical-align:middle;
        }

        .horarios-table tbody tr:hover td{
            background:#1d1d1d!important;
        }

        .horarios-table tbody tr:last-child td{
            border-bottom:0;
        }

        /* =========================================================
           DÍA
        ========================================================= */

        .dia-info{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .dia-icon{
            width:39px;
            height:39px;
            display:flex;
            align-items:center;
            justify-content:center;
            flex-shrink:0;
            border:1px solid rgba(255,255,255,.09);
            border-radius:10px;
            background:#202020;
            color:#ddb65a;
            font-size:15px;
        }

        .dia-data strong{
            display:block;
            color:#fff;
            font-size:13px;
            font-weight:600;
        }

        .dia-data span{
            display:block;
            margin-top:3px;
            color:#999;
            font-size:10px;
        }

        /* =========================================================
           HORAS
        ========================================================= */

        .hora-value{
            color:#f0f0f0;
            font-size:12px;
            font-weight:600;
        }

        .hora-cerrado{
            color:#888;
            font-size:11px;
        }

        /* =========================================================
           ESTADO
        ========================================================= */

        .horario-status{
            display:inline-flex;
            align-items:center;
            gap:7px;
            padding:6px 10px;
            border-radius:100px;
            font-size:10px;
            font-weight:600;
        }

        .horario-status::before{
            content:"";
            width:6px;
            height:6px;
            border-radius:50%;
            background:currentColor;
        }

        .status-abierto{
            border:1px solid rgba(95,205,145,.25);
            background:rgba(95,205,145,.10);
            color:#89d8ac;
        }

        .status-cerrado{
            border:1px solid rgba(235,110,120,.22);
            background:rgba(220,70,80,.09);
            color:#ee9ca4;
        }

        /* =========================================================
           ACCIONES
        ========================================================= */

        .horario-actions{
            display:flex;
            align-items:center;
            justify-content:flex-end;
            gap:7px;
        }

        .action-btn{
            min-height:34px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:0 11px;
            border:1px solid rgba(255,255,255,.12);
            border-radius:8px;
            background:#202020;
            color:#c2c2c2;
            font-size:10px;
            text-decoration:none;
            cursor:pointer;
            transition:.2s ease;
        }

        .action-btn:hover{
            border-color:rgba(213,173,85,.28);
            background:rgba(213,173,85,.08);
            color:#ddb65a;
        }

        .action-btn.edit{
            border-color:rgba(213,173,85,.22);
            color:#ddb65a;
        }

        .action-btn.delete{
            border-color:rgba(235,110,120,.20);
            color:#efa0a7;
        }

        .action-btn.delete:hover{
            border-color:rgba(235,110,120,.32);
            background:rgba(220,70,80,.09);
            color:#f3abb1;
        }

        /* =========================================================
           SIN REGISTROS
        ========================================================= */

        .horarios-empty-row td,
        .horarios-empty-row:hover td{
            padding:0!important;
            border:0!important;
            background:#1a1a1a!important;
        }

        .horarios-empty{
            min-height:230px;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:35px;
            background:#1a1a1a;
            text-align:center;
        }

        .horarios-empty-icon{
            width:50px;
            height:50px;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:0 auto 14px;
            border:1px solid rgba(213,173,85,.18);
            border-radius:12px;
            background:rgba(213,173,85,.07);
            color:#ddb65a;
            font-size:21px;
        }

        .horarios-empty h5{
            margin:0 0 7px;
            color:#fff;
            font-size:14px;
            font-weight:600;
        }

        .horarios-empty p{
            margin:0;
            color:#aaa;
            font-size:11px;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media(max-width:800px){
            .horarios-card{overflow-x:auto}
            .horarios-table{min-width:750px}
        }

        @media(max-width:600px){
            .horarios-header{
                align-items:flex-start;
                flex-direction:column;
            }

            .btn-horario-primary{
                width:100%;
            }
        }
    </style>
@endpush

@section('content')

    <div class="horarios-header">

        <div class="page-header mb-0">
            <h1>Horarios</h1>
            <p>Administra los días y horarios de atención de la barbería.</p>
        </div>

        <a href="{{ route('administrador.horarios.create') }}"
           class="btn-horario-primary">
            <span>＋</span>
            Nuevo horario
        </a>

    </div>

    <div class="horarios-card">

        <div class="table-responsive">

            <table class="horarios-table">

                <thead>
                <tr>
                    <th>Día</th>
                    <th>Apertura</th>
                    <th>Cierre</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @forelse($horarios as $horario)

                    @php
                        $nombreDia = match((int) $horario->dia_semana) {
                            1 => 'Lunes',
                            2 => 'Martes',
                            3 => 'Miércoles',
                            4 => 'Jueves',
                            5 => 'Viernes',
                            6 => 'Sábado',
                            7 => 'Domingo',
                            default => 'Día'
                        };
                    @endphp

                    <tr>

                        <td>

                            <div class="dia-info">

                                <div class="dia-icon">
                                    ◫
                                </div>

                                <div class="dia-data">
                                    <strong>{{ $nombreDia }}</strong>
                                    <span>Día de atención</span>
                                </div>

                            </div>

                        </td>

                        <td>

                            @if(!$horario->cerrado && $horario->hora_apertura)

                                <span class="hora-value">
                                    {{ \Carbon\Carbon::parse($horario->hora_apertura)->format('h:i A') }}
                                </span>

                            @else

                                <span class="hora-cerrado">
                                    —
                                </span>

                            @endif

                        </td>

                        <td>

                            @if(!$horario->cerrado && $horario->hora_cierre)

                                <span class="hora-value">
                                    {{ \Carbon\Carbon::parse($horario->hora_cierre)->format('h:i A') }}
                                </span>

                            @else

                                <span class="hora-cerrado">
                                    —
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($horario->cerrado)

                                <span class="horario-status status-cerrado">
                                    Cerrado
                                </span>

                            @else

                                <span class="horario-status status-abierto">
                                    Abierto
                                </span>

                            @endif

                        </td>

                        <td>

                            <div class="horario-actions">

                                <a href="{{ route('administrador.horarios.edit', $horario) }}"
                                   class="action-btn edit">
                                    Editar
                                </a>

                                <form method="POST"
                                      action="{{ route('administrador.horarios.destroy', $horario) }}"
                                      class="delete-horario-form">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn delete">
                                        Eliminar
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr class="horarios-empty-row">

                        <td colspan="5">

                            <div class="horarios-empty">

                                <div>

                                    <div class="horarios-empty-icon">
                                        ◷
                                    </div>

                                    <h5>
                                        No hay horarios registrados
                                    </h5>

                                    <p>
                                        Los horarios configurados aparecerán en esta sección.
                                    </p>

                                </div>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.delete-horario-form').forEach(form => {

                form.addEventListener('submit', event => {

                    if (!confirm('¿Estás seguro de eliminar este horario?')) {
                        event.preventDefault();
                    }

                });

            });

        });
    </script>
@endpush
