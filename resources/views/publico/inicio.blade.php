<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, viewport-fit=cover"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <meta
        name="description"
        content="{{ $configuracion?->descripcion ?? 'Barbería profesional, cortes modernos y atención personalizada.' }}"
    >

    <title>{{ $configuracion?->nombre ?? 'BARBER' }}</title>

    @if($configuracion?->logo)
        <link
            rel="icon"
            type="image/png"
            href="{{ asset('storage/' . $configuracion->logo) }}"
        >
    @endif

    @vite([
        'resources/css/app.css',
        'resources/css/landing.css',
        'resources/js/app.js',
        'resources/js/landing.js'
    ])

    {{-- =====================================================
         AJUSTES RESPONSIVOS DEL INICIO / HERO
    ====================================================== --}}
    <style>
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 95px;
        }

        body {
            overflow-x: hidden;
        }

        #inicio,
        #servicios,
        #experiencia,
        #cita,
        #contacto {
            scroll-margin-top: 95px;
        }

        /* =====================================================
           HERO
        ====================================================== */

        .hero {
            position: relative;
            width: 100%;

            /*
             * Evita que el Hero termine antes de que
             * aparezcan completamente los botones.
             */
            min-height: calc(100svh - 95px) !important;
            height: auto !important;

            display: flex !important;
            align-items: center !important;

            padding-top: clamp(80px, 9vh, 125px) !important;
            padding-bottom: clamp(70px, 10vh, 120px) !important;

            overflow: hidden;

            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;

            background:
                linear-gradient(
                    180deg,
                    rgba(0, 0, 0, .04) 0%,
                    rgba(0, 0, 0, .08) 55%,
                    rgba(0, 0, 0, .40) 100%
                );
        }

        .hero-noise {
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
        }

        .hero .hero-content {
            position: relative !important;
            z-index: 3 !important;

            width: 100%;
            min-height: 0 !important;

            display: flex;
            flex-direction: column;
            justify-content: center;

            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        /* =====================================================
           TEXTO DEL HERO
        ====================================================== */

        .hero-eyebrow {
            position: relative;
            z-index: 3;

            margin-bottom: clamp(18px, 2.2vh, 28px);
        }

        .hero-title {
            position: relative;
            z-index: 3;

            width: 100%;
            max-width: 1200px;

            /*
             * Sigue siendo grande, pero ahora toma también
             * como referencia la altura de pantalla.
             */
            font-size: clamp(
                5rem,
                min(10.5vw, 17vh),
                10rem
            ) !important;

            line-height: .79 !important;
            letter-spacing: -.055em;

            margin: 0 !important;

            overflow: visible !important;
        }

        .hero-title span {
            display: block;
            width: fit-content;
            max-width: 100%;
        }

        .hero-description {
            position: relative;
            z-index: 3;

            width: min(100%, 650px);

            margin-top: clamp(28px, 4vh, 42px) !important;
            margin-bottom: 0 !important;

            font-size: clamp(1rem, 1.3vw, 1.2rem);
            line-height: 1.6;
        }

        /* =====================================================
           BOTONES DEL HERO
        ====================================================== */

        .hero-actions {
            position: relative !important;
            z-index: 20 !important;

            width: 100%;

            display: flex !important;
            align-items: center !important;
            flex-wrap: wrap !important;

            gap: 18px !important;

            margin-top: clamp(30px, 5vh, 50px) !important;
            margin-bottom: 0 !important;

            transform: none !important;
        }

        .hero-actions .btn-premium,
        .hero-actions .btn-ghost {
            position: relative !important;
            z-index: 21 !important;

            min-height: 54px;

            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;

            gap: 25px;

            padding: 0 30px !important;

            white-space: nowrap;

            text-decoration: none;

            opacity: 1 !important;
            visibility: visible !important;

            transform: none !important;
        }

        .hero-actions .btn-premium {
            min-width: 245px;
        }

        .hero-actions .btn-ghost {
            min-width: 155px;
        }

        .hero-actions .btn-premium span {
            transition: transform .25s ease;
        }

        .hero-actions .btn-premium:hover span {
            transform: translateX(5px);
        }

        /*
         * Importante:
         * evita que la marquesina se monte encima de los botones.
         */
        .marquee-section {
            position: relative !important;
            z-index: 5 !important;

            margin-top: 0 !important;
        }

        /* =====================================================
           TABLETS
        ====================================================== */

        @media (max-width: 1199.98px) {
            .hero {
                min-height: calc(100svh - 85px) !important;

                padding-top: 100px !important;
                padding-bottom: 80px !important;
            }

            .hero-title {
                font-size: clamp(
                    4.8rem,
                    min(10vw, 15vh),
                    8rem
                ) !important;
            }
        }

        /* =====================================================
           CELULAR / TABLET VERTICAL
        ====================================================== */

        @media (max-width: 991.98px) {
            html {
                scroll-padding-top: 76px;
            }

            #inicio,
            #servicios,
            #experiencia,
            #cita,
            #contacto {
                scroll-margin-top: 76px;
            }

            .hero {
                min-height: 100svh !important;

                align-items: center !important;

                padding-top: 105px !important;
                padding-bottom: 65px !important;

                background-position: center center !important;
            }

            .hero .hero-content {
                justify-content: center;
            }

            .hero-eyebrow {
                margin-bottom: 18px;
            }

            .hero-title {
                width: 100%;

                font-size: clamp(
                    3.8rem,
                    min(14vw, 13vh),
                    6.8rem
                ) !important;

                line-height: .81 !important;
                letter-spacing: -.05em;
            }

            .hero-description {
                width: min(100%, 540px);

                margin-top: 27px !important;

                font-size: 1rem;
            }

            .hero-actions {
                margin-top: 32px !important;
                gap: 12px !important;
            }

            .hero-actions .btn-premium {
                min-width: 210px;
            }

            .hero-actions .btn-ghost {
                min-width: 145px;
            }
        }

        /* =====================================================
           CELULAR VERTICAL
        ====================================================== */

        @media (max-width: 575.98px) {
            .hero {
                min-height: 100svh !important;

                padding-top: 95px !important;
                padding-bottom: 50px !important;

                background-position: 55% center !important;
            }

            .hero .hero-content {
                width: 100%;
            }

            .hero-eyebrow {
                margin-bottom: 15px;

                font-size: .70rem;
                letter-spacing: .14em;
            }

            .hero-title {
                width: 100%;

                /*
                 * Grande en celular, pero sin salirse
                 * horizontalmente.
                 */
                font-size: clamp(
                    3.35rem,
                    15.2vw,
                    5.1rem
                ) !important;

                line-height: .83 !important;
                letter-spacing: -.052em;
            }

            .hero-title span {
                width: 100%;
                max-width: 100%;
            }

            .hero-description {
                width: 100%;
                max-width: 410px;

                margin-top: 24px !important;

                font-size: .96rem;
                line-height: 1.55;
            }

            /*
             * Los dos botones permanecen visibles
             * y acomodados al ancho de celular.
             */
            .hero-actions {
                width: 100%;

                display: grid !important;
                grid-template-columns: minmax(0, 1.45fr) minmax(0, 1fr) !important;

                gap: 10px !important;

                margin-top: 28px !important;
            }

            .hero-actions .btn-premium,
            .hero-actions .btn-ghost {
                width: 100% !important;
                min-width: 0 !important;
                min-height: 52px;

                padding: 0 14px !important;

                font-size: .91rem;

                gap: 13px;
            }

            .hero-actions .btn-premium {
                justify-content: space-between !important;
            }

            .hero-actions .btn-ghost {
                justify-content: center !important;
            }
        }

        /* =====================================================
           CELULARES PEQUEÑOS
        ====================================================== */

        @media (max-width: 390px) {
            .hero {
                padding-top: 90px !important;
                padding-bottom: 44px !important;
            }

            .hero-title {
                font-size: clamp(
                    3rem,
                    14.8vw,
                    4rem
                ) !important;

                line-height: .84 !important;
            }

            .hero-description {
                margin-top: 20px !important;
                font-size: .90rem;
            }

            .hero-actions {
                margin-top: 24px !important;
            }

            .hero-actions .btn-premium,
            .hero-actions .btn-ghost {
                min-height: 49px;
                padding: 0 11px !important;
                font-size: .84rem;
            }
        }

        /* =====================================================
           PANTALLAS CON POCA ALTURA
        ====================================================== */

        @media (min-width: 992px) and (max-height: 760px) {
            .hero {
                min-height: calc(100svh - 85px) !important;

                padding-top: 65px !important;
                padding-bottom: 60px !important;
            }

            .hero-title {
                font-size: clamp(
                    4.8rem,
                    min(9vw, 15vh),
                    8rem
                ) !important;
            }

            .hero-description {
                margin-top: 24px !important;
            }

            .hero-actions {
                margin-top: 28px !important;
            }
        }
    </style>

