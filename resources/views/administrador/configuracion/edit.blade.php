@extends('layouts.administrador')

@section('title', 'Configuración')

@push('styles')
    <style>
        /* =========================================================
           ENCABEZADO
        ========================================================= */

        .config-page-header{
            display:flex;
            align-items:flex-end;
            justify-content:space-between;
            gap:20px;
            margin-bottom:25px;
        }

        .config-header-actions{
            display:flex;
            gap:9px;
        }

        .btn-ver-sitio{
            min-height:40px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:7px;
            padding:0 15px;
            border:1px solid rgba(255,255,255,.15);
            border-radius:9px;
            background:#1a1a1a;
            color:#bbb;
            font-size:11px;
            text-decoration:none;
            transition:.2s ease;
        }

        .btn-ver-sitio:hover{
            border-color:rgba(213,173,85,.25);
            color:#fff;
            transform:translateY(-1px);
        }

        /* =========================================================
           TARJETA PRINCIPAL
        ========================================================= */

        .config-form-card{
            width:100%;
            padding:32px;
            border:1px solid rgba(255,255,255,.10);
            border-radius:18px;
            background:#1a1a1a;
            box-shadow:0 15px 35px rgba(0,0,0,.12);
        }

        .config-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:24px;
        }

        .config-section{
            padding:24px;
            border:1px solid rgba(255,255,255,.08);
            border-radius:16px;
            background:#171717;
        }

        .config-section.full{
            grid-column:1/-1;
        }

        /* =========================================================
           ENCABEZADOS
        ========================================================= */

        .config-section-header{
            display:flex;
            align-items:center;
            gap:13px;
            margin-bottom:24px;
            padding-bottom:18px;
            border-bottom:1px solid rgba(255,255,255,.07);
        }

        .config-section-icon{
            width:42px;
            height:42px;
            display:flex;
            align-items:center;
            justify-content:center;
            flex-shrink:0;
            border:1px solid rgba(213,173,85,.18);
            border-radius:11px;
            background:rgba(213,173,85,.07);
            color:#ddb65a;
            font-size:16px;
        }

        .config-section-header h5{
            margin:0;
            color:#fff;
            font-size:15px;
            font-weight:700;
        }

        .config-section-header p{
            margin:4px 0 0;
            color:#999;
            font-size:11px;
        }

        /* =========================================================
           CAMPOS
        ========================================================= */

        .config-fields{
            display:flex;
            flex-direction:column;
            gap:20px;
        }

        .config-row{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:16px;
        }

        .config-group label{
            display:block;
            margin-bottom:8px;
            color:#d8d8d8;
            font-size:12px;
            font-weight:600;
        }

        .config-group .form-control{
            width:100%;
            min-height:48px;
            border:1px solid rgba(255,255,255,.14)!important;
            border-radius:10px!important;
            background:#202020!important;
            color:#fff!important;
            font-size:13px;
        }

        .config-group textarea.form-control{
            min-height:125px;
            padding-top:12px;
            resize:vertical;
        }

        .config-group .form-control::placeholder{
            color:#888!important;
        }

        .config-group .form-control:focus{
            border-color:#d5ad55!important;
            background:#222!important;
            color:#fff!important;
            box-shadow:0 0 0 .2rem rgba(213,173,85,.08)!important;
        }

        .config-help{
            display:block;
            margin-top:7px;
            color:#999;
            font-size:10px;
            line-height:1.5;
        }

        .config-error{
            margin-top:6px;
            color:#efa0a7;
            font-size:11px;
        }

        /* =========================================================
           CONTACTO
        ========================================================= */

        .contact-field{
            position:relative;
        }

        .contact-field-symbol{
            position:absolute;
            top:50%;
            left:14px;
            z-index:2;
            color:#999;
            font-size:12px;
            transform:translateY(-50%);
            pointer-events:none;
        }

        .contact-field .form-control{
            padding-left:39px!important;
        }

        /* =========================================================
           IMÁGENES
        ========================================================= */

        .images-grid{
            display:grid;
            grid-template-columns:.7fr 1.3fr;
            gap:20px;
        }

        .image-config-card{
            padding:18px;
            border:1px solid rgba(255,255,255,.09);
            border-radius:14px;
            background:#1c1c1c;
        }

        .image-config-title{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:15px;
            margin-bottom:13px;
        }

        .image-config-title strong{
            color:#eee;
            font-size:12px;
            font-weight:600;
        }

        .image-config-title span{
            color:#999;
            font-size:9px;
        }

        .image-preview{
            position:relative;
            width:100%;
            overflow:hidden;
            margin-bottom:14px;
            border:1px solid rgba(255,255,255,.08);
            border-radius:11px;
            background:#151515;
        }

        .logo-preview{
            height:200px;
        }

        .portada-preview{
            height:300px;
        }

        .image-preview img{
            width:100%;
            height:100%;
            display:block;
            object-fit:contain;
        }

        .portada-preview img{
            object-fit:cover;
        }

        .image-placeholder{
            width:100%;
            height:100%;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            gap:8px;
            color:#777;
            text-align:center;
        }

        .image-placeholder strong{
            color:#999;
            font-size:12px;
            font-weight:600;
        }

        .image-placeholder span{
            color:#777;
            font-size:10px;
        }

        .image-placeholder-icon{
            color:#ddb65a;
            font-size:30px;
        }

        .image-file{
            width:100%;
            min-height:45px;
            border:1px solid rgba(255,255,255,.14)!important;
            border-radius:9px!important;
            background:#202020!important;
            color:#ddd!important;
            font-size:11px;
        }

        .image-file::file-selector-button{
            min-height:43px;
            margin:-1px 12px -1px -1px;
            padding:0 15px;
            border:0;
            border-right:1px solid rgba(255,255,255,.10);
            background:#292929;
            color:#ddd;
            cursor:pointer;
            transition:.2s ease;
        }

        .image-file::file-selector-button:hover{
            background:rgba(213,173,85,.10);
            color:#ddb65a;
        }

        /* =========================================================
           BOTONES
        ========================================================= */

        .config-form-actions{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:20px;
            margin-top:28px;
            padding-top:22px;
            border-top:1px solid rgba(255,255,255,.07);
        }

        .config-form-note{
            color:#999;
            font-size:10px;
        }

        .config-buttons{
            display:flex;
            gap:10px;
        }

        .btn-config-primary,
        .btn-config-secondary{
            min-height:44px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:7px;
            padding:0 18px;
            border-radius:10px;
            font-size:12px;
            font-weight:600;
            text-decoration:none;
            cursor:pointer;
            transition:.2s ease;
        }

        .btn-config-primary{
            border:1px solid #d5ad55;
            background:#d5ad55;
            color:#111;
        }

        .btn-config-primary:hover{
            border-color:#e8c873;
            background:#e8c873;
            color:#111;
            transform:translateY(-1px);
        }

        .btn-config-secondary{
            border:1px solid rgba(255,255,255,.14);
            background:#202020;
            color:#bbb;
        }

        .btn-config-secondary:hover{
            border-color:rgba(213,173,85,.25);
            color:#fff;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media(max-width:1000px){
            .config-grid,
            .images-grid{
                grid-template-columns:1fr;
            }

            .config-section.full{
                grid-column:auto;
            }
        }

        @media(max-width:700px){
            .config-row{
                grid-template-columns:1fr;
            }

            .config-page-header{
                align-items:flex-start;
                flex-direction:column;
            }

            .config-header-actions,
            .btn-ver-sitio{
                width:100%;
            }

            .config-form-card{
                padding:22px;
            }

            .config-section{
                padding:18px;
            }

            .config-form-actions{
                align-items:stretch;
                flex-direction:column;
            }

            .config-buttons{
                flex-direction:column-reverse;
                width:100%;
            }

            .btn-config-primary,
            .btn-config-secondary{
                width:100%;
            }

            .portada-preview{
                height:220px;
            }
        }
    </style>
