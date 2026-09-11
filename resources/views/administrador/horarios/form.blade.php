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

    $seleccionado = old(
        'dia_semana',
        $horario->dia_semana ?? request('dia')
    );
@endphp

<div class="card bg-dark border-secondary rounded-4">
    <div class="card-body p-4">

        <div class="mb-4">

            <label class="form-label text-secondary">
                Día de la semana
            </label>

            <select name="dia_semana"
                    class="form-select bg-dark text-light border-secondary"
                    required>

                <option value="">Selecciona un día</option>

                @foreach($dias as $numero => $dia)

                    @if(
                        isset($horario) ||
                        !in_array($numero, $diasOcupados ?? [])
                    )

                        <option value="{{ $numero }}"
                            @selected($seleccionado == $numero)>
                            {{ $dia }}
                        </option>

                    @endif

                @endforeach

            </select>

            @error('dia_semana')
            <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>


        <div class="form-check form-switch mb-4">

            <input
                type="checkbox"
                name="cerrado"
                value="1"
                id="cerrado"
                class="form-check-input"
                @checked(old('cerrado', $horario->cerrado ?? false))
            >

            <label for="cerrado" class="form-check-label">
                La barbería permanece cerrada este día
            </label>

        </div>


        <div class="row g-3" id="contenedorHoras">

            <div class="col-md-6">

                <label class="form-label text-secondary">
                    Hora de apertura
                </label>

                <input
                    type="time"
                    name="hora_apertura"
                    value="{{ old('hora_apertura', isset($horario) && $horario->hora_apertura ? \Carbon\Carbon::parse($horario->hora_apertura)->format('H:i') : '') }}"
                    class="form-control bg-dark text-light border-secondary"
                >

                @error('hora_apertura')
                <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>


            <div class="col-md-6">

                <label class="form-label text-secondary">
                    Hora de cierre
                </label>

                <input
                    type="time"
                    name="hora_cierre"
                    value="{{ old('hora_cierre', isset($horario) && $horario->hora_cierre ? \Carbon\Carbon::parse($horario->hora_cierre)->format('H:i') : '') }}"
                    class="form-control bg-dark text-light border-secondary"
                >

                @error('hora_cierre')
                <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

        </div>


        <div class="d-flex justify-content-end gap-2 mt-4">

            <a href="{{ route('administrador.horarios.index') }}"
               class="btn btn-outline-secondary rounded-pill px-4">
                Cancelar
            </a>

            <button class="btn btn-warning rounded-pill px-4">
                Guardar horario
            </button>

        </div>

    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cerrado = document.getElementById('cerrado');
        const contenedor = document.getElementById('contenedorHoras');
        const inputs = contenedor.querySelectorAll('input');

        const actualizar = () => {
            contenedor.style.opacity = cerrado.checked ? '.35' : '1';

            inputs.forEach(input => {
                input.disabled = cerrado.checked;
            });
        };

        cerrado.addEventListener('change', actualizar);
        actualizar();
    });
</script>
