<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    {{-- LLAVE PÚBLICA PARA WEB PUSH --}}
    <meta
        name="vapid-public-key"
        content="{{ config('webpush.vapid.public_key') }}"
    >

    <title>
        @yield('title', 'Administrador') | Barber
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/admin-push.js'
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
           NAVBAR
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

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }


        /* =========================================================
           BOTÓN ACTIVAR PUSH
        ========================================================= */

        .push-enable-button {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 14px;
            border: 1px solid rgba(213,173,85,.25);
            border-radius: 100px;
            background: rgba(213,173,85,.07);
            color: #ddb65a;
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition:
                border-color .2s ease,
                background .2s ease,
                color .2s ease,
                transform .2s ease;
        }

        .push-enable-button:hover:not(:disabled) {
            border-color: rgba(213,173,85,.45);
            background: rgba(213,173,85,.12);
            color: #e8c873;
            transform: translateY(-1px);
        }

        .push-enable-button.push-enabled {
            border-color: rgba(95,205,145,.25);
            background: rgba(95,205,145,.08);
            color: #89d8ac;
        }

        .push-enable-button:disabled {
            cursor: default;
            opacity: .82;
        }


        /* =========================================================
           NOTIFICACIONES
        ========================================================= */

        .notification-wrapper {
            position: relative;
        }

        .notification-button {
            position: relative;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: 1px solid rgba(255,255,255,.11);
            border-radius: 12px;
            background: #1a1a1a;
            color: #c6c6c6;
            font-size: 18px;
            cursor: pointer;
            transition:
                background .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease;
        }

        .notification-button:hover {
            border-color: rgba(213,173,85,.30);
            background: rgba(213,173,85,.07);
            color: #ddb65a;
            transform: translateY(-1px);
        }

        .notification-button.active {
            border-color: rgba(213,173,85,.38);
            background: rgba(213,173,85,.09);
            color: #ddb65a;
        }

        .notification-count {
            position: absolute;
            top: -6px;
            right: -6px;
            min-width: 19px;
            height: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 5px;
            border: 2px solid #121212;
            border-radius: 100px;
            background: #d5ad55;
            color: #111;
            font-size: 9px;
            font-weight: 800;
            line-height: 1;
        }

        .notification-dropdown {
            position: absolute;
            top: calc(100% + 14px);
            right: 0;
            z-index: 1200;
            width: 370px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.11);
            border-radius: 16px;
            background: #191919;
            box-shadow: 0 25px 70px rgba(0,0,0,.45);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px) scale(.98);
            transform-origin: top right;
            transition:
                opacity .2s ease,
                visibility .2s ease,
                transform .2s ease;
        }

        .notification-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .notification-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 18px 15px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .notification-header-left strong {
            display: block;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
        }

        .notification-header-left span {
            display: block;
            margin-top: 3px;
            color: #8e8e8e;
            font-size: 10px;
        }

        .notification-read-form {
            margin: 0;
        }

        .notification-read-all {
            padding: 0;
            border: 0;
            background: transparent;
            color: #d5ad55;
            font-size: 10px;
            cursor: pointer;
            transition: color .2s ease;
        }

        .notification-read-all:hover {
            color: #e8c873;
        }

        .notification-list {
            max-height: 390px;
            overflow-y: auto;
        }

        .notification-list::-webkit-scrollbar {
            width: 5px;
        }

        .notification-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .notification-list::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: rgba(255,255,255,.13);
        }

        .notification-item {
            position: relative;
            display: block;
            padding: 16px 18px 16px 48px;
            border-bottom: 1px solid rgba(255,255,255,.065);
            color: inherit;
            transition: background .2s ease;
        }

        .notification-item:last-child {
            border-bottom: 0;
        }

        .notification-item:hover {
            background: rgba(213,173,85,.055);
        }

        .notification-item-icon {
            position: absolute;
            top: 17px;
            left: 17px;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(213,173,85,.22);
            border-radius: 7px;
            background: rgba(213,173,85,.08);
            color: #ddb65a;
            font-size: 11px;
        }

        .notification-item-title {
            display: block;
            padding-right: 45px;
            color: #f3f3f3;
            font-size: 11px;
            font-weight: 650;
            line-height: 1.4;
        }

        .notification-item-message {
            display: block;
            margin-top: 4px;
            color: #aaa;
            font-size: 10px;
            line-height: 1.45;
        }

        .notification-item-details {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px 10px;
            margin-top: 8px;
            color: #8f8f8f;
            font-size: 9px;
        }

        .notification-item-time {
            position: absolute;
            top: 18px;
            right: 17px;
            color: #777;
            font-size: 8px;
            white-space: nowrap;
        }

        .notification-empty {
            padding: 38px 20px;
            text-align: center;
        }

        .notification-empty-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            border: 1px solid rgba(213,173,85,.15);
            border-radius: 11px;
            background: rgba(213,173,85,.055);
            color: #ddb65a;
            font-size: 18px;
        }

        .notification-empty strong {
            display: block;
            color: #ddd;
            font-size: 11px;
            font-weight: 600;
        }

        .notification-empty span {
            display: block;
            margin-top: 5px;
            color: #888;
            font-size: 10px;
        }

        .notification-footer {
            padding: 11px 18px;
            border-top: 1px solid rgba(255,255,255,.07);
            background: #171717;
        }

        .notification-footer a {
            display: block;
            color: #aaa;
            font-size: 10px;
            text-align: center;
            transition: color .2s ease;
        }

        .notification-footer a:hover {
            color: #ddb65a;
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

        @media(max-width: 992px) {

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


        @media(max-width: 700px) {

            .push-enable-button {
                padding: 0 10px;
                font-size: 9px;
            }

        }


        @media(max-width: 576px) {

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

            .navbar-right {
                gap: 8px;
            }

            .notification-button {
                width: 38px;
                height: 38px;
            }

            .push-enable-button {
                max-width: 88px;
                min-height: 36px;
                padding: 0 8px;
                font-size: 8px;
                white-space: normal;
                line-height: 1.15;
            }

            .notification-dropdown {
                position: fixed;
                top: 78px;
                right: 12px;
                left: 12px;
                width: auto;
                max-height: calc(100vh - 95px);
            }

            .notification-list {
                max-height: calc(100vh - 205px);
            }

        }

    </style>

    @stack('styles')

</head>


<body>

@php

    /*
    |--------------------------------------------------------------------------
    | NOTIFICACIONES DEL ADMINISTRADOR
    |--------------------------------------------------------------------------
    */

    $totalNotificacionesNoLeidas = auth()
        ->user()
        ->unreadNotifications()
        ->count();


    $notificacionesNoLeidas = auth()
        ->user()
        ->unreadNotifications()
        ->latest()
        ->take(6)
        ->get();

@endphp


<div class="admin-wrapper">


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside
        class="sidebar"
        id="sidebar"
    >

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

            <a
                href="{{ route('administrador.dashboard') }}"
                class="sidebar-link {{ request()->routeIs('administrador.dashboard') ? 'active' : '' }}"
            >

                <span class="sidebar-icon">
                    ⌂
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- SERVICIOS --}}

            <a
                href="{{ route('administrador.servicios.index') }}"
                class="sidebar-link {{ request()->routeIs('administrador.servicios.*') ? 'active' : '' }}"
            >

                <span class="sidebar-icon">
                    ✂
                </span>

                <span>
                    Servicios
                </span>

            </a>


            {{-- CITAS --}}

            <a
                href="{{ route('administrador.citas.index') }}"
                class="sidebar-link {{ request()->routeIs('administrador.citas.*') ? 'active' : '' }}"
            >

                <span class="sidebar-icon">
                    ◷
                </span>

                <span>
                    Citas
                </span>

            </a>


            {{-- HORARIOS --}}

            <a
                href="{{ route('administrador.horarios.index') }}"
                class="sidebar-link {{ request()->routeIs('administrador.horarios.*') ? 'active' : '' }}"
            >

                <span class="sidebar-icon">
                    ◫
                </span>

                <span>
                    Horarios
                </span>

            </a>


            <div class="sidebar-separator"></div>


            {{-- REDES SOCIALES --}}

            <a
                href="{{ route('administrador.redes.index') }}"
                class="sidebar-link {{ request()->routeIs('administrador.redes.*') ? 'active' : '' }}"
            >

                <span class="sidebar-icon">
                    ◎
                </span>

                <span>
                    Redes sociales
                </span>

            </a>


            {{-- CONFIGURACIÓN --}}

            <a
                href="{{ route('administrador.configuracion.edit') }}"
                class="sidebar-link {{ request()->routeIs('administrador.configuracion.*') ? 'active' : '' }}"
            >

                <span class="sidebar-icon">
                    ⚙
                </span>

                <span>
                    Configuración
                </span>

            </a>

        </nav>


        <div class="sidebar-bottom">

            <a
                href="{{ route('inicio') }}"
                target="_blank"
                rel="noopener noreferrer"
                class="view-site"
            >

                <span>
                    ↗
                </span>

                <span>
                    Ver sitio público
                </span>

            </a>


            <form
                method="POST"
                action="{{ route('logout') }}"
                id="logoutForm"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    Cerrar sesión
                </button>

            </form>

        </div>

    </aside>


    {{-- =====================================================
         OVERLAY MÓVIL
    ====================================================== --}}

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
    ></div>


    {{-- =====================================================
         CONTENIDO
    ====================================================== --}}

    <main class="admin-content">


        {{-- =================================================
             NAVBAR
        ================================================== --}}

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


            <div class="navbar-right">


                {{-- =========================================
                     ACTIVAR NOTIFICACIONES PUSH
                ========================================== --}}

                <button
                    type="button"
                    id="activarNotificacionesPush"
                    class="push-enable-button"
                    data-subscribe-url="{{ route('administrador.push.subscribe', [], false) }}"

                >
                    Activar avisos
                </button>


                {{-- =========================================
                     CAMPANA DE NOTIFICACIONES
                ========================================== --}}

                <div
                    class="notification-wrapper"
                    id="notificationWrapper"
                >

                    <button
                        type="button"
                        class="notification-button"
                        id="notificationButton"
                        aria-label="Notificaciones"
                        aria-expanded="false"
                        aria-controls="notificationDropdown"
                    >

                        <span aria-hidden="true">
                            🔔
                        </span>


                        @if($totalNotificacionesNoLeidas > 0)

                            <span class="notification-count">

                                {{
                                    $totalNotificacionesNoLeidas > 99
                                        ? '99+'
                                        : $totalNotificacionesNoLeidas
                                }}

                            </span>

                        @endif

                    </button>


                    <div
                        class="notification-dropdown"
                        id="notificationDropdown"
                    >


                        {{-- ENCABEZADO --}}

                        <div class="notification-header">

                            <div class="notification-header-left">

                                <strong>
                                    Notificaciones
                                </strong>

                                <span>

                                    @if($totalNotificacionesNoLeidas === 0)

                                        No tienes notificaciones nuevas

                                    @elseif($totalNotificacionesNoLeidas === 1)

                                        1 notificación sin leer

                                    @else

                                        {{ $totalNotificacionesNoLeidas }}
                                        notificaciones sin leer

                                    @endif

                                </span>

                            </div>


                            @if($totalNotificacionesNoLeidas > 0)

                                <form
                                    method="POST"
                                    action="{{ route('administrador.notificaciones.marcar-todas') }}"
                                    class="notification-read-form"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="notification-read-all"
                                    >
                                        Marcar todas
                                    </button>

                                </form>

                            @endif

                        </div>


                        {{-- LISTADO --}}

                        <div class="notification-list">


                            @forelse($notificacionesNoLeidas as $notificacion)

                                @php

                                    $datos = $notificacion->data;


                                    $titulo =
                                        $datos['titulo']
                                        ?? 'Nueva notificación';


                                    $mensaje =
                                        $datos['mensaje']
                                        ?? 'Tienes una nueva notificación.';


                                    $telefono =
                                        $datos['telefono']
                                        ?? null;


                                    $fecha =
                                        isset($datos['fecha'])
                                            ? \Carbon\Carbon::parse(
                                                $datos['fecha']
                                            )->format('d/m/Y')
                                            : null;


                                    $hora =
                                        isset($datos['hora'])
                                            ? \Carbon\Carbon::parse(
                                                $datos['hora']
                                            )->format('h:i A')
                                            : null;

                                @endphp


                                <a
                                    href="{{ route(
                                        'administrador.notificaciones.ver',
                                        $notificacion->id
                                    ) }}"
                                    class="notification-item"
                                >

                                    <span class="notification-item-icon">
                                        ◷
                                    </span>


                                    <span class="notification-item-title">
                                        {{ $titulo }}
                                    </span>


                                    <span class="notification-item-time">

                                        {{
                                            $notificacion
                                                ->created_at
                                                ->diffForHumans(
                                                    [
                                                        'short' => true,
                                                        'parts' => 1,
                                                    ]
                                                )
                                        }}

                                    </span>


                                    <span class="notification-item-message">
                                        {{ $mensaje }}
                                    </span>


                                    @if($fecha || $hora || $telefono)

                                        <span class="notification-item-details">

                                            @if($fecha)

                                                <span>
                                                    {{ $fecha }}
                                                </span>

                                            @endif


                                            @if($hora)

                                                <span>
                                                    · {{ $hora }}
                                                </span>

                                            @endif


                                            @if($telefono)

                                                <span>
                                                    · {{ $telefono }}
                                                </span>

                                            @endif

                                        </span>

                                    @endif

                                </a>


                            @empty


                                <div class="notification-empty">

                                    <div class="notification-empty-icon">
                                        ✓
                                    </div>

                                    <strong>
                                        Todo está al día
                                    </strong>

                                    <span>
                                        No tienes nuevas solicitudes por revisar.
                                    </span>

                                </div>


                            @endforelse

                        </div>


                        {{-- PIE --}}

                        <div class="notification-footer">

                            <a href="{{ route('administrador.citas.index') }}">
                                Ir a todas las citas →
                            </a>

                        </div>

                    </div>

                </div>


                {{-- =========================================
                     USUARIO
                ========================================== --}}

                <div class="admin-user">

                    <div class="admin-avatar">

                        {{
                            strtoupper(
                                substr(
                                    auth()->user()->name,
                                    0,
                                    1
                                )
                            )
                        }}

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

            </div>

        </header>


        {{-- =================================================
             CONTENIDO PRINCIPAL
        ================================================== --}}

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
     JAVASCRIPT DEL LAYOUT
