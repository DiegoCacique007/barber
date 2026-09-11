<div class="row g-4">

    <div class="col-12 col-lg-7">

        <div class="mb-4">
            <label for="nombre_cliente" class="form-label text-light">
                Nombre del cliente
            </label>

            <input
                type="text"
                name="nombre_cliente"
                id="nombre_cliente"
                class="form-control bg-dark text-light border-secondary @error('nombre_cliente') is-invalid @enderror"
                value="{{ old('nombre_cliente', $cita->nombre_cliente ?? '') }}"
                maxlength="120"
                placeholder="Ej. Juan Pérez"
                required
            >

            @error('nombre_cliente')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="row g-3">

            <div class="col-12 col-md-6">
                <div class="mb-4">

                    <label for="telefono" class="form-label text-light">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        name="telefono"
                        id="telefono"
                        class="form-control bg-dark text-light border-secondary @error('telefono') is-invalid @enderror"
                        value="{{ old('telefono', $cita->telefono ?? '') }}"
                        maxlength="20"
                        placeholder="722 123 4567"
                        required
                    >

                    @error('telefono')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>
            </div>


            <div class="col-12 col-md-6">
                <div class="mb-4">

                    <label for="correo" class="form-label text-light">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        name="correo"
                        id="correo"
                        class="form-control bg-dark text-light border-secondary @error('correo') is-invalid @enderror"
                        value="{{ old('correo', $cita->correo ?? '') }}"
                        maxlength="150"
                        placeholder="cliente@correo.com"
                    >

                    @error('correo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>
            </div>

        </div>


        <div class="row g-3">

            <div class="col-12 col-md-6">
                <div class="mb-4">

                    <label for="fecha" class="form-label text-light">
                        Fecha
                    </label>

                    <input
                        type="date"
                        name="fecha"
                        id="fecha"
                        class="form-control bg-dark text-light border-secondary @error('fecha') is-invalid @enderror"
                        value="{{ old('fecha', isset($cita) ? $cita->fecha->format('Y-m-d') : '') }}"
                        min="{{ now()->format('Y-m-d') }}"
                        required
                    >

                    @error('fecha')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>
            </div>


            <div class="col-12 col-md-6">
                <div class="mb-4">

                    <label for="hora" class="form-label text-light">
                        Hora
                    </label>

                    <input
                        type="time"
                        name="hora"
                        id="hora"
                        class="form-control bg-dark text-light border-secondary @error('hora') is-invalid @enderror"
                        value="{{ old('hora', isset($cita) ? substr($cita->hora, 0, 5) : '') }}"
                        required
                    >

                    @error('hora')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>
            </div>

        </div>

    </div>


    <div class="col-12 col-lg-5">

        <div
            class="p-4 rounded-4"
            style="
                background:#101010;
                border:1px solid rgba(255,255,255,.08);
            "
        >

            <div class="mb-4">

                <span
                    class="d-inline-block mb-3"
                    style="
                        color:#c9a24d;
                        font-size:12px;
                        text-transform:uppercase;
                        letter-spacing:1.4px;
                    "
                >
                    Estado de la cita
                </span>

                <label for="estado_cita_id" class="form-label text-light">
                    Estado actual
                </label>

                <select
                    name="estado_cita_id"
                    id="estado_cita_id"
                    class="form-select bg-dark text-light border-secondary @error('estado_cita_id') is-invalid @enderror"
                    required
                >

                    <option value="">
                        Selecciona un estado
                    </option>

                    @foreach($estados as $estado)

                        <option
                            value="{{ $estado->id }}"
                            @selected(
                                old(
                                    'estado_cita_id',
                                    $cita->estado_cita_id ?? ''
                                ) == $estado->id
                            )
                        >
                            {{ $estado->nombre }}
                        </option>

                    @endforeach

                </select>

                @error('estado_cita_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>


            <div
                class="p-3 rounded-3"
                style="
                    background:rgba(201,162,77,.06);
                    border:1px solid rgba(201,162,77,.15);
                "
            >

                <div
                    class="mb-2"
                    style="
                        color:#c9a24d;
                        font-size:13px;
                        font-weight:600;
                    "
                >
                    Información
                </div>

                <p
                    class="mb-0"
                    style="
                        color:#858585;
                        font-size:12px;
                        line-height:1.7;
                    "
                >
                    Las citas pendientes y confirmadas ocupan el horario
                    seleccionado. Las citas canceladas o rechazadas permiten
                    que ese horario vuelva a estar disponible.
                </p>

            </div>

        </div>

    </div>

</div>