</head>

<body>

{{-- =========================================================
     NAVBAR
========================================================= --}}

<nav
    class="landing-navbar"
    id="navbar"
>
    <div class="container-fluid landing-container">

        {{-- LOGO --}}
        <a
            href="#inicio"
            class="landing-logo"
        >
            @if($configuracion?->logo)
                <img
                    src="{{ asset('storage/' . $configuracion->logo) }}"
                    alt="{{ $configuracion->nombre ?? 'Barber' }}"
                    class="navbar-logo-image"
                >
            @endif

            <span class="navbar-brand-text">
                {{ strtoupper($configuracion?->nombre ?? 'BARBER') }}
                <strong>.</strong>
            </span>
        </a>

        {{-- BOTÓN MÓVIL --}}
        <button
            class="menu-toggle"
            id="menuToggle"
            type="button"
            aria-label="Abrir menú"
            aria-expanded="false"
            aria-controls="landingMenu"
        >
            ☰
        </button>

        {{-- MENÚ --}}
        <div
            class="landing-menu"
            id="landingMenu"
        >
            <a
                href="#inicio"
                class="nav-link-premium active"
                data-section="inicio"
            >
                <span class="nav-text">Inicio</span>
            </a>

            <a
                href="#servicios"
                class="nav-link-premium"
                data-section="servicios"
            >
                <span class="nav-text">Cortes</span>
            </a>

            <a
                href="#experiencia"
                class="nav-link-premium"
                data-section="experiencia"
            >
                <span class="nav-text">Nosotros</span>
            </a>

            <a
                href="#cita"
                class="nav-link-premium"
                data-section="cita"
            >
                <span class="nav-text">Citas</span>
            </a>

            <a
                href="#contacto"
                class="nav-link-premium"
                data-section="contacto"
            >
                <span class="nav-text">Contacto</span>
            </a>

            <a
                href="#cita"
                class="nav-reservar"
            >
                <span class="nav-reservar-text">
                    Reservar
                </span>

                <span class="nav-reservar-arrow">
                    ↗
                </span>
            </a>
        </div>

    </div>
