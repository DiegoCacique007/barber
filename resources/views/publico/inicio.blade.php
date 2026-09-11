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

    <title>
        {{ $configuracion?->nombre ?? 'BARBER' }}
    </title>

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

    <style>

        /* =====================================================
           CONFIGURACIÓN GENERAL
        ====================================================== */

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
           HERO - COMPUTADORA
        ====================================================== */

        .hero {
            position: relative;

            width: 100%;

            /*
             * La portada ocupa exactamente toda
             * la pantalla visible.
             */
            min-height: 100vh !important;
            min-height: 100dvh !important;

            height: 100vh !important;
            height: 100dvh !important;

            box-sizing: border-box;

            display: flex !important;
            align-items: center !important;

            /*
             * Espacio para navbar + contenido.
             */
            padding-top: 100px !important;
            padding-bottom: 42px !important;

            overflow: hidden;

            background-position: center center !important;
            background-size: cover !important;
            background-repeat: no-repeat !important;
        }


        /* =====================================================
           OSCURECIMIENTO DE PORTADA
        ====================================================== */

        .hero::after {
            content: "";

            position: absolute;
            inset: 0;

            z-index: 0;

            pointer-events: none;

            background:
                linear-gradient(
                    180deg,
                    rgba(0, 0, 0, .03) 0%,
                    rgba(0, 0, 0, .08) 48%,
                    rgba(0, 0, 0, .48) 100%
                );
        }


        .hero-noise {
            position: absolute;
            inset: 0;

            z-index: 1;

            pointer-events: none;
        }


        /* =====================================================
           CONTENIDO DEL HERO
        ====================================================== */

        .hero .hero-content {
            position: relative !important;

            z-index: 3 !important;

            width: 100%;
            height: 100%;

            min-height: 0 !important;

            display: flex;
            flex-direction: column;

            justify-content: center;

            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }


        /* =====================================================
           TEXTO SUPERIOR
        ====================================================== */

        .hero-eyebrow {
            position: relative;

            z-index: 3;

            margin-bottom: clamp(
                14px,
                2vh,
                22px
            ) !important;
        }


        /* =====================================================
           TÍTULO PRINCIPAL
        ====================================================== */

        .hero-title {
            position: relative;

            z-index: 3;

            width: 100%;
            max-width: 1100px;

            /*
             * Se adapta tanto al ancho como
             * a la altura de la pantalla.
             */
            font-size: clamp(
                4.8rem,
                min(8.2vw, 13.5vh),
                8.5rem
            ) !important;

            line-height: .78 !important;

            letter-spacing: -.055em;

            margin: 0 !important;

            overflow: visible !important;
        }


        .hero-title span {
            display: block;

            width: fit-content;

            max-width: 100%;
        }


        /* =====================================================
           DESCRIPCIÓN
        ====================================================== */

        .hero-description {
            position: relative;

            z-index: 3;

            width: min(100%, 620px);

            margin-top: clamp(
                18px,
                2.8vh,
                28px
            ) !important;

            margin-bottom: 0 !important;

            font-size: clamp(
                1rem,
                1.1vw,
                1.16rem
            );

            line-height: 1.5;
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

            margin-top: clamp(
                22px,
                3.8vh,
                34px
            ) !important;

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

            padding: 0 30px !important;

            white-space: nowrap;

            text-decoration: none;

            opacity: 1 !important;
            visibility: visible !important;

            transform: none !important;
        }


        .hero-actions .btn-premium {
            min-width: 285px;

            gap: 35px;
        }


        .hero-actions .btn-ghost {
            min-width: 185px;
        }


        .hero-actions .btn-premium span:last-child {
            transition: transform .25s ease;
        }


        .hero-actions .btn-premium:hover span:last-child {
            transform: translateX(5px);
        }


        /* =====================================================
           MARQUEE
        ====================================================== */

        .marquee-section {
            position: relative !important;

            z-index: 5 !important;

            /*
             * Comienza después de la pantalla completa
             * del Hero.
             */
            margin-top: 0 !important;
        }


        /* =====================================================
           LAPTOPS CON MENOR ALTURA
        ====================================================== */

        @media (min-width: 1200px) and (max-height: 820px) {

            .hero {
                min-height: 100vh !important;
                min-height: 100dvh !important;

                height: 100vh !important;
                height: 100dvh !important;

                padding-top: 88px !important;
                padding-bottom: 30px !important;
            }


            .hero-title {
                font-size: clamp(
                    4.4rem,
                    min(7.6vw, 12.5vh),
                    7.2rem
                ) !important;

                line-height: .77 !important;
            }


            .hero-eyebrow {
                margin-bottom: 12px !important;
            }


            .hero-description {
                margin-top: 16px !important;
            }


            .hero-actions {
                margin-top: 20px !important;
            }


            .hero-actions .btn-premium,
            .hero-actions .btn-ghost {
                min-height: 50px;
            }

        }


        /* =====================================================
           LAPTOPS / TABLETS HORIZONTALES
        ====================================================== */

        @media (min-width: 992px) and (max-width: 1199.98px) {

            .hero {
                min-height: 100vh !important;
                min-height: 100dvh !important;

                height: 100vh !important;
                height: 100dvh !important;

                padding-top: 95px !important;
                padding-bottom: 35px !important;
            }


            .hero-title {
                font-size: clamp(
                    4.2rem,
                    min(8.5vw, 12.5vh),
                    7rem
                ) !important;
            }


            .hero-description {
                margin-top: 20px !important;
            }


            .hero-actions {
                margin-top: 24px !important;
            }

        }


        /* =====================================================
           TABLET / CELULAR
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
                /*
                 * En móvil no usamos altura rígida
                 * para evitar cortar contenido.
                 */
                min-height: 100svh !important;
                min-height: 100dvh !important;

                height: auto !important;

                align-items: center !important;

                padding-top: 105px !important;
                padding-bottom: 60px !important;

                background-position: center center !important;
            }


            .hero .hero-content {
                height: auto;

                justify-content: center;
            }


            .hero-eyebrow {
                margin-bottom: 17px !important;
            }


            .hero-title {
                width: 100%;

                font-size: clamp(
                    3.7rem,
                    min(14vw, 12.5vh),
                    6.6rem
                ) !important;

                line-height: .81 !important;

                letter-spacing: -.05em;
            }


            .hero-description {
                width: min(100%, 540px);

                margin-top: 25px !important;

                font-size: 1rem;
            }


            .hero-actions {
                margin-top: 30px !important;

                gap: 12px !important;
            }


            .hero-actions .btn-premium {
                min-width: 215px;
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
                min-height: 100dvh !important;

                height: auto !important;

                padding-top: 92px !important;
                padding-bottom: 48px !important;

                background-position: 55% center !important;
            }


            .hero .hero-content {
                width: 100%;

                height: auto;
            }


            .hero-eyebrow {
                margin-bottom: 14px !important;

                font-size: .70rem;

                letter-spacing: .14em;
            }


            .hero-title {
                width: 100%;

                font-size: clamp(
                    3.2rem,
                    15vw,
                    5rem
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

                margin-top: 22px !important;

                font-size: .94rem;

                line-height: 1.5;
            }


            /*
             * Mantiene ambos botones juntos
             * en una sola fila.
             */
            .hero-actions {
                width: 100%;

                display: grid !important;

                grid-template-columns:
                    minmax(0, 1.45fr)
                    minmax(0, 1fr) !important;

                gap: 10px !important;

                margin-top: 26px !important;
            }


            .hero-actions .btn-premium,
            .hero-actions .btn-ghost {
                width: 100% !important;

                min-width: 0 !important;
                min-height: 50px;

                padding: 0 14px !important;

                font-size: .90rem;
            }


            .hero-actions .btn-premium {
                justify-content: space-between !important;

                gap: 10px;
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
                padding-top: 88px !important;
                padding-bottom: 42px !important;
            }


            .hero-title {
                font-size: clamp(
                    2.9rem,
                    14.7vw,
                    3.9rem
                ) !important;

                line-height: .84 !important;
            }


            .hero-description {
                margin-top: 18px !important;

                font-size: .88rem;
            }


            .hero-actions {
                margin-top: 22px !important;
            }


            .hero-actions .btn-premium,
            .hero-actions .btn-ghost {
                min-height: 47px;

                padding: 0 10px !important;

                font-size: .82rem;
            }

        }


        /* =====================================================
           CELULARES CON MUY POCA ALTURA
        ====================================================== */

        @media (max-width: 575.98px) and (max-height: 700px) {

            .hero {
                padding-top: 82px !important;
                padding-bottom: 35px !important;
            }


            .hero-title {
                font-size: clamp(
                    2.8rem,
                    13vw,
                    3.8rem
                ) !important;
            }


            .hero-eyebrow {
                margin-bottom: 10px !important;
            }


            .hero-description {
                margin-top: 16px !important;
            }


            .hero-actions {
                margin-top: 18px !important;
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

                <span class="nav-text">
                    Inicio
                </span>

            </a>


            <a
                href="#servicios"
                class="nav-link-premium"
                data-section="servicios"
            >

                <span class="nav-text">
                    Cortes
                </span>

            </a>


            <a
                href="#experiencia"
                class="nav-link-premium"
                data-section="experiencia"
            >

                <span class="nav-text">
                    Nosotros
                </span>

            </a>


            <a
                href="#cita"
                class="nav-link-premium"
                data-section="cita"
            >

                <span class="nav-text">
                    Citas
                </span>

            </a>


            <a
                href="#contacto"
                class="nav-link-premium"
                data-section="contacto"
            >

                <span class="nav-text">
                    Contacto
                </span>

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

                <span>
                    Agendar cita
                </span>

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


                            <a
                                href="mailto:{{ $configuracion->correo }}"
                            >

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
