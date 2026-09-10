@extends('layouts.administrador')

@section('title', 'Editar servicio')

@section('content')

    <div class="page-header d-flex justify-content-between align-items-center">

        <div>
            <h1>Editar servicio</h1>
            <p>Actualiza la información del servicio seleccionado.</p>
        </div>

        <a href="{{ route('administrador.servicios.index') }}"
           class="btn btn-outline-secondary">
            Volver
        </a>

    </div>

    <div class="admin-card">

        <form
            method="POST"
            action="{{ route('administrador.servicios.update', $servicio) }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            @include('administrador.servicios.form')

            <div class="d-flex justify-content-end gap-2 mt-4">

                <a href="{{ route('administrador.servicios.index') }}"
                   class="btn btn-outline-secondary">
                    Cancelar
                </a>

                <button type="submit"
                        class="btn"
                        style="background:#c9a24d; color:#111; font-weight:600;">
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

@endsection
