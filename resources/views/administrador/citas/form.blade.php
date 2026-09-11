@php
    $editando = isset($cita);
@endphp

<div class="cita-form-grid">

    <div class="form-section">

        <div class="form-section-header">

            <div class="section-icon">
                ♙
            </div>

            <div>
                <h5>Información del cliente</h5>
                <p>Datos de contacto de la persona que realizará la cita.</p>
            </div>

        </div>

        <div class="form-fields">

            <div class="form-group-custom">

                <label for="nombre_cliente">
                    Nombre del cliente
                </label>

                <input type="text"
                       id="nombre_cliente"
                       name="nombre_cliente"
                       value="{{ old('nombre_cliente',$cita->nombre_cliente ?? '') }}"
                       class="form-control @error('nombre_cliente') is-invalid @enderror"
                       placeholder="Nombre completo"
                       required>

                @error('nombre_cliente')
                <div class="form-error">{{ $message }}</div>
                @enderror

            </div>


            <div class="form-row-custom">

                <div class="form-group-custom">

                    <label for="telefono">
                        Teléfono
                    </label>

                    <input type="text"
                           id="telefono"
                           name="telefono"
                           value="{{ old('telefono',$cita->telefono ?? '') }}"
                           class="form-control @error('telefono') is-invalid @enderror"
                           placeholder="Ej. 729 123 4567"
                           required>

                    @error('telefono')
                    <div class="form-error">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

    </div>


    <div class="form-section">

        <div class="form-section-header">

            <div class="section-icon">
                ◷
            </div>

            <div>
                <h5>Programación</h5>
                <p>Selecciona la fecha, hora y estado de la reservación.</p>
            </div>

        </div>


        <div class="form-fields">

            <div class="form-row-custom">

                <div class="form-group-custom">

                    <label for="fecha">
                        Fecha
                    </label>

                    <input type="date"
                           id="fecha"
                           name="fecha"
                           value="{{ old('fecha',isset($cita) ? $cita->fecha->format('Y-m-d') : '') }}"
                           class="form-control @error('fecha') is-invalid @enderror"
                           required>

                    @error('fecha')
                    <div class="form-error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="form-group-custom">

                    <label for="hora">
                        Hora
                    </label>

                    <input type="time"
                           id="hora"
                           name="hora"
                           value="{{ old('hora',isset($cita) ? \Carbon\Carbon::parse($cita->hora)->format('H:i') : '') }}"
                           class="form-control @error('hora') is-invalid @enderror"
                           required>

                    @error('hora')
                    <div class="form-error">{{ $message }}</div>
                    @enderror

                </div>

            </div>


            <div class="form-group-custom">

                <label for="estado_cita_id">
                    Estado
                </label>

                <select id="estado_cita_id"
                        name="estado_cita_id"
                        class="form-select @error('estado_cita_id') is-invalid @enderror"
                        required>

                    <option value="">
                        Selecciona un estado
                    </option>

                    @foreach($estados as $estado)

                        <option value="{{ $estado->id }}"
                            {{ (string) old('estado_cita_id',$cita->estado_cita_id ?? '') === (string) $estado->id ? 'selected' : '' }}>
                            {{ $estado->nombre }}
                        </option>

                    @endforeach

                </select>

                @error('estado_cita_id')
                <div class="form-error">{{ $message }}</div>
                @enderror

            </div>

        </div>

    </div>

</div>


<div class="cita-form-actions">

    <a href="{{ route('administrador.citas.index') }}"
       class="btn-form-secondary">
        Cancelar
    </a>

    <button type="submit"
            class="btn-form-primary">
        {{ $editando ? 'Guardar cambios' : 'Guardar cita' }}
    </button>

</div>
