@php
    $editando = isset($horario);
    $cerradoActual = old('cerrado', $horario->cerrado ?? false);
@endphp

<div class="horario-form-content">

    <div class="form-section">

        <div class="form-section-header">
            <div class="section-icon">◫</div>
            <div>
                <h5>Configuración del día</h5>
                <p>Selecciona el día y define su disponibilidad.</p>
            </div>
        </div>

        <div class="form-fields">

            <div class="form-group-custom">
                <label for="dia_semana">Día de la semana</label>

                <select id="dia_semana"
                        name="dia_semana"
                        class="form-select @error('dia_semana') is-invalid @enderror"
                        required>
                    <option value="">Selecciona un día</option>

                    @foreach([1 => 'Lunes',2 => 'Martes',3 => 'Miércoles',4 => 'Jueves',5 => 'Viernes',6 => 'Sábado',7 => 'Domingo'] as $numero => $dia)
                        <option value="{{ $numero }}" {{ (string) old('dia_semana', $horario->dia_semana ?? '') === (string) $numero ? 'selected' : '' }}>
                            {{ $dia }}
                        </option>
                    @endforeach
                </select>

                @error('dia_semana')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="estado-dia">
                <div>
                    <strong>Día cerrado</strong>
                    <span>Actívalo cuando la barbería no brinde servicio este día.</span>
                </div>

                <div class="form-check form-switch m-0">
                    <input type="hidden" name="cerrado" value="0">

                    <input class="form-check-input"
                           type="checkbox"
                           id="cerrado"
                           name="cerrado"
                           value="1"
                        {{ $cerradoActual ? 'checked' : '' }}>
                </div>
            </div>

        </div>

    </div>

    <div class="form-section">

        <div class="form-section-header">
            <div class="section-icon">◷</div>
            <div>
                <h5>Horario de atención</h5>
                <p>Establece la hora de apertura y cierre.</p>
            </div>
        </div>

        <div class="horas-grid" id="horasContainer">

            <div class="form-group-custom">
                <label for="hora_apertura">Hora de apertura</label>

                <input type="time"
                       id="hora_apertura"
                       name="hora_apertura"
                       value="{{ old('hora_apertura', isset($horario) && $horario->hora_apertura ? \Carbon\Carbon::parse($horario->hora_apertura)->format('H:i') : '') }}"
                       class="form-control @error('hora_apertura') is-invalid @enderror">

                @error('hora_apertura')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group-custom">
                <label for="hora_cierre">Hora de cierre</label>

                <input type="time"
                       id="hora_cierre"
                       name="hora_cierre"
                       value="{{ old('hora_cierre', isset($horario) && $horario->hora_cierre ? \Carbon\Carbon::parse($horario->hora_cierre)->format('H:i') : '') }}"
                       class="form-control @error('hora_cierre') is-invalid @enderror">

                @error('hora_cierre')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="closed-message" id="closedMessage">
            <span>✓</span>
            Este día permanecerá cerrado, por lo que no necesita horario de apertura ni cierre.
        </div>

    </div>

</div>

<div class="horario-form-actions">
    <a href="{{ route('administrador.horarios.index') }}" class="btn-form-secondary">
        Cancelar
    </a>

    <button type="submit" class="btn-form-primary">
        {{ $editando ? 'Guardar cambios' : 'Guardar horario' }}
    </button>
</div>