</nav>


{{-- =========================================================
     HERO
========================================================= --}}

<header
    id="inicio"
    class="hero"

    @if($configuracion?->imagen_portada)
        style="
            background-image:
            linear-gradient(
                90deg,
                rgba(5,5,5,.94) 0%,
                rgba(5,5,5,.68) 42%,
                rgba(5,5,5,.30) 100%
            ),
            url('{{ asset('storage/' . $configuracion->imagen_portada) }}');
        "
    @endif
>

    <div class="hero-noise"></div>

    <div class="container-fluid landing-container hero-content">

        <div class="hero-eyebrow">
            {{ $configuracion?->nombre ?? 'Barbería' }}
            · Estilo · Precisión
        </div>

        <h1 class="hero-title">

            <span>
                ESTILO QUE
            </span>

            <span>
                DEFINE TU
            </span>

            <span class="hero-accent">
                PRESENCIA.
            </span>

        </h1>

        <p class="hero-description">
            {{ $configuracion?->eslogan ?? 'Cortes modernos, precisión y una experiencia diseñada para ti.' }}
        </p>

        <div class="hero-actions">

            <a
                href="#cita"
                class="btn-premium"
            >
                <span>Agendar cita</span>

                <span aria-hidden="true">
                    →
                </span>
            </a>

            <a
                href="#servicios"
                class="btn-ghost"
            >
                Ver cortes
            </a>

        </div>

    </div>

</header>


{{-- =========================================================
     MARQUEE
========================================================= --}}

<section class="marquee-section">

    <div class="marquee-track">

        <span>
            PRECISIÓN · ESTILO · CARÁCTER · EXPERIENCIA ·
        </span>

        <span>
            PRECISIÓN · ESTILO · CARÁCTER · EXPERIENCIA ·
        </span>

        <span>
            PRECISIÓN · ESTILO · CARÁCTER · EXPERIENCIA ·
        </span>

        <span>
            PRECISIÓN · ESTILO · CARÁCTER · EXPERIENCIA ·
        </span>

    </div>

</section>


{{-- =========================================================
     SERVICIOS
========================================================= --}}

<section
    id="servicios"
    class="section section-services"
