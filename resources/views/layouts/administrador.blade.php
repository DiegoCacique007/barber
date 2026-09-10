<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Administrador') | Barber</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: #0b0b0b;
            color: #f4f1e8;
            overflow-x: hidden;
        }

        .admin-wrapper {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 270px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            padding: 28px 18px;
            background: #111;
            border-right: 1px solid rgba(255,255,255,.07);
            transition: .3s ease;
        }

        .sidebar-brand {
            padding: 5px 14px 30px;
        }

        .sidebar-brand h2 {
            margin: 0;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .sidebar-brand span {
            color: #c9a24d;
        }

        .sidebar-subtitle {
            display: block;
            margin-top: 5px;
            color: #707070;
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 15px;
            border-radius: 11px;
            color: #999;
            font-size: 14px;
            transition: .2s ease;
        }

        .sidebar-link:hover {
            color: #fff;
            background: rgba(255,255,255,.05);
        }

        .sidebar-link.active {
            color: #111;
            background: #c9a24d;
            font-weight: 600;
        }

        .sidebar-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-bottom {
            position: absolute;
            bottom: 25px;
            left: 18px;
            right: 18px;
        }

        .admin-content {
            width: calc(100% - 270px);
            margin-left: 270px;
            min-height: 100vh;
        }

        .admin-navbar {
            height: 82px;
            padding: 0 38px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
            background: rgba(11,11,11,.88);
            border-bottom: 1px solid rgba(255,255,255,.06);
            backdrop-filter: blur(18px);
        }

        .navbar-title {
            color: #aaa;
            font-size: 13px;
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
            border-radius: 50%;
            background: #c9a24d;
            color: #111;
            font-weight: 700;
        }

        .admin-user-info strong {
            display: block;
            font-size: 13px;
        }

        .admin-user-info span {
            color: #777;
            font-size: 11px;
        }

        .admin-main {
            padding: 38px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            margin-bottom: 7px;
            font-size: 30px;
            font-weight: 700;
        }

        .page-header p {
            margin: 0;
            color: #777;
            font-size: 14px;
        }

        .admin-card {
            height: 100%;
            padding: 23px;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 16px;
            background: #131313;
            box-shadow: 0 15px 35px rgba(0,0,0,.15);
        }

        .admin-card-label {
            margin-bottom: 15px;
            color: #777;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .admin-card-value {
            font-size: 31px;
            font-weight: 700;
        }

        .admin-card-description {
            margin-top: 7px;
            color: #666;
            font-size: 12px;
        }

        .logout-button {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 11px;
            background: transparent;
            color: #888;
            text-align: left;
            font-size: 13px;
            transition: .2s ease;
        }

        .logout-button:hover {
            color: #fff;
            background: rgba(220,53,69,.08);
            border-color: rgba(220,53,69,.18);
        }

        .mobile-menu-button {
            display: none;
            border: none;
            background: transparent;
            color: white;
            font-size: 24px;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
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
                Dashboard
            </a>

            <a href="#"
               class="sidebar-link {{ request()->routeIs('administrador.servicios.*') ? 'active' : '' }}">
                <span class="sidebar-icon">✂</span>
                Servicios
            </a>

            <a href="#"
               class="sidebar-link {{ request()->routeIs('administrador.citas.*') ? 'active' : '' }}">
                <span class="sidebar-icon">◷</span>
                Citas
            </a>

            <a href="#"
               class="sidebar-link {{ request()->routeIs('administrador.horarios.*') ? 'active' : '' }}">
                <span class="sidebar-icon">◫</span>
                Horarios
            </a>

            <a href="#"
               class="sidebar-link {{ request()->routeIs('administrador.redes.*') ? 'active' : '' }}">
                <span class="sidebar-icon">◎</span>
                Redes sociales
            </a>

            <a href="#"
               class="sidebar-link {{ request()->routeIs('administrador.configuracion.*') ? 'active' : '' }}">
                <span class="sidebar-icon">⚙</span>
                Configuración
            </a>

        </nav>

        <div class="sidebar-bottom">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="logout-button">
                    Cerrar sesión
                </button>
            </form>

        </div>

    </aside>

    <main class="admin-content">

        <header class="admin-navbar">

            <div class="d-flex align-items-center gap-3">

                <button class="mobile-menu-button"
                        type="button"
                        id="sidebarToggle">
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
                    <strong>{{ auth()->user()->name }}</strong>
                    <span>Administrador</span>
                </div>

            </div>

        </header>

        <section class="admin-main">
            @yield('content')
        </section>

    </main>

</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');

    sidebarToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('show');
    });
</script>

@stack('scripts')

</body>
</html>
