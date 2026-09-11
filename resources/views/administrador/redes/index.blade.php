@extends('layouts.administrador')

@section('title', 'Redes sociales')

@push('styles')
    <style>
        /* =========================================================
           ENCABEZADO
        ========================================================= */

        .redes-header{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:25px}

        .btn-red-primary{min-height:42px;display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:0 18px;border:1px solid #d5ad55;border-radius:100px;background:#d5ad55;color:#111;font-size:12px;font-weight:700;text-decoration:none;transition:.22s ease}
        .btn-red-primary:hover{border-color:#e8c873;background:#e8c873;color:#111;transform:translateY(-2px)}

        /* =========================================================
           TABLA
        ========================================================= */

        .redes-card{overflow:hidden;border:1px solid rgba(255,255,255,.10);border-radius:16px;background:#1a1a1a;box-shadow:0 15px 35px rgba(0,0,0,.12)}

        .redes-table{width:100%;margin:0;border-collapse:collapse;background:#1a1a1a!important}
        .redes-table thead{background:#171717!important}

        .redes-table th{padding:15px 20px;border-bottom:1px solid rgba(255,255,255,.10);background:#171717!important;color:#c5c5c5!important;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase}

        .redes-table td{padding:17px 20px;border-bottom:1px solid rgba(255,255,255,.07);background:#1a1a1a!important;color:#e5e5e5!important;font-size:12px;vertical-align:middle}

        .redes-table tbody tr:hover td{background:#1d1d1d!important}
        .redes-table tbody tr:last-child td{border-bottom:0}

        /* =========================================================
           RED SOCIAL
        ========================================================= */

        .red-info{display:flex;align-items:center;gap:12px}

        .red-icon{width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid rgba(255,255,255,.09);border-radius:11px;background:#202020;color:#ddb65a;font-size:15px;font-weight:700;transition:.2s ease}

        .redes-table tbody tr:hover .red-icon{border-color:rgba(213,173,85,.24);background:rgba(213,173,85,.08)}

        .red-data strong{display:block;color:#fff;font-size:13px;font-weight:600}
        .red-data span{display:block;margin-top:3px;color:#999;font-size:10px}

        /* =========================================================
           ENLACE
        ========================================================= */

        .red-link{max-width:480px;display:flex;align-items:center;gap:8px}

        .red-link-symbol{flex-shrink:0;color:#aaa;font-size:13px}

        .red-link a{display:block;overflow:hidden;color:#c5c5c5;font-size:11px;text-overflow:ellipsis;white-space:nowrap;transition:.2s ease}

        .red-link a:hover{color:#ddb65a}

        /* =========================================================
           ESTADO
        ========================================================= */

        .red-status{display:inline-flex;align-items:center;gap:7px;padding:6px 10px;border-radius:100px;font-size:10px;font-weight:600}

        .red-status::before{content:"";width:6px;height:6px;border-radius:50%;background:currentColor}

        .status-activa{border:1px solid rgba(95,205,145,.25);background:rgba(95,205,145,.10);color:#89d8ac}

        .status-inactiva{border:1px solid rgba(255,255,255,.10);background:rgba(255,255,255,.04);color:#aaa}

        /* =========================================================
           ACCIONES
        ========================================================= */

        .red-actions{display:flex;align-items:center;justify-content:flex-end;gap:7px}

        .action-btn{min-height:34px;display:inline-flex;align-items:center;justify-content:center;padding:0 11px;border:1px solid rgba(255,255,255,.12);border-radius:8px;background:#202020;color:#c2c2c2;font-size:10px;text-decoration:none;cursor:pointer;transition:.2s ease}

        .action-btn:hover{border-color:rgba(213,173,85,.28);background:rgba(213,173,85,.08);color:#ddb65a}

        .action-btn.edit{border-color:rgba(213,173,85,.22);color:#ddb65a}

        .action-btn.delete{border-color:rgba(235,110,120,.20);color:#efa0a7}

        .action-btn.delete:hover{border-color:rgba(235,110,120,.32);background:rgba(220,70,80,.09);color:#f3abb1}

        /* =========================================================
           SIN REGISTROS
        ========================================================= */

        .redes-empty-row td,
        .redes-empty-row:hover td{padding:0!important;border:0!important;background:#1a1a1a!important}

        .redes-empty{min-height:230px;display:flex;align-items:center;justify-content:center;padding:35px;background:#1a1a1a;text-align:center}

        .redes-empty-icon{width:50px;height:50px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;border:1px solid rgba(213,173,85,.18);border-radius:12px;background:rgba(213,173,85,.07);color:#ddb65a;font-size:20px}

        .redes-empty h5{margin:0 0 7px;color:#fff;font-size:14px;font-weight:600}
        .redes-empty p{margin:0;color:#aaa;font-size:11px;line-height:1.6}

        /* =========================================================
           PAGINACIÓN
        ========================================================= */

        .redes-pagination{padding:15px 20px;border-top:1px solid rgba(255,255,255,.07);background:#181818}

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media(max-width:800px){
            .redes-card{overflow-x:auto}
            .redes-table{min-width:800px}
        }

        @media(max-width:600px){
            .redes-header{align-items:flex-start;flex-direction:column}
            .btn-red-primary{width:100%}
        }
    </style>
@endpush

@section('content')

    <div class="redes-header">

        <div class="page-header mb-0">
            <h1>Redes sociales</h1>
            <p>Administra las redes sociales que aparecerán en el sitio público.</p>
        </div>

        <a href="{{ route('administrador.redes.create') }}"
           class="btn-red-primary">
            <span>＋</span>
            Nueva red social
        </a>

    </div>

    <div class="redes-card">

        <div class="table-responsive">

            <table class="redes-table">

                <thead>
                <tr>
                    <th>Red social</th>
                    <th>Enlace</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @forelse($redes as $redSocial)

                    @php
                        $nombre = strtolower($redSocial->nombre);

                        $simbolo = match(true) {
                            str_contains($nombre, 'instagram') => '◎',
                            str_contains($nombre, 'facebook') => 'f',
                            str_contains($nombre, 'whatsapp') => '◉',
                            str_contains($nombre, 'youtube') => '▶',
                            str_contains($nombre, 'tiktok') => '♪',
                            str_contains($nombre, 'twitter') => 'X',
                            str_contains($nombre, 'linkedin') => 'in',
                            str_contains($nombre, 'telegram') => '➤',
                            default => '↗'
                        };
                    @endphp

                    <tr>

                        <td>

                            <div class="red-info">

                                <div class="red-icon">
                                    {{ $simbolo }}
                                </div>

                                <div class="red-data">

                                    <strong>
                                        {{ $redSocial->nombre }}
                                    </strong>

                                    <span>
                                        Red social registrada
                                    </span>

                                </div>

                            </div>

                        </td>

                        <td>

                            <div class="red-link">

                                <span class="red-link-symbol">
                                    ↗
                                </span>

                                <a href="{{ $redSocial->url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   title="{{ $redSocial->url }}">
                                    {{ $redSocial->url }}
                                </a>

                            </div>

                        </td>

                        <td>

                            @if($redSocial->activo)

                                <span class="red-status status-activa">
                                    Activa
                                </span>

                            @else

                                <span class="red-status status-inactiva">
                                    Inactiva
                                </span>

                            @endif

                        </td>

                        <td>

                            <div class="red-actions">

                                <a href="{{ $redSocial->url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="action-btn"
                                   title="Abrir red social">
                                    Abrir
                                </a>

                                <a href="{{ route('administrador.redes.edit', $redSocial) }}"
                                   class="action-btn edit">
                                    Editar
                                </a>

                                <form method="POST"
                                      action="{{ route('administrador.redes.destroy', $redSocial) }}"
                                      class="delete-red-form">

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

                    <tr class="redes-empty-row">

                        <td colspan="4">

                            <div class="redes-empty">

                                <div>

                                    <div class="redes-empty-icon">
                                        ◎
                                    </div>

                                    <h5>
                                        No hay redes sociales registradas
                                    </h5>

                                    <p>
                                        Las redes sociales que registres aparecerán en esta sección.
                                    </p>

                                </div>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($redes->hasPages())

            <div class="redes-pagination">
                {{ $redes->links() }}
            </div>

        @endif

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.delete-red-form').forEach(form => {

                form.addEventListener('submit', event => {

                    if (!confirm('¿Estás seguro de eliminar esta red social?')) {
                        event.preventDefault();
                    }

                });

            });

        });
    </script>
@endpush
