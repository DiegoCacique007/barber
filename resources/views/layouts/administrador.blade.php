<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Administrador') | Barber</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        /* =========================================================
           CONFIGURACIÓN GENERAL
        ========================================================= */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            margin: 0;
            overflow-x: hidden;
            background: #121212;
            color: #f5f5f5;
        }

        a {
            text-decoration: none;
        }


        /* =========================================================
           ESTRUCTURA
        ========================================================= */

        .admin-wrapper {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            width: 270px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 28px 18px 22px;
            border-right: 1px solid rgba(255,255,255,.11);
            background: #181818;
            transition: transform .3s ease;
        }

        .admin-content {
            width: calc(100% - 270px);
            min-height: 100vh;
            margin-left: 270px;
        }


        /* =========================================================
           SIDEBAR - MARCA
        ========================================================= */

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
            color: #ddb65a;
        }

        .sidebar-subtitle {
            display: block;
            margin-top: 5px;
            color: #aaa;
            font-size: 10px;
            letter-spacing: 1.6px;
            text-transform: uppercase;
        }


        /* =========================================================
           SIDEBAR - MENÚ
        ========================================================= */

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
            color: #c3c3c3;
            font-size: 14px;
            transition:
                color .22s ease,
                background .22s ease,
                border-color .22s ease,
                transform .22s ease;
        }

        .sidebar-link:hover {
            border-color: rgba(255,255,255,.05);
            background: rgba(255,255,255,.065);
            color: #fff;
            transform: translateX(2px);
        }

        .sidebar-link.active {
            border-color: #d5ad55;
            background: #d5ad55;
            color: #111;
            font-weight: 700;
            box-shadow: 0 8px 25px rgba(213,173,85,.16);
        }

        .sidebar-icon {
            width: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 17px;
        }

        .sidebar-separator {
            height: 1px;
            margin: 12px 8px;
            background: rgba(255,255,255,.11);
        }


        /* =========================================================
           SIDEBAR - PARTE INFERIOR
        ========================================================= */

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
            color: #b5b5b5;
            font-size: 13px;
            transition:
                color .2s ease,
                background .2s ease;
        }

        .view-site:hover {
            background: rgba(213,173,85,.08);
            color: #e2c36e;
        }

        .logout-button {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 11px;
            background: transparent;
            color: #b5b5b5;
            text-align: left;
            font-size: 13px;
            cursor: pointer;
            transition:
                color .2s ease,
                background .2s ease,
                border-color .2s ease;
        }

        .logout-button:hover {
            border-color: rgba(239,139,148,.30);
            background: rgba(220,53,69,.09);
            color: #f0a0a7;
        }


        /* =========================================================
           NAVBAR ADMINISTRATIVO
        ========================================================= */

        .admin-navbar {
            position: sticky;
            top: 0;
            z-index: 900;
            height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 38px;
            border-bottom: 1px solid rgba(255,255,255,.09);
            background: rgba(18,18,18,.94);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-title {
            color: #b2b2b2;
            font-size: 12px;
            letter-spacing: .4px;
        }


        /* =========================================================
           USUARIO
        ========================================================= */

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
            background: #d5ad55;
            color: #111;
            font-weight: 700;
        }

        .admin-user-info strong {
            display: block;
            color: #f4f4f4;
            font-size: 13px;
            font-weight: 600;
        }

        .admin-user-info span {
            display: block;
            margin-top: 1px;
            color: #a0a0a0;
            font-size: 10px;
        }


        /* =========================================================
           CONTENIDO
        ========================================================= */

        .admin-main {
            padding: 38px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            margin-bottom: 7px;
            color: #fff;
            font-size: 30px;
            font-weight: 700;
        }

        .page-header p {
            margin: 0;
            color: #ababab;
            font-size: 14px;
        }


        /* =========================================================
           TARJETAS GENERALES
        ========================================================= */

        .admin-card {
            height: 100%;
            padding: 23px;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 16px;
            background: #1a1a1a;
            box-shadow: 0 15px 35px rgba(0,0,0,.16);
        }

        .admin-card-label {
            margin-bottom: 15px;
            color: #b0b0b0;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .admin-card-value {
            color: #fff;
            font-size: 31px;
            font-weight: 700;
        }

        .admin-card-description {
            margin-top: 7px;
            color: #999;
            font-size: 12px;
        }


        /* =========================================================
           FORMULARIOS
        ========================================================= */

        .form-label {
            color: #c0c0c0 !important;
        }

        .form-control,
        .form-select {
            border-color: rgba(255,255,255,.16) !important;
            background-color: #1c1c1c !important;
            color: #f5f5f5 !important;
            color-scheme: dark;
        }

        .form-control::placeholder {
            color: #858585 !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #d5ad55 !important;
            background-color: #202020 !important;
            color: #fff !important;
            box-shadow: 0 0 0 .2rem rgba(213,173,85,.10) !important;
        }

        .form-select option {
            background: #1c1c1c;
            color: #f5f5f5;
        }

        .form-check-label {
            color: #c5c5c5;
        }

        .form-check-input {
            border-color: rgba(255,255,255,.2);
            background-color: #222;
        }

        .form-check-input:checked {
            border-color: #d5ad55;
            background-color: #d5ad55;
        }

        .text-secondary {
            color: #b3b3b3 !important;
        }


        /* =========================================================
           TABLAS
        ========================================================= */

        .table {
            --bs-table-bg: transparent;
            --bs-table-color: #dfdfdf;
            --bs-table-border-color: rgba(255,255,255,.08);
            --bs-table-hover-bg: rgba(255,255,255,.025);
            --bs-table-hover-color: #fff;
            margin-bottom: 0;
        }

        .table thead th {
            border-bottom-color: rgba(255,255,255,.10) !important;
            color: #bcbcbc !important;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .6px;
            text-transform: uppercase;
        }

        .table tbody td {
            border-color: rgba(255,255,255,.06) !important;
            color: #dadada !important;
            vertical-align: middle;
        }

        .table tbody tr:hover td {
            color: #fff !important;
        }


        /* =========================================================
           BOTONES
        ========================================================= */

        .btn-warning {
            border-color: #d5ad55;
            background: #d5ad55;
            color: #111;
            font-weight: 600;
        }

        .btn-warning:hover,
        .btn-warning:focus {
            border-color: #e8c873;
            background: #e8c873;
            color: #111;
        }

        .btn-outline-secondary {
            border-color: rgba(255,255,255,.20);
            color: #c2c2c2;
        }

        .btn-outline-secondary:hover {
            border-color: #d5ad55;
            background: rgba(213,173,85,.09);
            color: #fff;
        }

        .btn-outline-light {
            border-color: rgba(255,255,255,.20);
            color: #d0d0d0;
        }

        .btn-outline-light:hover {
            border-color: rgba(255,255,255,.32);
            background: rgba(255,255,255,.07);
            color: #fff;
        }

        .text-warning {
            color: #ddb65a !important;
        }


        /* =========================================================
           LINKS
        ========================================================= */

        .admin-main a:not(.btn):not(.sidebar-link):not(.view-site) {
            transition: color .2s ease;
        }


        /* =========================================================
           PAGINACIÓN
        ========================================================= */

        .pagination {
            --bs-pagination-bg: #1a1a1a;
            --bs-pagination-border-color: rgba(255,255,255,.10);
            --bs-pagination-color: #bbb;
            --bs-pagination-hover-bg: #222;
            --bs-pagination-hover-border-color: rgba(213,173,85,.30);
            --bs-pagination-hover-color: #ddb65a;
            --bs-pagination-active-bg: #d5ad55;
            --bs-pagination-active-border-color: #d5ad55;
            --bs-pagination-active-color: #111;
            --bs-pagination-disabled-bg: #161616;
            --bs-pagination-disabled-border-color: rgba(255,255,255,.06);
            --bs-pagination-disabled-color: #666;
        }


        /* =========================================================
           BADGES
        ========================================================= */

        .badge {
            font-weight: 600;
        }


        /* =========================================================
           ALERTAS
        ========================================================= */

        .alert {
            padding: 14px 17px;
            border-radius: 12px !important;
            font-size: 13px;
        }

        .alert-success {
            border: 1px solid rgba(103,211,157,.25) !important;
            background: rgba(75,170,120,.14) !important;
            color: #afe8cc !important;
        }

        .alert-danger {
            border: 1px solid rgba(235,110,120,.25) !important;
            background: rgba(220,70,80,.13) !important;
            color: #f1a4aa !important;
        }

        .alert-warning {
            border: 1px solid rgba(213,173,85,.28) !important;
            background: rgba(213,173,85,.10) !important;
            color: #ebca7b !important;
        }


        /* =========================================================
           MODALES
        ========================================================= */

        .modal-content {
            border: 1px solid rgba(255,255,255,.10);
            background: #1a1a1a;
            color: #f5f5f5;
        }

        .modal-header,
        .modal-footer {
            border-color: rgba(255,255,255,.08);
        }

        .modal-title {
            color: #fff;
        }

        .btn-close {
            filter: invert(1);
        }


        /* =========================================================
           MENÚ MÓVIL
        ========================================================= */

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
            position: fixed;
            inset: 0;
            z-index: 950;
            display: none;
            background: rgba(0,0,0,.65);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
        }

        .sidebar-overlay.show {
            display: block;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

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

            .page-header p {
                font-size: 13px;
            }
        }
    </style>

    @stack('styles')
