@extends('layouts.administrador')

@section('title', 'Nueva cita')

@section('content')

    <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3">

        <div>
            <h1>Nueva cita</h1>
            <p>Registra manualmente una nueva cita para la barbería.</p>
        </div>

        <a href="{{ route('administrador.citas.index') }}"
           class="btn btn-outline-secondary">
            Volver
        </a>

    </div>

    <div class="admin-card">

        <form
            method="POST"
            action="{{ route('administrador.citas.store') }}"
        >
            @csrf

            @include('administrador.citas.form')

            <div class="d-flex justify-content-end gap-2 mt-4">

                <a href="{{ route('administrador.citas.index') }}"
                   class="btn btn-outline-secondary">
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn"
                    style="
                    background:#c9a24d;
                    color:#111;
                    font-weight:600;
                "
                >
                    Guardar cita
                </button>

            </div>

        </form>

    </div>

@endsection
