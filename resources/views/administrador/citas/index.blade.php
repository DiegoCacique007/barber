@extends('layouts.administrador')

@section('title', 'Citas')

@push('styles')
    <style>
        .citas-header{display:flex;justify-content:space-between;align-items:center;gap:20px;margin-bottom:25px}
        .citas-header h1{margin:0;font-size:30px;font-weight:700}
        .citas-header p{margin:6px 0 0;color:#777;font-size:13px}

        .filters-card{padding:20px;margin-bottom:22px;border:1px solid rgba(255,255,255,.07);border-radius:16px;background:#131313}
        .filters-card .form-control,.filters-card .form-select{background:#0e0e0e!important;border-color:rgba(255,255,255,.08)!important;color:#ddd!important}
        .filters-card .form-control::placeholder{color:#555}

        .table-card{overflow:hidden;border:1px solid rgba(255,255,255,.07);border-radius:16px;background:#131313}
        .citas-table{margin:0;color:#ddd;vertical-align:middle}
        .citas-table thead th{padding:15px 18px;border-bottom:1px solid rgba(255,255,255,.08);background:#101010;color:#666;font-size:10px;font-weight:600;letter-spacing:1px;text-transform:uppercase}
        .citas-table tbody td{padding:16px 18px;border-color:rgba(255,255,255,.05)}
        .citas-table tbody tr{transition:.2s}
        .citas-table tbody tr:hover{background:rgba(255,255,255,.018)}

        .cliente-nombre{display:block;color:#eee;font-size:14px;font-weight:600}
        .cliente-dato{display:block;margin-top:3px;color:#666;font-size:11px}
        .fecha-principal{display:block;color:#d7d7d7;font-size:13px;font-weight:600}
        .hora-cita{display:block;margin-top:3px;color:#777;font-size:11px}

        .estado-badge{display:inline-flex;align-items:center;gap:6px;padding:6px 10px;border:1px solid;border-radius:100px;font-size:10px;font-weight:600}
        .estado-badge::before{content:"";width:6px;height:6px;border-radius:50%;background:currentColor}
        .estado-pendiente{color:#e0b95d;background:rgba(224,185,93,.07);border-color:rgba(224,185,93,.18)}
        .estado-confirmada{color:#74a8e8;background:rgba(116,168,232,.07);border-color:rgba(116,168,232,.18)}
        .estado-completada{color:#79c999;background:rgba(121,201,153,.07);border-color:rgba(121,201,153,.18)}
        .estado-cancelada{color:#9b9b9b;background:rgba(155,155,155,.06);border-color:rgba(155,155,155,.15)}
        .estado-rechazada{color:#e47d86;background:rgba(228,125,134,.07);border-color:rgba(228,125,134,.18)}

        .acciones{display:flex;align-items:center;justify-content:flex-end;flex-wrap:wrap;gap:6px}
        .accion-btn{min-height:31px;display:inline-flex;align-items:center;justify-content:center;padding:0 11px;border:1px solid rgba(255,255,255,.08);border-radius:8px;background:transparent;color:#888;font-size:10px;transition:.2s}
        .accion-btn:hover{color:#fff;background:rgba(255,255,255,.05)}
        .accion-confirmar{color:#c9a24d;border-color:rgba(201,162,77,.22)}
        .accion-confirmar:hover{background:rgba(201,162,77,.1);color:#e2c36e}
        .accion-completar{color:#79c999;border-color:rgba(121,201,153,.2)}
        .accion-completar:hover{background:rgba(121,201,153,.08);color:#9bdfb5}
        .accion-peligro{color:#d77a82;border-color:rgba(215,122,130,.18)}
        .accion-peligro:hover{background:rgba(215,122,130,.08);color:#ef9299}

        .empty-citas{padding:65px 20px;text-align:center;color:#666}
        .empty-citas span{display:block;margin-bottom:10px;font-size:32px;color:#333}

        .pagination-wrapper{padding:18px;border-top:1px solid rgba(255,255,255,.05)}

        @media(max-width:768px){
            .citas-header{align-items:flex-start;flex-direction:column}
            .citas-header .btn{width:100%}
        }
    </style>
@endpush


@section('content')

    <div class="citas-header">

        <div>
            <h1>Citas</h1>
            <p>Consulta y administra las reservaciones realizadas por los clientes.</p>
        </div>

        <a href="{{ route('administrador.citas.create') }}"
           class="btn btn-warning rounded-pill px-4">
            + Nueva cita
        </a>

    </div>


    <div class="filters-card">

        <form method="GET"
              action="{{ route('administrador.citas.index') }}"
              class="row g-3">

            <div class="col-lg-4">

                <input
                    type="text"
                    name="buscar"
                    value="{{ request('buscar') }}"
                    class="form-control"
                    placeholder="Buscar cliente, teléfono o correo..."
                >

            </div>


            <div class="col-md-3">

                <select name="estado"
                        class="form-select">

                    <option value="">
                        Todos los estados
                    </option>

                    @foreach($estados as $estado)

                        <option value="{{ $estado->id }}"
                            @selected(request('estado') == $estado->id)>

                            {{ $estado->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>


            <div class="col-md-3">

                <input
                    type="date"
                    name="fecha"
                    value="{{ request('fecha') }}"
                    class="form-control"
                >

            </div>


            <div class="col-lg-2 d-flex gap-2">

                <button class="btn btn-warning flex-grow-1">
                    Filtrar
                </button>

                @if(request()->hasAny(['buscar', 'estado', 'fecha']))

                    <a href="{{ route('administrador.citas.index') }}"
                       class="btn btn-outline-secondary">
                        ×
                    </a>

                @endif

            </div>

        </form>

    </div>


    <div class="table-card">

        <div class="table-responsive">

            <table class="table citas-table">

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
                        $estado = $cita->estadoCita?->nombre ?? 'Sin estado';

                        $claseEstado = match($estado) {
                            'Pendiente' => 'estado-pendiente',
                            'Confirmada' => 'estado-confirmada',
                            'Completada' => 'estado-completada',
                            'Cancelada' => 'estado-cancelada',
                            'Rechazada' => 'estado-rechazada',
                            default => 'estado-cancelada'
                        };
                    @endphp


                    <tr>

                        <td>

                            <span class="cliente-nombre">
                                {{ $cita->nombre_cliente }}
                            </span>

                            <span class="cliente-dato">
                                #{{ str_pad($cita->id, 4, '0', STR_PAD_LEFT) }}
                            </span>

                        </td>


                        <td>

                            <span class="cliente-nombre">
                                {{ $cita->telefono }}
                            </span>

                            <span class="cliente-dato">
                                {{ $cita->correo ?: 'Sin correo' }}
                            </span>

                        </td>


                        <td>

                            <span class="fecha-principal">
                                {{ $cita->fecha->translatedFormat('d M Y') }}
                            </span>

                            <span class="hora-cita">
                                {{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}
                            </span>

                        </td>


                        <td>

                            <span class="estado-badge {{ $claseEstado }}">
                                {{ $estado }}
                            </span>

                        </td>


                        <td>

                            <div class="acciones">


                                {{-- PENDIENTE --}}

                                @if($estado === 'Pendiente')

                                    <form method="POST"
                                          action="{{ route('administrador.citas.estado', $cita) }}">

                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden"
                                               name="estado"
                                               value="Confirmada">

                                        <button class="accion-btn accion-confirmar">
                                            ✓ Confirmar
                                        </button>

                                    </form>


                                    <form method="POST"
                                          action="{{ route('administrador.citas.estado', $cita) }}"
                                          onsubmit="return confirm('¿Rechazar esta cita?')">

                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden"
                                               name="estado"
                                               value="Rechazada">

                                        <button class="accion-btn accion-peligro">
                                            Rechazar
                                        </button>

                                    </form>

                                @endif


                                {{-- CONFIRMADA --}}

                                @if($estado === 'Confirmada')

                                    <form method="POST"
                                          action="{{ route('administrador.citas.estado', $cita) }}">

                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden"
                                               name="estado"
                                               value="Completada">

                                        <button class="accion-btn accion-completar">
                                            ✓ Completar
                                        </button>

                                    </form>


                                    <form method="POST"
                                          action="{{ route('administrador.citas.estado', $cita) }}"
                                          onsubmit="return confirm('¿Cancelar esta cita?')">

                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden"
                                               name="estado"
                                               value="Cancelada">

                                        <button class="accion-btn accion-peligro">
                                            Cancelar
                                        </button>

                                    </form>

                                @endif


                                {{-- VER --}}

                                <a href="{{ route('administrador.citas.show', $cita) }}"
                                   class="accion-btn">
                                    Ver
                                </a>


                                {{-- EDITAR --}}

                                <a href="{{ route('administrador.citas.edit', $cita) }}"
                                   class="accion-btn">
                                    Editar
                                </a>


                                {{-- ELIMINAR --}}

                                <form method="POST"
                                      action="{{ route('administrador.citas.destroy', $cita) }}"
                                      onsubmit="return confirm('¿Eliminar definitivamente esta cita?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="accion-btn accion-peligro">
                                        Eliminar
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="empty-citas">

                            <span>◷</span>

                            No se encontraron citas.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        @if($citas->hasPages())

            <div class="pagination-wrapper">

                {{ $citas->links() }}

            </div>

        @endif

    </div>

@endsection
