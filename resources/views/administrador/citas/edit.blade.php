@extends('layouts.administrador')

@section('title', 'Editar cita')

@section('content')

    <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3">

        <div>
            <h1>Editar cita</h1>
            <p>Actualiza la información, fecha, horario o estado de la cita.</p>
        </div>

        <a href="{{ route('administrador.citas.index') }}"
           class="btn btn-outline-secondary">
            Volver
        </a>

    </div>

    <div class="admin-card">

        <form
            method="POST"
            action="{{ route('administrador.citas.update', $cita) }}"
        >
            @csrf
            @method('PUT')

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
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

@endsection