</head>


<body>

<div class="admin-wrapper">

    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-brand">
            <h2>
                BARBER<span>.</span>
            </h2>

            <span class="sidebar-subtitle">
                Administración
            </span>
        </div>


        <nav class="sidebar-menu">

            {{-- DASHBOARD --}}
            <a href="{{ route('administrador.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('administrador.dashboard') ? 'active' : '' }}">

                <span class="sidebar-icon">⌂</span>
                <span>Dashboard</span>

            </a>


            {{-- SERVICIOS --}}
            <a href="{{ route('administrador.servicios.index') }}"
               class="sidebar-link {{ request()->routeIs('administrador.servicios.*') ? 'active' : '' }}">

                <span class="sidebar-icon">✂</span>
                <span>Servicios</span>

            </a>


            {{-- CITAS --}}
            <a href="{{ route('administrador.citas.index') }}"
               class="sidebar-link {{ request()->routeIs('administrador.citas.*') ? 'active' : '' }}">

                <span class="sidebar-icon">◷</span>
                <span>Citas</span>

            </a>


            {{-- HORARIOS --}}
            <a href="{{ route('administrador.horarios.index') }}"
               class="sidebar-link {{ request()->routeIs('administrador.horarios.*') ? 'active' : '' }}">

                <span class="sidebar-icon">◫</span>
                <span>Horarios</span>

            </a>


            <div class="sidebar-separator"></div>


            {{-- REDES SOCIALES --}}
            <a href="{{ route('administrador.redes.index') }}"
               class="sidebar-link {{ request()->routeIs('administrador.redes.*') ? 'active' : '' }}">

                <span class="sidebar-icon">◎</span>
                <span>Redes sociales</span>

            </a>


            {{-- CONFIGURACIÓN --}}
            <a href="{{ route('administrador.configuracion.edit') }}"
               class="sidebar-link {{ request()->routeIs('administrador.configuracion.*') ? 'active' : '' }}">

                <span class="sidebar-icon">⚙</span>
                <span>Configuración</span>

            </a>

        </nav>


        <div class="sidebar-bottom">

            <a href="{{ route('inicio') }}"
               target="_blank"
               rel="noopener noreferrer"
               class="view-site">

                <span>↗</span>
                <span>Ver sitio público</span>

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


    {{-- OVERLAY MÓVIL --}}

    <div class="sidebar-overlay"
         id="sidebarOverlay">
    </div>


    {{-- =====================================================
         CONTENIDO
    ====================================================== --}}

    <main class="admin-content">

        {{-- NAVBAR --}}

        <header class="admin-navbar">

            <div class="navbar-left">

                <button
                    class="mobile-menu-button"
                    type="button"
                    id="sidebarToggle"
                    aria-label="Abrir menú"
                >
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


        {{-- CONTENIDO PRINCIPAL --}}

        <section class="admin-main">

            @if(session('success'))

                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="alert alert-danger mb-4">
                    {{ session('error') }}
                </div>

            @endif


            @yield('content')

        </section>

    </main>

</div>


{{-- =========================================================
     JAVASCRIPT SIDEBAR
========================================================= --}}

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

        document.querySelectorAll('.sidebar-link').forEach(link => {

            link.addEventListener('click', () => {

                if (window.innerWidth <= 992) {
                    cerrarSidebar();
                }

            });

        });

        window.addEventListener('resize', () => {

            if (window.innerWidth > 992) {
                cerrarSidebar();
            }

        });

    });
</script>

@stack('scripts')

</body>

</html>
