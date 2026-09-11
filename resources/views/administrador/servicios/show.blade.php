@extends('layouts.administrador')

@section('title', $servicio->nombre)

@push('styles')
    <style>
        .servicio-show-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .servicio-header-actions {
            display: flex;
            gap: 9px;
        }

        .btn-show-secondary,
        .btn-show-primary {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 16px;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s ease;
        }

        .btn-show-secondary {
            border: 1px solid rgba(255,255,255,.14);
            background: #1a1a1a;
            color: #bbb;
        }

        .btn-show-secondary:hover {
            border-color: rgba(213,173,85,.25);
            color: #fff;
        }

        .btn-show-primary {
            border: 1px solid #d5ad55;
            background: #d5ad55;
            color: #111;
        }

        .btn-show-primary:hover {
            border-color: #e8c873;
            background: #e8c873;
            color: #111;
        }

        .servicio-show-grid {
            display: grid;
            grid-template-columns: .8fr 1.2fr;
            gap: 20px;
        }

        .servicio-image-card,
        .servicio-info-card {
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 16px;
            background: #1a1a1a;
            box-shadow: 0 15px 35px rgba(0,0,0,.12);
        }

        .servicio-image-card {
            padding: 20px;
        }

        .servicio-show-image {
            width: 100%;
            height: 420px;
            overflow: hidden;
            border-radius: 12px;
            background: #171717;
        }

        .servicio-show-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .servicio-show-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            font-size: 45px;
        }

        .servicio-info-card {
            padding: 28px;
        }

        .servicio-data {
            padding: 18px 0;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }

        .servicio-data:first-child {
            padding-top: 0;
        }

        .servicio-data:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .servicio-data-label {
            display: block;
            margin-bottom: 7px;
            color: #aaa;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .5px;
        }

        .servicio-data-value {
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            line-height: 1.6;
        }

        .servicio-price {
            color: #fff;
            font-size: 24px;
            font-weight: 700;
        }

        .servicio-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 10px;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 600;
        }

        .servicio-status::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .servicio-status.active {
            border: 1px solid rgba(95,205,145,.25);
            background: rgba(95,205,145,.10);
            color: #89d8ac;
        }

        .servicio-status.inactive {
            border: 1px solid rgba(255,255,255,.10);
            background: rgba(255,255,255,.04);
            color: #aaa;
        }

        @media(max-width:900px) {
            .servicio-show-grid {
                grid-template-columns: 1fr;
            }

            .servicio-show-image {
                height: 380px;
            }
        }

        @media(max-width:600px) {
            .servicio-show-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .servicio-header-actions {
                width: 100%;
            }

            .btn-show-secondary,
            .btn-show-primary {
                flex: 1;
            }

            .servicio-show-image {
                height: 300px;
            }

            .servicio-info-card {
                padding: 21px;
            }
        }
    </style>
@endpush

@section('content')

    <div class="servicio-show-header">

        <div class="page-header mb-0">

            <h1>
                {{ $servicio->nombre }}
            </h1>

            <p>
                Información completa del servicio.
            </p>

        </div>

        <div class="servicio-header-actions">

            <a href="{{ route('administrador.servicios.index') }}"
               class="btn-show-secondary">
                Volver
            </a>

            <a href="{{ route('administrador.servicios.edit', $servicio) }}"
               class="btn-show-primary">
                Editar
            </a>

        </div>

    </div>


    <div class="servicio-show-grid">

        <div class="servicio-image-card">

            <div class="servicio-show-image">

                @if($servicio->imagen)

                    <img src="{{ asset('storage/' . $servicio->imagen) }}"
                         alt="{{ $servicio->nombre }}">

                @else

                    <div class="servicio-show-placeholder">
                        ✂
                    </div>

                @endif

            </div>

        </div>


        <div class="servicio-info-card">

            <div class="servicio-data">

            <span class="servicio-data-label">
                Nombre
            </span>

                <div class="servicio-data-value">
                    {{ $servicio->nombre }}
                </div>

            </div>


            <div class="servicio-data">

            <span class="servicio-data-label">
                Descripción
            </span>

                <div class="servicio-data-value">
                    {{ $servicio->descripcion ?: 'Sin descripción' }}
                </div>

            </div>


            <div class="servicio-data">

            <span class="servicio-data-label">
                Precio
            </span>

                <div class="servicio-price">
                    ${{ number_format($servicio->precio, 2) }}
                </div>

            </div>


            <div class="servicio-data">

            <span class="servicio-data-label">
                Estado
            </span>

                @if($servicio->activo)

                    <span class="servicio-status active">
                    Activo
                </span>

                @else

                    <span class="servicio-status inactive">
                    Inactivo
                </span>

                @endif

            </div>

        </div>

    </div>

@endsection
