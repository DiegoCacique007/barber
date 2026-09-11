<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $configuracion?->nombre ?? 'BARBER' }}</title>

    @vite([
        'resources/css/app.css',
        'resources/css/landing.css',
        'resources/js/app.js',
        'resources/js/landing.js'
    ])
</head>

<body>

<nav class="landing-navbar" id="navbar">
    <div class="container-fluid landing-container">

        <a href="#inicio" class="landing-logo">
            {{ strtoupper($configuracion?->nombre ?? 'BARBER') }}<span>.</span>
        </a>

        <button class="menu-toggle" id="menuToggle" type="button">
            ☰
        </button>

        <div class="landing-menu" id="landingMenu">
            <a href="#inicio">Inicio</a>
            <a href="#servicios">Cortes</a>
            <a href="#experiencia">Nosotros</a>
            <a href="#cita">Citas</a>
            <a href="#contacto">Contacto</a>

            <a href="#cita" class="nav-reservar">
                Reservar
            </a>
        </div>

    </div>
</nav>


<header
    id="inicio"
    class="hero"
    @if($configuracion?->imagen_portada)
        style="
            background-image:
            linear-gradient(
                90deg,
                rgba(5,5,5,.94),
                rgba(5,5,5,.48)
            ),
            url('{{ asset('storage/' . $configuracion->imagen_portada) }}');
        "
    @endif
>

    <div class="hero-noise"></div>

    <div class="container-fluid landing-container hero-content">

        <div class="hero-eyebrow reveal">
            Barbería · Estilo · Precisión
        </div>

        <h1 class="hero-title">
            <span>ESTILO QUE</span>
            <span>DEFINE TU</span>
            <span class="hero-accent">PRESENCIA.</span>
        </h1>

        <p class="hero-description reveal">
            {{ $configuracion?->eslogan ?? 'Cortes modernos, precisión y una experiencia diseñada para ti.' }}
        </p>

        <div class="hero-actions reveal">

            <a href="#cita" class="btn-premium">
                Agendar cita
                <span>→</span>
            </a>

            <a href="#servicios" class="btn-ghost">
                Ver cortes
            </a>

        </div>

    </div>

    <div class="hero-bottom">
        <span>Desliza para descubrir</span>
        <span class="scroll-line"></span>
    </div>

</header>


<section class="marquee-section">

    <div class="marquee-track">
        <span>
            PRECISIÓN · ESTILO · CARÁCTER · EXPERIENCIA ·
        </span>

        <span>
            PRECISIÓN · ESTILO · CARÁCTER · EXPERIENCIA ·
        </span>
    </div>

</section>


<section id="servicios" class="section section-services">

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
                    CORTES QUE<br>
                    <span>DEJAN MARCA.</span>
                </h2>

                <p>
                    Explora nuestros estilos y encuentra el corte que mejor
                    representa tu personalidad.
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

                        <a href="#cita" class="service-arrow">
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


<section id="experiencia" class="section experience-section">

    <div class="container-fluid landing-container experience-grid">

        <div class="experience-number">
            02
        </div>

        <div class="experience-content">

            <span class="section-eyebrow">
                La experiencia
            </span>

            <h2>
                MÁS QUE<br>
                <span>UN CORTE.</span>
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


<section id="cita" class="section booking-section">

    <div class="container-fluid landing-container">

        <div class="booking-grid">

            <div class="booking-info">

                <span class="section-number">
                    03
                </span>

                <span class="section-eyebrow">
                    Reserva
                </span>

                <h2>
                    ¿LISTO PARA<br>
                    TU PRÓXIMO<br>
                    <span>CORTE?</span>
                </h2>

                <p>
                    Selecciona la fecha y horario que prefieras.
                    Tu cita quedará pendiente hasta ser confirmada.
                </p>

            </div>


            <div class="booking-form-wrapper">

                @if(session('success'))

                    <div class="booking-success">
                        <span>✓</span>
                        {{ session('success') }}
                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ route('citas.publica.store') }}"
                    class="booking-form"
                >

                    @csrf


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
                            required
                        >

                        @error('nombre_cliente')
                        <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


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
                            required
                        >

                        @error('telefono')
                        <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <div class="form-premium">

                        <label for="correo">
                            Correo
                        </label>

                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            value="{{ old('correo') }}"
                            placeholder="correo@ejemplo.com"
                            maxlength="150"
                        >

                        @error('correo')
                        <span class="form-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


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
                        <span>→</span>
                    </button>

                </form>

            </div>

        </div>

    </div>

</section>


<section id="contacto" class="section contact-section">

    <div class="container-fluid landing-container">

        <div class="contact-grid">

            <div>

                <span class="section-number">
                    04
                </span>

                <h2>
                    VEN A<br>
                    <span>CONOCERNOS.</span>
                </h2>

            </div>


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
                            {{ $configuracion->telefono }}
                        </strong>

                    </div>

                @endif


                @if($configuracion?->correo)

                    <div class="contact-item">

                        <span>
                            Correo
                        </span>

                        <strong>
                            {{ $configuracion->correo }}
                        </strong>

                    </div>

                @endif


                @if($configuracion?->whatsapp)

                    <div class="contact-item">

                        <span>
                            WhatsApp
                        </span>

                        <strong>
                            {{ $configuracion->whatsapp }}
                        </strong>

                    </div>

                @endif

            </div>


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

                                {{ \Carbon\Carbon::parse($horario->hora_apertura)->format('H:i') }}
                                —
                                {{ \Carbon\Carbon::parse($horario->hora_cierre)->format('H:i') }}

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


<footer class="landing-footer">

    <div class="container-fluid landing-container">

        <div class="footer-main">

            <div class="footer-brand">
                {{ strtoupper($configuracion?->nombre ?? 'BARBER') }}<span>.</span>
            </div>


            <div class="footer-social">

                @foreach($redes as $red)

                    <a
                        href="{{ $red->url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        {{ $red->nombre }}
                    </a>

                @endforeach

            </div>

        </div>


        <div class="footer-bottom">

            <span>
                © {{ date('Y') }}
                {{ $configuracion?->nombre ?? 'Barber' }}.
                Todos los derechos reservados.
            </span>

            <a href="#inicio">
                Volver arriba ↑
            </a>

        </div>

    </div>

</footer>

</body>
</html>
