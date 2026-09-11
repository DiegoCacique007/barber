@extends('layouts.administrador')

@section('title', 'Servicios')

@push('styles')
    <style>
        .servicios-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .btn-servicio-primary {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 18px;
            border: 1px solid #d5ad55;
            border-radius: 100px;
            background: #d5ad55;
            color: #111;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: .22s ease;
        }

        .btn-servicio-primary:hover {
            border-color: #e8c873;
            background: #e8c873;
            color: #111;
            transform: translateY(-2px);
        }

        .servicios-card {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 16px;
            background: #1a1a1a;
            box-shadow: 0 15px 35px rgba(0,0,0,.12);
        }

        .servicios-table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
            background: #1a1a1a !important;
        }

        .servicios-table thead {
            background: #171717 !important;
        }

        .servicios-table th {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255,255,255,.10);
            background: #171717 !important;
            color: #c5c5c5 !important;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .servicios-table td {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            background: #1a1a1a !important;
            color: #e1e1e1 !important;
            font-size: 12px;
            vertical-align: middle;
        }

        .servicios-table tbody tr:hover td {
            background: #1d1d1d !important;
        }

        .servicios-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .servicio-imagen {
            width: 62px;
            height: 62px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 10px;
            background: #202020;
        }

        .servicio-imagen img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .servicio-imagen-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            font-size: 18px;
        }

        .servicio-info strong {
            display: block;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
        }

        .servicio-info span {
            display: block;
            max-width: 380px;
            margin-top: 4px;
            overflow: hidden;
            color: #aaa;
            font-size: 11px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .servicio-precio {
            color: #f0f0f0;
            font-size: 13px;
            font-weight: 600;
        }

        .servicio-estado {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 10px;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 600;
        }

        .servicio-estado::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .servicio-activo {
            border: 1px solid rgba(95,205,145,.25);
            background: rgba(95,205,145,.10);
            color: #89d8ac;
        }

        .servicio-inactivo {
            border: 1px solid rgba(255,255,255,.10);
            background: rgba(255,255,255,.04);
            color: #aaa;
        }

        .servicio-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 7px;
        }

        .action-btn {
            min-height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 11px;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 8px;
            background: #202020;
            color: #c2c2c2;
            font-size: 10px;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .action-btn:hover {
            border-color: rgba(213,173,85,.28);
            background: rgba(213,173,85,.08);
            color: #ddb65a;
        }

        .action-btn.edit {
            border-color: rgba(213,173,85,.22);
            color: #ddb65a;
        }

        .action-btn.delete {
            border-color: rgba(235,110,120,.20);
            color: #efa0a7;
        }

        .action-btn.delete:hover {
            border-color: rgba(235,110,120,.32);
            background: rgba(220,70,80,.09);
            color: #f3abb1;
        }

        .servicios-empty-row td,
        .servicios-empty-row:hover td {
            padding: 0 !important;
            border: 0 !important;
            background: #1a1a1a !important;
        }

        .servicios-empty {
            min-height: 230px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 35px;
            background: #1a1a1a;
            text-align: center;
        }

        .servicios-empty-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            border: 1px solid rgba(213,173,85,.18);
            border-radius: 12px;
            background: rgba(213,173,85,.07);
            color: #ddb65a;
            font-size: 20px;
        }

        .servicios-empty h5 {
            margin: 0 0 7px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
        }

        .servicios-empty p {
            margin: 0;
            color: #aaa;
            font-size: 11px;
        }

        .servicios-pagination {
            padding: 15px 20px;
            border-top: 1px solid rgba(255,255,255,.07);
            background: #181818;
        }

        @media(max-width:850px) {
            .servicios-card {
                overflow-x: auto;
            }

            .servicios-table {
                min-width: 850px;
            }
        }

        @media(max-width:600px) {
            .servicios-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .btn-servicio-primary {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')

    <div class="servicios-header">

        <div class="page-header mb-0">
            <h1>Servicios</h1>
            <p>Administra los cortes y servicios que se mostrarán en la landing page.</p>
        </div>

        <a href="{{ route('administrador.servicios.create') }}"
           class="btn-servicio-primary">
            <span>＋</span>
            Nuevo servicio
        </a>

    </div>

    <div class="servicios-card">

        <div class="table-responsive">

            <table class="servicios-table">

                <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Servicio</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @forelse($servicios as $servicio)

                    <tr>

                        <td>
                            <div class="servicio-imagen">

                                @if($servicio->imagen)
                                    <img src="{{ asset('storage/' . $servicio->imagen) }}"
                                         alt="{{ $servicio->nombre }}">
                                @else
                                    <div class="servicio-imagen-placeholder">
                                        ✂
                                    </div>
                                @endif

                            </div>
                        </td>

                        <td>
                            <div class="servicio-info">

                                <strong>
                                    {{ $servicio->nombre }}
                                </strong>

                                <span>
                                    {{ $servicio->descripcion ?: 'Sin descripción' }}
                                </span>

                            </div>
                        </td>

                        <td>
                            <span class="servicio-precio">
                                ${{ number_format($servicio->precio, 2) }}
                            </span>
                        </td>

                        <td>

                            @if($servicio->activo)
                                <span class="servicio-estado servicio-activo">
                                    Activo
                                </span>
                            @else
                                <span class="servicio-estado servicio-inactivo">
                                    Inactivo
                                </span>
                            @endif

                        </td>

                        <td>

                            <div class="servicio-actions">

                                <a href="{{ route('administrador.servicios.show', $servicio) }}"
                                   class="action-btn">
                                    Ver
                                </a>

                                <a href="{{ route('administrador.servicios.edit', $servicio) }}"
                                   class="action-btn edit">
                                    Editar
                                </a>

                                <form method="POST"
                                      action="{{ route('administrador.servicios.destroy', $servicio) }}"
                                      class="delete-servicio-form">

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

                    <tr class="servicios-empty-row">

                        <td colspan="5">

                            <div class="servicios-empty">

                                <div>
                                    <div class="servicios-empty-icon">✂</div>

                                    <h5>No hay servicios registrados</h5>

                                    <p>
                                        Los servicios que registres aparecerán en esta sección.
                                    </p>
                                </div>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if(method_exists($servicios, 'hasPages') && $servicios->hasPages())
            <div class="servicios-pagination">
                {{ $servicios->links() }}
            </div>
        @endif

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.delete-servicio-form').forEach(form => {

                form.addEventListener('submit', event => {

                    if (!confirm('¿Estás seguro de eliminar este servicio?')) {
                        event.preventDefault();
                    }

                });

            });

        });
    </script>
@endpush
