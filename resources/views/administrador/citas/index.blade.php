@extends('layouts.administrador')

@section('title', 'Citas')

@push('styles')
    <style>
        .citas-header{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:25px}

        .btn-cita-primary{min-height:42px;display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:0 18px;border:1px solid #d5ad55;border-radius:100px;background:#d5ad55;color:#111;font-size:12px;font-weight:700;text-decoration:none;transition:.22s ease}
        .btn-cita-primary:hover{border-color:#e8c873;background:#e8c873;color:#111;transform:translateY(-2px)}

        .filters-card{margin-bottom:22px;padding:20px;border:1px solid rgba(255,255,255,.10);border-radius:16px;background:#1a1a1a}
        .filters-grid{display:grid;grid-template-columns:1.35fr 1fr 1fr auto;gap:15px}

        .filter-control{width:100%;min-height:42px;padding:0 13px;border:1px solid rgba(255,255,255,.13);border-radius:9px;outline:none;background:#171717;color:#fff;font-size:12px;color-scheme:dark;transition:.2s}
        .filter-control::placeholder{color:#8f8f8f}
        .filter-control:focus{border-color:#d5ad55;background:#191919;box-shadow:0 0 0 .2rem rgba(213,173,85,.07)}
        .filter-control option{background:#1a1a1a;color:#fff}

        .btn-filter{min-width:150px;min-height:42px;padding:0 22px;border:1px solid #d5ad55;border-radius:9px;background:#d5ad55;color:#111;font-size:12px;font-weight:700;cursor:pointer;transition:.2s}
        .btn-filter:hover{border-color:#e8c873;background:#e8c873}

        .filter-clear-wrapper{display:flex;justify-content:flex-end;margin-top:12px}
        .filter-clear{color:#aaa;font-size:11px;text-decoration:none;transition:.2s}
        .filter-clear:hover{color:#ddb65a}

        .citas-card{overflow:hidden;border:1px solid rgba(255,255,255,.10);border-radius:16px;background:#1a1a1a;box-shadow:0 15px 35px rgba(0,0,0,.12)}

        .citas-table{width:100%;margin:0;border-collapse:collapse;background:#1a1a1a!important}
        .citas-table thead{background:#171717!important}

        .citas-table th{padding:15px 18px;border-bottom:1px solid rgba(255,255,255,.10);background:#171717!important;color:#c5c5c5!important;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase}

        .citas-table td{padding:17px 18px;border-bottom:1px solid rgba(255,255,255,.07);background:#1a1a1a!important;color:#e5e5e5!important;font-size:12px;vertical-align:middle}

        .citas-table tbody tr:hover td{background:#1d1d1d!important}
        .citas-table tbody tr:last-child td{border-bottom:0}

        .cliente-info strong,.contact-info strong,.fecha-info strong{display:block;color:#fff;font-size:12px;font-weight:600}
        .cliente-info span,.contact-info span,.fecha-info span{display:block;margin-top:4px;color:#aaa;font-size:10px}

        .estado-cita{display:inline-flex;align-items:center;gap:7px;padding:6px 10px;border-radius:100px;font-size:10px;font-weight:600;white-space:nowrap}
        .estado-cita::before{content:"";width:6px;height:6px;border-radius:50%;background:currentColor}

        .estado-pendiente{border:1px solid rgba(221,182,90,.25);background:rgba(221,182,90,.10);color:#e4bd62}
        .estado-confirmada{border:1px solid rgba(100,160,235,.25);background:rgba(100,160,235,.10);color:#8db9ee}
        .estado-completada{border:1px solid rgba(95,205,145,.25);background:rgba(95,205,145,.10);color:#89d8ac}
        .estado-cancelada{border:1px solid rgba(235,110,120,.25);background:rgba(220,70,80,.10);color:#ee9ca4}
        .estado-rechazada{border:1px solid rgba(190,130,140,.25);background:rgba(190,130,140,.10);color:#d8a4ac}

        .cita-actions{display:flex;align-items:center;justify-content:flex-end;flex-wrap:wrap;gap:6px}

        .action-btn{min-height:33px;display:inline-flex;align-items:center;justify-content:center;padding:0 10px;border:1px solid rgba(255,255,255,.12);border-radius:8px;background:#202020;color:#c2c2c2;font-size:10px;font-weight:500;text-decoration:none;cursor:pointer;white-space:nowrap;transition:.2s}
        .action-btn:hover{border-color:rgba(213,173,85,.28);background:rgba(213,173,85,.08);color:#ddb65a}

        .action-success{border-color:rgba(95,205,145,.20);color:#89d8ac}
        .action-success:hover{border-color:rgba(95,205,145,.35);background:rgba(95,205,145,.08);color:#9ae4bc}

        .action-danger{border-color:rgba(235,110,120,.20);color:#efa0a7}
        .action-danger:hover{border-color:rgba(235,110,120,.32);background:rgba(220,70,80,.09);color:#f3abb1}

        .citas-empty-row td,.citas-empty-row:hover td{padding:0!important;border:0!important;background:#1a1a1a!important}

        .citas-empty{min-height:230px;display:flex;align-items:center;justify-content:center;padding:35px;background:#1a1a1a;text-align:center}
        .citas-empty-icon{width:50px;height:50px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;border:1px solid rgba(213,173,85,.18);border-radius:12px;background:rgba(213,173,85,.07);color:#ddb65a;font-size:21px}
        .citas-empty h5{margin:0 0 7px;color:#fff;font-size:14px;font-weight:600}
        .citas-empty p{margin:0;color:#aaa;font-size:11px}

        .citas-pagination{padding:15px 20px;border-top:1px solid rgba(255,255,255,.07);background:#181818}

        @media(max-width:1200px){
            .filters-grid{grid-template-columns:1fr 1fr}
            .btn-filter{width:100%}
        }

        @media(max-width:850px){
            .citas-card{overflow-x:auto}
            .citas-table{min-width:1050px}
        }

        @media(max-width:650px){
            .citas-header{align-items:flex-start;flex-direction:column}
            .btn-cita-primary{width:100%}
            .filters-grid{grid-template-columns:1fr}
            .btn-filter{min-width:100%}
        }
    </style>
@endpush

@section('content')

    <div class="citas-header">

        <div class="page-header mb-0">
            <h1>Citas</h1>
            <p>Consulta y administra las reservaciones realizadas por los clientes.</p>
        </div>

        <a href="{{ route('administrador.citas.create') }}"
           class="btn-cita-primary">
            <span>＋</span>
            Nueva cita
        </a>

    </div>

    <div class="filters-card">

        <form method="GET"
              action="{{ route('administrador.citas.index') }}">

            <div class="filters-grid">

                <input type="text"
                       name="buscar"
                       value="{{ request('buscar') }}"
                       class="filter-control"
                       placeholder="Buscar cliente, teléfono...">

                <select name="estado"
                        class="filter-control">

                    <option value="">Todos los estados</option>

                    @foreach($estados as $estado)
                        <option value="{{ $estado->id }}"
                            {{ request('estado') == $estado->id ? 'selected' : '' }}>
                            {{ $estado->nombre }}
                        </option>
                    @endforeach

                </select>

                <input type="date"
                       name="fecha"
                       value="{{ request('fecha') }}"
                       class="filter-control">

                <button type="submit"
                        class="btn-filter">
                    Filtrar
                </button>

            </div>

            @if(request()->filled('buscar') || request()->filled('estado') || request()->filled('fecha'))

                <div class="filter-clear-wrapper">

                    <a href="{{ route('administrador.citas.index') }}"
                       class="filter-clear">
                        × Limpiar filtros
                    </a>

                </div>

            @endif

        </form>

    </div>

    <div class="citas-card">

        <div class="table-responsive">

            <table class="citas-table">

                <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Contacto</th>
                    <th>Fecha y hora</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @forelse($citas as $cita)

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

                    <tr>

                        <td>
                            <div class="cliente-info">
                                <strong>{{ $cita->nombre_cliente }}</strong>
                                <span>#{{ str_pad($cita->id,4,'0',STR_PAD_LEFT) }}</span>
                            </div>
                        </td>

                        <td>
                            <div class="fecha-info">
                                <strong>{{ $cita->fecha->format('d/m/Y') }}</strong>
                                <span>{{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}</span>
                            </div>
                        </td>

                        <td>
                            <span class="estado-cita {{ $estadoClase }}">
                                {{ $estadoNombre }}
                            </span>
                        </td>

                        <td>

                            <div class="cita-actions">

                                @if($estadoNombre === 'Pendiente')

                                    <form method="POST"
                                          action="{{ route('administrador.citas.estado',$cita) }}">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden"
                                               name="estado"
                                               value="Confirmada">

                                        <button type="submit"
                                                class="action-btn action-success">
                                            ✓ Confirmar
                                        </button>
                                    </form>

                                    <form method="POST"
                                          action="{{ route('administrador.citas.estado',$cita) }}">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden"
                                               name="estado"
                                               value="Rechazada">

                                        <button type="submit"
                                                class="action-btn action-danger">
                                            Rechazar
                                        </button>
                                    </form>

                                @elseif($estadoNombre === 'Confirmada')

                                    <form method="POST"
                                          action="{{ route('administrador.citas.estado',$cita) }}">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden"
                                               name="estado"
                                               value="Completada">

                                        <button type="submit"
                                                class="action-btn action-success">
                                            ✓ Completar
                                        </button>
                                    </form>

                                    <form method="POST"
                                          action="{{ route('administrador.citas.estado',$cita) }}">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden"
                                               name="estado"
                                               value="Cancelada">

                                        <button type="submit"
                                                class="action-btn action-danger">
                                            Cancelar
                                        </button>
                                    </form>

                                @endif

                                <a href="{{ route('administrador.citas.show',$cita) }}"
                                   class="action-btn">
                                    Ver
                                </a>

                                <a href="{{ route('administrador.citas.edit',$cita) }}"
                                   class="action-btn">
                                    Editar
                                </a>

                                <form method="POST"
                                      action="{{ route('administrador.citas.destroy',$cita) }}"
                                      class="delete-cita-form">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn action-danger">
                                        Eliminar
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr class="citas-empty-row">

                        <td colspan="5">

                            <div class="citas-empty">

                                <div>

                                    <div class="citas-empty-icon">◷</div>

                                    <h5>No hay citas registradas</h5>

                                    <p>
                                        Las reservaciones aparecerán aquí cuando sean registradas.
                                    </p>

                                </div>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($citas->hasPages())
            <div class="citas-pagination">
                {{ $citas->links() }}
            </div>
        @endif

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.delete-cita-form').forEach(form => {

                form.addEventListener('submit', event => {

                    if (!confirm('¿Estás seguro de eliminar esta cita?')) {
                        event.preventDefault();
                    }

                });

            });

        });
    </script>
@endpush
