@php
    $editando = isset($servicio);
@endphp

<div class="servicio-form-grid">

    <div class="servicio-fields">

        <div class="form-group-custom">

            <label for="nombre">
                Nombre del servicio
            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                class="form-control @error('nombre') is-invalid @enderror"
                value="{{ old('nombre', $servicio->nombre ?? '') }}"
                placeholder="Ej. Low Fade"
                required
            >

            @error('nombre')
            <div class="form-error">{{ $message }}</div>
            @enderror

        </div>


        <div class="form-group-custom">

            <label for="descripcion">
                Descripción
            </label>

            <textarea
                id="descripcion"
                name="descripcion"
                class="form-control servicio-textarea @error('descripcion') is-invalid @enderror"
                placeholder="Describe brevemente el servicio..."
            >{{ old('descripcion', $servicio->descripcion ?? '') }}</textarea>

            @error('descripcion')
            <div class="form-error">{{ $message }}</div>
            @enderror

        </div>


        <div class="form-group-custom">

            <label for="precio">
                Precio
            </label>

            <div class="precio-input">

                <span>$</span>

                <input
                    type="number"
                    id="precio"
                    name="precio"
                    class="form-control @error('precio') is-invalid @enderror"
                    value="{{ old('precio', $servicio->precio ?? '') }}"
                    min="0"
                    step="0.01"
                    placeholder="0.00"
                    required
                >

            </div>

            @error('precio')
            <div class="form-error">{{ $message }}</div>
            @enderror

        </div>


        <div class="servicio-status">

            <div>

                <strong>
                    Servicio activo
                </strong>

                <span>
                    Los servicios inactivos no se mostrarán en la landing page.
                </span>

            </div>

            <div class="form-check form-switch">

                <input type="hidden"
                       name="activo"
                       value="0">

                <input
                    class="form-check-input"
                    type="checkbox"
                    id="activo"
                    name="activo"
                    value="1"
                    {{ old('activo', $servicio->activo ?? true) ? 'checked' : '' }}
                >

            </div>

        </div>

    </div>


    <div class="servicio-image-column">

        <label class="image-label">
            Fotografía del corte
        </label>


        <div class="image-box">

            @if($editando && $servicio->imagen)

                <div class="image-preview" id="imagePreview">

                    <img src="{{ asset('storage/' . $servicio->imagen) }}"
                         id="previewImage"
                         alt="{{ $servicio->nombre }}">

                </div>

            @else

                <div class="image-preview empty"
                     id="imagePreview">

                    <span id="emptyPreview">
                        ✂
                    </span>

                    <img id="previewImage"
                         alt="Vista previa"
                         style="display:none">

                </div>

            @endif


            <input
                type="file"
                id="imagen"
                name="imagen"
                class="form-control image-file @error('imagen') is-invalid @enderror"
                accept=".jpg,.jpeg,.png,.webp"
            >

            <span class="image-help">
                JPG, JPEG, PNG o WEBP. Máximo 4 MB.
            </span>

            @error('imagen')
            <div class="form-error">{{ $message }}</div>
            @enderror

        </div>

    </div>

</div>


<div class="servicio-form-actions">

    <a href="{{ route('administrador.servicios.index') }}"
       class="btn-form-secondary">
        Cancelar
    </a>

    <button type="submit"
            class="btn-form-primary">

        {{ $editando ? 'Guardar cambios' : 'Guardar servicio' }}

    </button>

</div>
