@php
    $editando = isset($redSocial);
    $activoActual = old('activo', $redSocial->activo ?? true);
@endphp

<div class="red-form-content">

    {{-- =====================================================
         INFORMACIÓN PRINCIPAL
    ====================================================== --}}

    <div class="form-section">

        <div class="form-section-header">

            <div class="section-icon">
                ◎
            </div>

            <div>
                <h5>Información de la red social</h5>
                <p>Ingresa el nombre y enlace de la cuenta.</p>
            </div>

        </div>

        <div class="form-fields">

            <div class="form-group-custom">

                <label for="nombre">
                    Nombre de la red social
                </label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre', $redSocial->nombre ?? '') }}"
                    class="form-control @error('nombre') is-invalid @enderror"
                    placeholder="Ej. Instagram"
                    maxlength="50"
                    required
                >

                @error('nombre')
                <div class="form-error">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="form-group-custom">

                <label for="url">
                    Enlace
                </label>

                <input
                    type="url"
                    id="url"
                    name="url"
                    value="{{ old('url', $redSocial->url ?? '') }}"
                    class="form-control @error('url') is-invalid @enderror"
                    placeholder="https://instagram.com/barber"
                    required
                >

                @error('url')
                <div class="form-error">
                    {{ $message }}
                </div>
                @enderror

            </div>

        </div>

    </div>

    {{-- =====================================================
         CONFIGURACIÓN
    ====================================================== --}}

    <div class="form-section">

        <div class="form-section-header">

            <div class="section-icon">
                ⚙
            </div>

            <div>
                <h5>Configuración</h5>
                <p>Define el icono y visibilidad en el sitio público.</p>
            </div>

        </div>

        <div class="form-fields">

            <div class="form-group-custom">

                <label for="icono">
                    Icono
                </label>

                <input
                    type="text"
                    id="icono"
                    name="icono"
                    value="{{ old('icono', $redSocial->icono ?? '') }}"
                    class="form-control @error('icono') is-invalid @enderror"
                    placeholder="Opcional"
                    maxlength="100"
                >

                <span class="form-help">
                    Campo opcional para guardar una clase o referencia de icono.
                </span>

                @error('icono')
                <div class="form-error">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="estado-red">

                <div>

                    <strong>
                        Red social activa
                    </strong>

                    <span>
                        Las redes activas se mostrarán en el sitio público.
                    </span>

                </div>

                <div class="form-check form-switch m-0">

                    <input type="hidden"
                           name="activo"
                           value="0">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="activo"
                        name="activo"
                        value="1"
                        {{ $activoActual ? 'checked' : '' }}
                    >

                </div>

            </div>

        </div>

    </div>

</div>

<div class="red-form-actions">

    <a href="{{ route('administrador.redes.index') }}"
       class="btn-form-secondary">
        Cancelar
    </a>

    <button type="submit"
            class="btn-form-primary">
        {{ $editando ? 'Guardar cambios' : 'Guardar red social' }}
    </button>

</div>
