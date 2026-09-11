@extends('layouts.administrador')

@section('title', 'Nuevo horario')

@section('content')

    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            Nuevo horario
        </h2>

        <p class="text-secondary mb-0">
            Configura un nuevo día de atención.
        </p>
    </div>

    <form method="POST"
          action="{{ route('administrador.horarios.store') }}">

        @csrf

        @include('administrador.horarios.form')

    </form>

@endsection