========================================================= --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        () => {


            /* =====================================================
               SIDEBAR
            ====================================================== */

            const sidebar =
                document.getElementById(
                    'sidebar'
                );


            const sidebarToggle =
                document.getElementById(
                    'sidebarToggle'
                );


            const sidebarOverlay =
                document.getElementById(
                    'sidebarOverlay'
                );


            const cerrarSidebar = () => {

                sidebar
                    ?.classList
                    .remove('show');


                sidebarOverlay
                    ?.classList
                    .remove('show');

            };


            sidebarToggle
                ?.addEventListener(
                    'click',
                    () => {

                        sidebar
                            ?.classList
                            .toggle('show');


                        sidebarOverlay
                            ?.classList
                            .toggle('show');

                    }
                );


            sidebarOverlay
                ?.addEventListener(
                    'click',
                    cerrarSidebar
                );


            document
                .querySelectorAll(
                    '.sidebar-link'
                )
                .forEach(link => {

                    link.addEventListener(
                        'click',
                        () => {

                            if (
                                window.innerWidth <= 992
                            ) {

                                cerrarSidebar();

                            }

                        }
                    );

                });


            window.addEventListener(
                'resize',
                () => {

                    if (
                        window.innerWidth > 992
                    ) {

                        cerrarSidebar();

                    }

                }
            );


            /* =====================================================
               NOTIFICACIONES
            ====================================================== */

            const notificationWrapper =
                document.getElementById(
                    'notificationWrapper'
                );


            const notificationButton =
                document.getElementById(
                    'notificationButton'
                );


            const notificationDropdown =
                document.getElementById(
                    'notificationDropdown'
                );


            const cerrarNotificaciones = () => {

                notificationDropdown
                    ?.classList
                    .remove('show');


                notificationButton
                    ?.classList
                    .remove('active');


                notificationButton
                    ?.setAttribute(
                        'aria-expanded',
                        'false'
                    );

            };


            const abrirNotificaciones = () => {

                notificationDropdown
                    ?.classList
                    .add('show');


                notificationButton
                    ?.classList
                    .add('active');


                notificationButton
                    ?.setAttribute(
                        'aria-expanded',
                        'true'
                    );

            };


            const alternarNotificaciones = () => {

                if (
                    notificationDropdown
                        ?.classList
                        .contains('show')
                ) {

                    cerrarNotificaciones();

                } else {

                    abrirNotificaciones();

                }

            };


            notificationButton
                ?.addEventListener(
                    'click',
                    event => {

                        event.stopPropagation();

                        alternarNotificaciones();

                    }
                );


            notificationDropdown
                ?.addEventListener(
                    'click',
                    event => {

                        event.stopPropagation();

                    }
                );


            document.addEventListener(
                'click',
                event => {

                    if (
                        !notificationWrapper
                            ?.contains(
                                event.target
                            )
                    ) {

                        cerrarNotificaciones();

                    }

                }
            );


            document.addEventListener(
                'keydown',
                event => {

                    if (
                        event.key ===
                        'Escape'
                    ) {

                        cerrarNotificaciones();

                        cerrarSidebar();

                    }

                }
            );

        }
    );

</script>


@stack('scripts')

</body>

</html>
