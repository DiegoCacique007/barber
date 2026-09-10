<div class="row g-4">

    <div class="col-12 col-lg-7">

        <div class="mb-4">
            <label for="nombre" class="form-label text-light">
                Nombre del servicio
            </label>

            <input
                type="text"
                name="nombre"
                id="nombre"
                class="form-control bg-dark text-light border-secondary @error('nombre') is-invalid @enderror"
                value="{{ old('nombre', $servicio->nombre ?? '') }}"
                maxlength="100"
                required
            >

            @error('nombre')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="descripcion" class="form-label text-light">
                Descripción
            </label>

            <textarea
                name="descripcion"
                id="descripcion"
                rows="5"
                maxlength="1000"
                class="form-control bg-dark text-light border-secondary @error('descripcion') is-invalid @enderror"
            >{{ old('descripcion', $servicio->descripcion ?? '') }}</textarea>

            @error('descripcion')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="precio" class="form-label text-light">
                Precio
            </label>

            <div class="input-group">
                <span class="input-group-text bg-dark text-secondary border-secondary">
                    $
                </span>

                <input
                    type="number"
                    name="precio"
                    id="precio"
                    step="0.01"
                    min="0"
                    class="form-control bg-dark text-light border-secondary @error('precio') is-invalid @enderror"
                    value="{{ old('precio', $servicio->precio ?? '') }}"
                    required
                >
            </div>

            @error('precio')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-check form-switch mb-3">
            <input
                class="form-check-input"
                type="checkbox"
                name="activo"
                value="1"
                id="activo"
                {{ old('activo', $servicio->activo ?? true) ? 'checked' : '' }}
            >

            <label class="form-check-label text-light" for="activo">
                Servicio activo
            </label>
        </div>

        <p class="text-secondary small">
            Los servicios inactivos no se mostrarán en la landing page.
        </p>

    </div>

    <div class="col-12 col-lg-5">

        <label for="imagen" class="form-label text-light">
            Fotografía del corte
        </label>

        <div class="p-4 border border-secondary rounded-4 bg-dark">

            @isset($servicio)
                @if($servicio->imagen)
                    <img
                        src="{{ asset('storage/' . $servicio->imagen) }}"
                        alt="{{ $servicio->nombre }}"
                        class="img-fluid rounded-3 mb-3"
                        style="width:100%; max-height:280px; object-fit:cover;"
                    >
                @endif
            @endisset

            <input
                type="file"
                name="imagen"
                id="imagen"
                accept=".jpg,.jpeg,.png,.webp"
                class="form-control bg-dark text-light border-secondary @error('imagen') is-invalid @enderror"
            >

            @error('imagen')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            <div class="form-text text-secondary mt-2">
                JPG, JPEG, PNG o WEBP. Máximo 4 MB.
            </div>

        </div>

    </div>

</div>
