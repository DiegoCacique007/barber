@extends('layouts.administrador')

@section('title', 'Nuevo servicio')

@push('styles')
    <style>
        .servicio-page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .btn-volver {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 15px;
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 9px;
            background: #1a1a1a;
            color: #bbb;
            font-size: 11px;
            text-decoration: none;
            transition: .2s ease;
        }

        .btn-volver:hover {
            border-color: rgba(213,173,85,.25);
            color: #fff;
        }

        .servicio-form-card {
            padding: 27px;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 16px;
            background: #1a1a1a;
            box-shadow: 0 15px 35px rgba(0,0,0,.12);
        }

        .servicio-form-grid {
            display: grid;
            grid-template-columns: 1.35fr .85fr;
            gap: 25px;
        }

        .servicio-fields {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .form-group-custom label,
        .image-label {
            display: block;
            margin-bottom: 8px;
            color: #d0d0d0;
            font-size: 11px;
            font-weight: 600;
        }

        .form-group-custom .form-control,
        .image-file {
            width: 100%;
            min-height: 45px;
            border: 1px solid rgba(255,255,255,.14) !important;
            border-radius: 9px !important;
            background: #202020 !important;
            color: #fff !important;
            font-size: 12px;
        }

        .form-group-custom .form-control:focus,
        .image-file:focus {
            border-color: #d5ad55 !important;
            background: #222 !important;
            box-shadow: 0 0 0 .2rem rgba(213,173,85,.08) !important;
        }

        .form-control::placeholder {
            color: #888 !important;
        }

        .servicio-textarea {
            min-height: 135px !important;
            resize: vertical;
        }

        .precio-input {
            position: relative;
        }

        .precio-input > span {
            position: absolute;
            top: 50%;
            left: 14px;
            z-index: 2;
            color: #999;
            transform: translateY(-50%);
        }

        .precio-input input {
            padding-left: 35px !important;
        }

        .servicio-status {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding-top: 2px;
        }

        .servicio-status strong {
            display: block;
            color: #eee;
            font-size: 12px;
            font-weight: 600;
        }

        .servicio-status span {
            display: block;
            margin-top: 6px;
            color: #999;
            font-size: 10px;
        }

        .form-check {
            margin: 0;
        }

        .form-check-input {
            width: 2.2em !important;
            height: 1.15em !important;
            cursor: pointer;
        }

        .form-check-input:checked {
            border-color: #d5ad55 !important;
            background-color: #d5ad55 !important;
        }

        .image-box {
            padding: 20px;
            border: 1px solid rgba(255,255,255,.13);
            border-radius: 14px;
            background: #202020;
        }

        .image-preview {
            width: 100%;
            height: 275px;
            overflow: hidden;
            margin-bottom: 15px;
            border-radius: 10px;
            background: #181818;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .image-preview.empty {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px dashed rgba(255,255,255,.12);
            color: #777;
            font-size: 35px;
        }

        .image-help {
            display: block;
            margin-top: 8px;
            color: #929292;
            font-size: 10px;
        }

        .form-error {
            margin-top: 6px;
            color: #efa0a7;
            font-size: 10px;
        }

        .servicio-form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,.07);
        }

        .btn-form-primary,
        .btn-form-secondary {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 18px;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s ease;
        }

        .btn-form-primary {
            border: 1px solid #d5ad55;
            background: #d5ad55;
            color: #111;
        }

        .btn-form-primary:hover {
            border-color: #e8c873;
            background: #e8c873;
        }

        .btn-form-secondary {
            border: 1px solid rgba(255,255,255,.14);
            background: #202020;
            color: #bbb;
        }

        .btn-form-secondary:hover {
            border-color: rgba(213,173,85,.25);
            color: #fff;
        }

        @media(max-width:900px) {
            .servicio-form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:600px) {
            .servicio-page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .servicio-form-card {
                padding: 20px;
            }

            .servicio-form-actions {
                flex-direction: column-reverse;
            }

            .btn-form-primary,
            .btn-form-secondary,
            .btn-volver {
                width: 100%;
            }

            .image-preview {
                height: 230px;
            }
        }
    </style>
@endpush

@section('content')

    <div class="servicio-page-header">

        <div class="page-header mb-0">
            <h1>Nuevo servicio</h1>
            <p>Registra un nuevo corte o servicio para mostrarlo en la barbería.</p>
        </div>

        <a href="{{ route('administrador.servicios.index') }}"
           class="btn-volver">
            Volver
        </a>

    </div>

    <div class="servicio-form-card">

        <form method="POST"
              action="{{ route('administrador.servicios.store') }}"
              enctype="multipart/form-data">

            @csrf

            @include('administrador.servicios.form')

        </form>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const input = document.getElementById('imagen');
            const image = document.getElementById('previewImage');
            const empty = document.getElementById('emptyPreview');

            input?.addEventListener('change', event => {

                const file = event.target.files[0];

                if (!file) return;

                const reader = new FileReader();

                reader.onload = e => {

                    image.src = e.target.result;
                    image.style.display = 'block';

                    if (empty) {
                        empty.style.display = 'none';
                    }

                    document.getElementById('imagePreview')
                        ?.classList.remove('empty');

                };

                reader.readAsDataURL(file);

            });

        });
    </script>
@endpush