>

    <div class="container-fluid landing-container">

        <div class="section-header">

            <div>

                <span class="section-number">
                    01
                </span>

                <span class="section-eyebrow">
                    Nuestros servicios
                </span>

            </div>

            <div>

                <h2>
                    CORTES QUE

                    <br>

                    <span>
                        DEJAN MARCA.
                    </span>
                </h2>

                <p>
                    Explora nuestros estilos y encuentra el corte
                    que mejor representa tu personalidad.
                </p>

            </div>

        </div>


        <div class="services-grid">

            @forelse($servicios as $servicio)

                <article class="service-card">

                    <div class="service-image">

                        @if($servicio->imagen)

                            <img
                                src="{{ asset('storage/' . $servicio->imagen) }}"
                                alt="{{ $servicio->nombre }}"
                                loading="lazy"
                            >

                        @else

                            <div class="service-placeholder">
                                ✂
                            </div>

                        @endif

                        <div class="service-overlay"></div>

                        <div class="service-price">
                            ${{ number_format($servicio->precio, 2) }}
                        </div>

                    </div>

                    <div class="service-content">

                        <div>

                            <h3>
                                {{ $servicio->nombre }}
                            </h3>

                            <p>
                                {{ $servicio->descripcion ?: 'Servicio profesional de barbería.' }}
                            </p>

                        </div>

                        <a
                            href="#cita"
                            class="service-arrow"
                            aria-label="Reservar cita"
                        >
                            →
                        </a>

                    </div>

                </article>

            @empty

                <div class="empty-services">
                    Próximamente nuevos estilos.
                </div>

            @endforelse

        </div>

    </div>

</section>


{{-- =========================================================
     EXPERIENCIA
========================================================= --}}

<section
    id="experiencia"
    class="section experience-section"
>

    <div class="container-fluid landing-container experience-grid">

        <div class="experience-number">
            02
        </div>

        <div class="experience-content">

            <span class="section-eyebrow">
                La experiencia
            </span>

            <h2>
                MÁS QUE

                <br>

                <span>
                    UN CORTE.
                </span>
            </h2>

            <p>
                {{ $configuracion?->descripcion ?? 'Cada detalle cuenta. Desde el momento en que llegas hasta el acabado final, buscamos ofrecer una experiencia cómoda, moderna y personalizada.' }}
            </p>

            <div class="experience-line"></div>

        </div>

        <div class="experience-quote">

            <span>
                “
            </span>

            Tu estilo habla antes que tú.

        </div>

    </div>

</section>


{{-- =========================================================
     RESERVACIÓN
========================================================= --}}

<section
    id="cita"
    class="section booking-section"
>

    <div class="container-fluid landing-container">

        <div class="booking-grid">

            {{-- INFORMACIÓN --}}
            <div class="booking-info">

                <span class="section-number">
                    03
                </span>

                <span class="section-eyebrow">
                    Reserva
                </span>

                <h2>
                    ¿LISTO PARA

                    <br>

                    TU PRÓXIMO

                    <br>

                    <span>
                        CORTE?
                    </span>
                </h2>

                <p>
                    Selecciona la fecha y horario que prefieras.
                    Tu solicitud quedará pendiente hasta ser confirmada
                    por la barbería.
                </p>

            </div>


            {{-- FORMULARIO --}}
            <div class="booking-form-wrapper">

                @if(session('success'))

                    <div class="booking-success">

                        <span>
                            ✓
                        </span>

                        {{ session('success') }}

                    </div>

                @endif

                <form
                    method="POST"
                    action="{{ route('citas.publica.store') }}"
                    class="booking-form"
                >

                    @csrf

                    {{-- NOMBRE --}}
                    <div class="form-premium">

                        <label for="nombre_cliente">
                            Nombre
                        </label>

                        <input
                            type="text"
                            id="nombre_cliente"
                            name="nombre_cliente"
                            value="{{ old('nombre_cliente') }}"
                            placeholder="Tu nombre completo"
                            maxlength="120"
                            autocomplete="name"
                            required
                        >

                        @error('nombre_cliente')
                        <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- TELÉFONO --}}
                    <div class="form-premium">

                        <label for="telefono">
                            Teléfono
                        </label>

                        <input
                            type="tel"
                            id="telefono"
                            name="telefono"
                            value="{{ old('telefono') }}"
                            placeholder="722 123 4567"
                            maxlength="20"
                            autocomplete="tel"
                            inputmode="tel"
                            required
                        >

                        @error('telefono')
                        <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- FECHA --}}
                    <div class="form-premium">

                        <label for="fecha">
                            Fecha
                        </label>

                        <input
                            type="date"
                            id="fecha"
                            name="fecha"
                            value="{{ old('fecha') }}"
                            min="{{ now()->format('Y-m-d') }}"
                            required
                        >

                        @error('fecha')
                        <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- HORARIOS --}}
                    <div class="form-premium">

                        <label>
                            Horario disponible
                        </label>

                        <input
                            type="hidden"
                            id="hora"
                            name="hora"
                            value="{{ old('hora') }}"
                        >

                        <div
                            id="horariosDisponibles"
                            class="horarios-grid"
                            data-url="{{ route('citas.horarios') }}"
                        >

                            <span class="horarios-mensaje">
                                Selecciona primero una fecha.
                            </span>

                        </div>

                        @error('hora')
                        <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <button
                        type="submit"
                        id="botonReservar"
                        class="btn-premium booking-button"
                    >
                        Solicitar cita

                        <span>
                            →
                        </span>
                    </button>

                </form>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     CONTACTO