@endpush

@section('content')

    <div class="config-page-header">

        <div class="page-header mb-0">
            <h1>Configuración</h1>
            <p>Administra la información general y apariencia pública de la barbería.</p>
        </div>

        <div class="config-header-actions">

            <a href="{{ route('inicio') }}"
               target="_blank"
               rel="noopener noreferrer"
               class="btn-ver-sitio">
                <span>↗</span>
                Ver sitio público
            </a>

        </div>

    </div>

    <div class="config-form-card">

        <form method="POST"
              action="{{ route('administrador.configuracion.update') }}"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="config-grid">

                {{-- =====================================================
                     INFORMACIÓN GENERAL
                ====================================================== --}}

                <div class="config-section">

                    <div class="config-section-header">

                        <div class="config-section-icon">
                            ✦
                        </div>

                        <div>
                            <h5>Información general</h5>
                            <p>Datos principales que identifican a la barbería.</p>
                        </div>

                    </div>

                    <div class="config-fields">

                        <div class="config-group">

                            <label for="nombre">
                                Nombre de la barbería
                            </label>

                            <input type="text"
                                   id="nombre"
                                   name="nombre"
                                   value="{{ old('nombre', $configuracion->nombre ?? '') }}"
                                   class="form-control @error('nombre') is-invalid @enderror"
                                   placeholder="Ej. Barber Shop"
                                   required>

                            @error('nombre')
                            <div class="config-error">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <div class="config-group">

                            <label for="eslogan">
                                Eslogan
                            </label>

                            <input type="text"
                                   id="eslogan"
                                   name="eslogan"
                                   value="{{ old('eslogan', $configuracion->eslogan ?? '') }}"
                                   class="form-control @error('eslogan') is-invalid @enderror"
                                   placeholder="Ej. Estilo que define tu presencia">

                            @error('eslogan')
                            <div class="config-error">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <div class="config-group">

                            <label for="descripcion">
                                Descripción
                            </label>

                            <textarea id="descripcion"
                                      name="descripcion"
                                      class="form-control @error('descripcion') is-invalid @enderror"
                                      placeholder="Describe brevemente la barbería...">{{ old('descripcion', $configuracion->descripcion ?? '') }}</textarea>

                            @error('descripcion')
                            <div class="config-error">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                    </div>

                </div>

                {{-- =====================================================
                     CONTACTO
                ====================================================== --}}

                <div class="config-section">

                    <div class="config-section-header">

                        <div class="config-section-icon">
                            ◉
                        </div>

                        <div>
                            <h5>Contacto y ubicación</h5>
                            <p>Información para que los clientes puedan comunicarse.</p>
                        </div>

                    </div>

                    <div class="config-fields">

                        <div class="config-row">

                            <div class="config-group">

                                <label for="telefono">
                                    Teléfono
                                </label>

                                <div class="contact-field">

                                <span class="contact-field-symbol">
                                    ☎
                                </span>

                                    <input type="text"
                                           id="telefono"
                                           name="telefono"
                                           value="{{ old('telefono', $configuracion->telefono ?? '') }}"
                                           class="form-control @error('telefono') is-invalid @enderror"
                                           placeholder="729 123 4567">

                                </div>

                                @error('telefono')
                                <div class="config-error">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>

                            <div class="config-group">

                                <label for="whatsapp">
                                    WhatsApp
                                </label>

                                <div class="contact-field">

                                <span class="contact-field-symbol">
                                    ◉
                                </span>

                                    <input type="text"
                                           id="whatsapp"
                                           name="whatsapp"
                                           value="{{ old('whatsapp', $configuracion->whatsapp ?? '') }}"
                                           class="form-control @error('whatsapp') is-invalid @enderror"
                                           placeholder="5217291234567">

                                </div>

                                <span class="config-help">
                                Para enlaces directos es recomendable incluir código de país.
                            </span>

                                @error('whatsapp')
                                <div class="config-error">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>

                        </div>

                        <div class="config-group">

                            <label for="correo">
                                Correo electrónico
                            </label>

                            <div class="contact-field">

                            <span class="contact-field-symbol">
                                @
                            </span>

                                <input type="email"
                                       id="correo"
                                       name="correo"
                                       value="{{ old('correo', $configuracion->correo ?? '') }}"
                                       class="form-control @error('correo') is-invalid @enderror"
                                       placeholder="contacto@barber.com">

                            </div>

                            @error('correo')
                            <div class="config-error">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <div class="config-group">

                            <label for="direccion">
                                Dirección
                            </label>

                            <input type="text"
                                   id="direccion"
                                   name="direccion"
                                   value="{{ old('direccion', $configuracion->direccion ?? '') }}"
                                   class="form-control @error('direccion') is-invalid @enderror"
                                   placeholder="Dirección de la barbería">

                            @error('direccion')
                            <div class="config-error">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                    </div>

                </div>

                {{-- =====================================================
                     IDENTIDAD VISUAL
                ====================================================== --}}

                <div class="config-section full">

                    <div class="config-section-header">

                        <div class="config-section-icon">
                            ◇
                        </div>

                        <div>
                            <h5>Identidad visual</h5>
                            <p>Configura el logo y la imagen principal del sitio público.</p>
                        </div>

                    </div>

                    <div class="images-grid">

                        {{-- LOGO --}}

                        <div class="image-config-card">

                            <div class="image-config-title">
                                <strong>Logo</strong>
                                <span>Identidad de la barbería</span>
                            </div>

                            <div class="image-preview logo-preview"
                                 id="logoPreview">

                                @if($configuracion?->logo)

                                    <img src="{{ asset('storage/' . $configuracion->logo) }}"
                                         id="logoPreviewImage"
                                         alt="Logo de {{ $configuracion->nombre }}">

                                    <div class="image-placeholder"
                                         id="logoPlaceholder"
                                         style="display:none">

                                        <div class="image-placeholder-icon">
                                            ◇
                                        </div>

                                        <strong>Sin logo</strong>

                                    </div>

                                @else

                                    <img id="logoPreviewImage"
                                         alt="Vista previa del logo"
                                         style="display:none">

                                    <div class="image-placeholder"
                                         id="logoPlaceholder">

                                        <div class="image-placeholder-icon">
                                            ◇
                                        </div>

                                        <strong>Sin logo configurado</strong>
                                        <span>Selecciona una imagen para visualizarla.</span>

                                    </div>

                                @endif

                            </div>

                            <input type="file"
                                   id="logo"
                                   name="logo"
                                   class="form-control image-file @error('logo') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png,.webp">

                            <span class="config-help">
                            JPG, JPEG, PNG o WEBP. Máximo 4 MB.
                        </span>

                            @error('logo')
                            <div class="config-error">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        {{-- PORTADA --}}

                        <div class="image-config-card">

                            <div class="image-config-title">
                                <strong>Imagen de portada</strong>
                                <span>Fondo principal de la landing page</span>
                            </div>

                            <div class="image-preview portada-preview"
                                 id="portadaPreview">

                                @if($configuracion?->imagen_portada)

                                    <img src="{{ asset('storage/' . $configuracion->imagen_portada) }}"
                                         id="portadaPreviewImage"
                                         alt="Portada de {{ $configuracion->nombre }}">

                                    <div class="image-placeholder"
                                         id="portadaPlaceholder"
                                         style="display:none">

                                        <div class="image-placeholder-icon">
                                            ▣
                                        </div>

                                        <strong>Sin portada</strong>

                                    </div>

                                @else

                                    <img id="portadaPreviewImage"
                                         alt="Vista previa de portada"
                                         style="display:none">

                                    <div class="image-placeholder"
                                         id="portadaPlaceholder">

                                        <div class="image-placeholder-icon">
                                            ▣
                                        </div>

                                        <strong>Sin imagen de portada</strong>
                                        <span>La imagen seleccionada aparecerá aquí.</span>

                                    </div>

                                @endif

                            </div>

                            <input type="file"
                                   id="imagen_portada"
                                   name="imagen_portada"
                                   class="form-control image-file @error('imagen_portada') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png,.webp">

                            <span class="config-help">
                            Se recomienda una imagen horizontal de buena resolución. Máximo 6 MB.
                        </span>

                            @error('imagen_portada')
                            <div class="config-error">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

            {{-- =====================================================
                 ACCIONES
            ====================================================== --}}

            <div class="config-form-actions">

            <span class="config-form-note">
                Los cambios guardados se reflejarán en el sitio público.
            </span>

                <div class="config-buttons">

                    <a href="{{ route('inicio') }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="btn-config-secondary">
                        Ver sitio
                    </a>

                    <button type="submit"
                            class="btn-config-primary">
                        Guardar cambios
                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const configurarPreview = (inputId, imageId, placeholderId) => {

                const input = document.getElementById(inputId);
                const image = document.getElementById(imageId);
                const placeholder = document.getElementById(placeholderId);

                input?.addEventListener('change', event => {

                    const file = event.target.files?.[0];

                    if (!file || !image) return;

                    const reader = new FileReader();

                    reader.onload = e => {

                        image.src = e.target.result;
                        image.style.display = 'block';

                        if (placeholder) {
                            placeholder.style.display = 'none';
                        }

                    };

                    reader.readAsDataURL(file);

                });

            };

            configurarPreview(
                'logo',
                'logoPreviewImage',
                'logoPlaceholder'
            );

            configurarPreview(
                'imagen_portada',
                'portadaPreviewImage',
                'portadaPlaceholder'
            );

        });
    </script>
@endpush
