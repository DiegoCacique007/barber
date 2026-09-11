@extends('layouts.administrador')

@section('title', 'Horarios')

@section('content')

    @php
        $dias = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            7 => 'Domingo'
        ];
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Horarios</h2>
            <p class="text-secondary mb-0">
                Configura los días y horas de atención de la barbería.
            </p>
        </div>

        @if($horarios->count() < 7)
            <a href="{{ route('administrador.horarios.create') }}"
               class="btn btn-warning rounded-pill px-4">
                + Agregar horario
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-3">

        @foreach($dias as $numero => $dia)

            @php
                $horario = $horarios->get($numero);
            @endphp

            <div class="col-12">

                <div class="card bg-dark border-secondary rounded-4">
                    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">

                        <div>
                            <small class="text-secondary">
                                Día {{ $numero }}
                            </small>

                            <h5 class="mb-0 mt-1">
                                {{ $dia }}
                            </h5>
                        </div>

                        <div class="text-md-center">

                            @if(!$horario)

                                <span class="badge bg-secondary">
                                Sin configurar
                            </span>

                            @elseif($horario->cerrado)

                                <span class="badge bg-danger">
                                Cerrado
                            </span>

                            @else

                                <small class="text-secondary d-block">
                                    Horario de atención
                                </small>

                                <strong>
                                    {{ \Carbon\Carbon::parse($horario->hora_apertura)->format('h:i A') }}
                                    —
                                    {{ \Carbon\Carbon::parse($horario->hora_cierre)->format('h:i A') }}
                                </strong>

                            @endif

                        </div>

                        <div class="d-flex gap-2">

                            @if($horario)

                                <a href="{{ route('administrador.horarios.edit', $horario) }}"
                                   class="btn btn-outline-warning btn-sm rounded-pill px-3">
                                    Editar
                                </a>

                                <form method="POST"
                                      action="{{ route('administrador.horarios.destroy', $horario) }}"
                                      onsubmit="return confirm('¿Eliminar este horario?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                        Eliminar
                                    </button>

                                </form>

                            @else

                                <a href="{{ route('administrador.horarios.create', ['dia' => $numero]) }}"
                                   class="btn btn-outline-light btn-sm rounded-pill px-3">
                                    Configurar
                                </a>

                            @endif

                        </div>

                    </div>
                </div>

            </div>

        @endforeach

    </div>

@endsection