========================================================= --}}

<section
    id="contacto"
    class="section contact-section"
>

    <div class="container-fluid landing-container">

        <div class="contact-grid">

            {{-- ENCABEZADO --}}
            <div>

                <span class="section-number">
                    04
                </span>

                <h2>
                    VEN A

                    <br>

                    <span>
                        CONOCERNOS.
                    </span>
                </h2>

            </div>


            {{-- DATOS DE CONTACTO --}}
            <div class="contact-details">

                @if($configuracion?->direccion)

                    <div class="contact-item">

                        <span>
                            Dirección
                        </span>

                        <strong>
                            {{ $configuracion->direccion }}
                        </strong>

                    </div>

                @endif


                @if($configuracion?->telefono)

                    <div class="contact-item">

                        <span>
                            Teléfono
                        </span>

                        <strong>

                            <a
                                href="tel:{{ preg_replace('/[^0-9+]/', '', $configuracion->telefono) }}"
                            >
                                {{ $configuracion->telefono }}
                            </a>

                        </strong>

                    </div>

                @endif


                @if($configuracion?->whatsapp)

                    <div class="contact-item">

                        <span>
                            WhatsApp
                        </span>

                        <strong>

                            <a
                                href="https://wa.me/{{ preg_replace('/\D/', '', $configuracion->whatsapp) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                {{ $configuracion->whatsapp }}
                            </a>

                        </strong>

                    </div>

                @endif


                @if($configuracion?->correo)

                    <div class="contact-item">

                        <span>
                            Correo
                        </span>

                        <strong>

                            <a href="mailto:{{ $configuracion->correo }}">
                                {{ $configuracion->correo }}
                            </a>

                        </strong>

                    </div>

                @endif

            </div>


            {{-- HORARIOS --}}
            <div class="schedule">

                <span class="schedule-title">
                    Horarios
                </span>

                @php
                    $dias = [
                        1 => 'Lunes',
                        2 => 'Martes',
                        3 => 'Miércoles',
                        4 => 'Jueves',
                        5 => 'Viernes',
                        6 => 'Sábado',
                        7 => 'Domingo',
                    ];
                @endphp

                @forelse($horarios as $horario)

                    <div class="schedule-row">

                        <span>
                            {{ $dias[$horario->dia_semana] ?? '' }}
                        </span>

                        <span>

                            @if($horario->cerrado)

                                Cerrado

                            @else

                                {{ \Carbon\Carbon::parse($horario->hora_apertura)->format('h:i A') }}

                                —

                                {{ \Carbon\Carbon::parse($horario->hora_cierre)->format('h:i A') }}

                            @endif

                        </span>

                    </div>

                @empty

                    <div class="schedule-row">

                        <span>
                            Horarios no disponibles
                        </span>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     FOOTER
========================================================= --}}

<footer class="landing-footer">

    <div class="container-fluid landing-container">

        <div class="footer-main">

            {{-- MARCA --}}
            <div class="footer-brand">

                @if($configuracion?->logo)

                    <img
                        src="{{ asset('storage/' . $configuracion->logo) }}"
                        alt="{{ $configuracion->nombre ?? 'Barber' }}"
                        class="footer-logo-image"
                    >

                @endif

                {{ strtoupper($configuracion?->nombre ?? 'BARBER') }}

                <span>
                    .
                </span>

            </div>


            {{-- REDES SOCIALES --}}
            <div class="footer-social">

                @forelse($redes as $red)

                    <a
                        href="{{ $red->url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        {{ $red->nombre }}
                    </a>

                @empty
                @endforelse

            </div>

        </div>


        <div class="footer-bottom">

            <span>
                © {{ date('Y') }}
                {{ $configuracion?->nombre ?? 'Barber' }}.
                Todos los derechos reservados.
            </span>

        </div>

    </div>

</footer>

</body>
</html>
