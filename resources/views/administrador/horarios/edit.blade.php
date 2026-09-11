@extends('layouts.administrador')

@section('title', 'Editar horario')

@section('content')

    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            Editar horario
        </h2>

        <p class="text-secondary mb-0">
            Modifica el horario de atención seleccionado.
        </p>
    </div>

    <form method="POST"
          action="{{ route('administrador.horarios.update', $horario) }}">

        @csrf
        @method('PUT')

        @include('administrador.horarios.form')

    </form>

@endsection
