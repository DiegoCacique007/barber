<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>Acceso administrativo | Barber</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            overflow-x: hidden;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 24px;
            background:
                radial-gradient(
                    circle at 20% 20%,
                    rgba(201, 162, 77, 0.10),
                    transparent 35%
                ),
                radial-gradient(
                    circle at 80% 80%,
                    rgba(201, 162, 77, 0.06),
                    transparent 30%
                ),
                #090909;
        }

        .login-page::before {
            content: "";
            position: absolute;
            inset: 0;
            opacity: .25;
            pointer-events: none;
            background-image:
                linear-gradient(
                    rgba(255,255,255,.015) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(255,255,255,.015) 1px,
                    transparent 1px
                );
            background-size: 50px 50px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            border: 1px solid var(--barber-border);
            border-radius: 28px;
            overflow: hidden;
            background: rgba(18, 18, 18, .92);
            box-shadow: 0 40px 100px rgba(0, 0, 0, .55);
            backdrop-filter: blur(16px);
        }

        .login-brand {
            position: relative;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            background:
                linear-gradient(
                    135deg,
                    rgba(201, 162, 77, .18),
                    rgba(10, 10, 10, .15)
                ),
                #101010;
        }

        .login-brand::after {
            content: "B";
            position: absolute;
            right: -35px;
            bottom: -125px;
            font-size: 420px;
            font-weight: 900;
            line-height: 1;
            color: rgba(255, 255, 255, .025);
            pointer-events: none;
        }

        .brand-badge {
            width: fit-content;
            padding: 8px 14px;
            border: 1px solid rgba(201, 162, 77, .35);
            border-radius: 999px;
            color: var(--barber-gold-light);
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .brand-title {
            max-width: 500px;
        }

        .brand-title h1 {
            margin: 0 0 20px;
            font-size: clamp(48px, 6vw, 78px);
            line-height: .95;
            font-weight: 800;
            letter-spacing: -3px;
        }

        .brand-title h1 span {
            color: var(--barber-gold);
        }

        .brand-title p {
            max-width: 430px;
            margin: 0;
            color: #b0b0b0;
            font-size: 15px;
            line-height: 1.8;
        }

        .brand-footer {
            font-size: 12px;
            color: #777;
            letter-spacing: .5px;
        }

        .login-form-area {
            padding: 60px 50px;
            display: flex;
            align-items: center;
            background: rgba(10, 10, 10, .95);
        }

        .login-form-content {
            width: 100%;
        }

        .login-form-content h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-subtitle {
            margin-bottom: 36px;
            color: var(--barber-muted);
            font-size: 14px;
        }

        .form-label {
            color: #cfcfcf;
            font-size: 13px;
            margin-bottom: 9px;
        }

        .barber-input {
            height: 54px;
            border-radius: 12px;
            border: 1px solid var(--barber-border);
            background: var(--barber-surface);
            color: white;
            transition: .25s ease;
        }

        .barber-input:focus {
            color: white;
            background: var(--barber-surface-soft);
            border-color: var(--barber-gold);
            box-shadow: 0 0 0 4px rgba(201, 162, 77, .10);
        }

        .barber-input::placeholder {
            color: #656565;
        }

        .form-check-input {
            background-color: #151515;
            border-color: #444;
        }

        .form-check-input:checked {
            background-color: var(--barber-gold);
            border-color: var(--barber-gold);
        }

        .form-check-label {
            font-size: 13px;
            color: #aaa;
        }

        .btn-barber {
            width: 100%;
            height: 55px;
            border: 0;
            border-radius: 12px;
            background: var(--barber-gold);
            color: #0b0b0b;
            font-weight: 700;
            letter-spacing: .4px;
            transition: .25s ease;
        }

        .btn-barber:hover {
            background: var(--barber-gold-light);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(201, 162, 77, .18);
        }

        .alert-barber {
            background: rgba(220, 53, 69, .08);
            color: #ff9aa5;
            border: 1px solid rgba(220, 53, 69, .25);
            border-radius: 12px;
            font-size: 13px;
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            margin-top: 28px;
            color: #777;
            font-size: 13px;
            transition: .2s ease;
        }

        .back-home:hover {
            color: var(--barber-gold);
        }

        @media (max-width: 900px) {
            .login-wrapper {
                max-width: 540px;
                grid-template-columns: 1fr;
            }

            .login-brand {
                min-height: 280px;
                padding: 40px;
            }

            .brand-title h1 {
                font-size: 50px;
            }

            .brand-footer {
                display: none;
            }

            .login-form-area {
                padding: 45px 40px;
            }
        }

        @media (max-width: 576px) {
            .login-page {
                padding: 14px;
            }

            .login-wrapper {
                border-radius: 20px;
            }

            .login-brand {
                min-height: 230px;
                padding: 30px;
            }

            .brand-title h1 {
                font-size: 42px;
            }

            .brand-title p {
                font-size: 13px;
            }

            .login-form-area {
                padding: 35px 28px;
            }
        }
    </style>
</head>

<body>

<div class="login-page">

    <div class="login-wrapper">

        <section class="login-brand">

            <div class="brand-badge">
                Panel privado
            </div>

            <div class="brand-title">

                <h1>
                    BARBER<span>.</span>
                </h1>

                <p>
                    Administración central de servicios, citas,
                    horarios y contenido de la barbería.
                </p>

            </div>

            <div class="brand-footer">
                Sistema de administración Barber © {{ date('Y') }}
            </div>

        </section>


        <section class="login-form-area">

            <div class="login-form-content">

                <h2>Bienvenido</h2>

                <p class="login-subtitle">
                    Ingresa tus credenciales para acceder al panel.
                </p>

                @if ($errors->any())
                    <div class="alert alert-barber mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('login.submit') }}">

                    @csrf

                    <div class="mb-4">

                        <label for="email"
                               class="form-label">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control barber-input"
                            placeholder="admin@barber.com"
                            autocomplete="email"
                            autofocus
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label for="password"
                               class="form-label">
                            Contraseña
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control barber-input"
                            placeholder="Ingresa tu contraseña"
                            autocomplete="current-password"
                            required
                        >

                    </div>

                    <div class="form-check mb-4">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember"
                        >

                        <label
                            class="form-check-label"
                            for="remember">
                            Mantener sesión iniciada
                        </label>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-barber">

                        Iniciar sesión

                    </button>

                </form>

                <a href="{{ route('inicio') }}"
                   class="back-home">
                    ← Volver al sitio
                </a>

            </div>

        </section>

    </div>

</div>

</body>
</html>
