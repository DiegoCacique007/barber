<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Administrador') | Barber</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --admin-bg: #0b0b0b;
            --admin-surface: #111;
            --admin-surface-light: #161616;
            --admin-border: rgba(255,255,255,.07);
            --admin-text: #f4f1e8;
            --admin-muted: #777;
            --admin-gold: #c9a24d;
            --admin-gold-light: #e2c36e;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            min-height: 100%;
        }

        body {
            margin: 0;
            background: var(--admin-bg);
            color: var(--admin-text);
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        /* ==============================
           ESTRUCTURA
        ============================== */

        .admin-wrapper {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 270px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            padding: 28px 18px 22px;
            background: var(--admin-surface);
            border-right: 1px solid var(--admin-border);
            transition: transform .3s ease;
        }

        .admin-content {
            width: calc(100% - 270px);
            min-height: 100vh;
            margin-left: 270px;
        }

        /* ==============================
           SIDEBAR
        ============================== */

        .sidebar-brand {
            padding: 5px 14px 30px;
        }

        .sidebar-brand h2 {
            margin: 0;
            color: #fff;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .sidebar-brand h2 span {
            color: var(--admin-gold);
        }

        .sidebar-subtitle {
            display: block;
            margin-top: 5px;
            color: #606060;
            font-size: 10px;
            letter-spacing: 1.6px;
            text-transform: uppercase;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .sidebar-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 15px;
            border: 1px solid transparent;
            border-radius: 11px;
            color: #929292;
            font-size: 14px;
            transition: .22s ease;
        }

        .sidebar-link:hover {
            color: #fff;
            background: rgba(255,255,255,.045);
            transform: translateX(2px);
        }

        .sidebar-link.active {
            color: #111;
            background: var(--admin-gold);
            border-color: var(--admin-gold);
            font-weight: 600;
            box-shadow: 0 8px 25px rgba(201,162,77,.12);
        }

        .sidebar-icon {
            width: 22px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-size: 17px;
        }

        .sidebar-separator {
            height: 1px;
            margin: 12px 8px;
            background: var(--admin-border);
        }

        .sidebar-link.disabled {
            opacity: .38;
            cursor: default;
            pointer-events: none;
        }

        .sidebar-badge {
            margin-left: auto;
            padding: 3px 7px;
            border-radius: 20px;
            background: rgba(255,255,255,.06);
            color: #666;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 25px;
        }

        .view-site {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            padding: 12px 15px;
            border-radius: 11px;
            color: #777;
            font-size: 13px;
            transition: .2s ease;
        }

        .view-site:hover {
            color: var(--admin-gold);
            background: rgba(201,162,77,.06);
        }

        .logout-button {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--admin-border);
            border-radius: 11px;
            background: transparent;
            color: #888;
            text-align: left;
            font-size: 13px;
            cursor: pointer;
            transition: .2s ease;
        }

        .logout-button:hover {
            color: #ef8b94;
            background: rgba(220,53,69,.07);
            border-color: rgba(220,53,69,.18);
        }

        /* ==============================
           NAVBAR
        ============================== */

        .admin-navbar {
            height: 82px;
            position: sticky;
            top: 0;
            z-index: 900;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 38px;
            background: rgba(11,11,11,.88);
            border-bottom: 1px solid rgba(255,255,255,.06);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-title {
            color: #777;
            font-size: 12px;
            letter-spacing: .4px;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 50%;
            background: var(--admin-gold);
            color: #111;
            font-weight: 700;
        }

        .admin-user-info strong {
            display: block;
            color: #ddd;
            font-size: 13px;
            font-weight: 600;
        }

        .admin-user-info span {
            display: block;
            margin-top: 1px;
            color: #666;
            font-size: 10px;
        }

        /* ==============================
           CONTENIDO
        ============================== */

        .admin-main {
            padding: 38px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            margin-bottom: 7px;
            color: #f3f0e8;
            font-size: 30px;
            font-weight: 700;
        }

        .page-header p {
            margin: 0;
            color: var(--admin-muted);
            font-size: 14px;
        }

        .admin-card {
            height: 100%;
            padding: 23px;
            border: 1px solid var(--admin-border);
            border-radius: 16px;
            background: #131313;
            box-shadow: 0 15px 35px rgba(0,0,0,.15);
        }

        .admin-card-label {
            margin-bottom: 15px;
            color: #777;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .admin-card-value {
            color: #f4f1e8;
            font-size: 31px;
            font-weight: 700;
        }

        .admin-card-description {
            margin-top: 7px;
            color: #666;
            font-size: 12px;
        }

        /* ==============================
           BOTÓN MÓVIL
        ============================== */

        .mobile-menu-button {
            display: none;
            padding: 5px;
            border: 0;
            background: transparent;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 950;
            background: rgba(0,0,0,.65);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* ==============================
           BOOTSTRAP DARK
        ============================== */

        .form-control,
        .form-select {
            color-scheme: dark;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(201,162,77,.55) !important;
            box-shadow: 0 0 0 .2rem rgba(201,162,77,.08) !important;
        }

        .btn-warning {
            border-color: var(--admin-gold);
            background: var(--admin-gold);
            color: #111;
        }

        .btn-warning:hover,
        .btn-warning:focus {
            border-color: var(--admin-gold-light);
            background: var(--admin-gold-light);
            color: #111;
        }

        .text-warning {
            color: var(--admin-gold) !important;
        }

        /* ==============================
           RESPONSIVE
        ============================== */

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: 20px 0 60px rgba(0,0,0,.35);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .admin-content {
                width: 100%;
                margin-left: 0;
            }

            .mobile-menu-button {
                display: block;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: min(280px, 87vw);
            }

            .admin-navbar {
                height: 70px;
                padding: 0 18px;
            }

            .admin-main {
                padding: 24px 18px;
            }

            .admin-user-info {
                display: none;
            }

            .navbar-title {
                font-size: 11px;
            }

            .page-header h1 {
                font-size: 25px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="admin-wrapper">

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-brand">
            <h2>BARBER<span>.</span></h2>
            <span class="sidebar-subtitle">Administración</span>
        </div>


        <nav class="sidebar-menu">

            <a href="{{ route('administrador.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('administrador.dashboard') ? 'active' : '' }}">
                <span class="sidebar-icon">⌂</span>
                <span>Dashboard</span>
            </a>


            <a href="{{ route('administrador.servicios.index') }}"
               class="sidebar-link {{ request()->routeIs('administrador.servicios.*') ? 'active' : '' }}">
                <span class="sidebar-icon">✂</span>
                <span>Servicios</span>
            </a>


            <a href="{{ route('administrador.citas.index') }}"
               class="sidebar-link {{ request()->routeIs('administrador.citas.*') ? 'active' : '' }}">
                <span class="sidebar-icon">◷</span>
                <span>Citas</span>
            </a>


            <a href="{{ route('administrador.horarios.index') }}"
               class="sidebar-link {{ request()->routeIs('administrador.horarios.*') ? 'active' : '' }}">
                <span class="sidebar-icon">◫</span>
                <span>Horarios</span>
            </a>


            <div class="sidebar-separator"></div>


            <a href="#"
               class="sidebar-link disabled">
                <span class="sidebar-icon">◎</span>
                <span>Redes sociales</span>
                <span class="sidebar-badge">Próximo</span>
            </a>


            <a href="#"
               class="sidebar-link disabled">
                <span class="sidebar-icon">⚙</span>
                <span>Configuración</span>
                <span class="sidebar-badge">Próximo</span>
            </a>

        </nav>


        <div class="sidebar-bottom">

            <a href="{{ route('inicio') }}"
               target="_blank"
               class="view-site">
                <span>↗</span>
                Ver sitio público
            </a>


            <form method="POST"
                  action="{{ route('logout') }}"
                  id="logoutForm">

                @csrf

                <button type="submit"
                        class="logout-button">
                    Cerrar sesión
                </button>

            </form>

        </div>

    </aside>


    <div class="sidebar-overlay"
         id="sidebarOverlay"></div>


    <main class="admin-content">

        <header class="admin-navbar">

            <div class="navbar-left">

                <button class="mobile-menu-button"
                        type="button"
                        id="sidebarToggle"
                        aria-label="Abrir menú">
                    ☰
                </button>

                <span class="navbar-title">
                    Panel administrativo
                </span>

            </div>


            <div class="admin-user">

                <div class="admin-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="admin-user-info">
                    <strong>
                        {{ auth()->user()->name }}
                    </strong>

                    <span>
                        Administrador
                    </span>
                </div>

            </div>

        </header>


        <section class="admin-main">

            @if(session('success'))
                <div class="alert alert-success border-0 rounded-3 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger border-0 rounded-3 mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </section>

    </main>

</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('sidebarOverlay');

        const cerrarSidebar = () => {
            sidebar?.classList.remove('show');
            overlay?.classList.remove('show');
        };

        toggle?.addEventListener('click', () => {
            sidebar?.classList.toggle('show');
            overlay?.classList.toggle('show');
        });

        overlay?.addEventListener('click', cerrarSidebar);

        document.querySelectorAll('.sidebar-link:not(.disabled)').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 992) cerrarSidebar();
            });
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 992) cerrarSidebar();
        });
    });
</script>

@stack('scripts')

</body>
</html>
