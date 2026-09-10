@extends('layouts.administrador')

@section('title', 'Dashboard')

@section('content')

    <div class="page-header">
        <h1>Dashboard</h1>

        <p>
            Resumen general del sistema de administración.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-12 col-md-6 col-xl-3">
            <div class="admin-card">

                <div class="admin-card-label">
                    Servicios
                </div>

                <div class="admin-card-value">
                    {{ $totalServicios }}
                </div>

                <div class="admin-card-description">
                    Servicios registrados
                </div>

            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="admin-card">

                <div class="admin-card-label">
                    Citas
                </div>

                <div class="admin-card-value">
                    {{ $totalCitas }}
                </div>

                <div class="admin-card-description">
                    Citas registradas
                </div>

            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="admin-card">

                <div class="admin-card-label">
                    Próximamente
                </div>

                <div class="admin-card-value">
                    0
                </div>

                <div class="admin-card-description">
                    Citas pendientes
                </div>

            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="admin-card">

                <div class="admin-card-label">
                    Estado
                </div>

                <div class="admin-card-value" style="font-size: 21px;">
                    Operativo
                </div>

                <div class="admin-card-description">
                    Sistema funcionando correctamente
                </div>

            </div>
        </div>

    </div>

@endsection
