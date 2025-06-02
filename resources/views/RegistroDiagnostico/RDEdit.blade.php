@extends('Layouts.app')

@section('titulo', 'Editar Diagnóstico de Equipo')

@section('contenido')

@include('sweetalert::alert')

<style> /* Estilos CSS para la vista, agregados titulos, textos imagenes, botones.*/
    body {
        background: #f3f4f6;
        font-family: 'Poppins', sans-serif;
        color: #111827;
    }

    .container-custom {
        max-width: 850px;
        margin: 40px auto;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        padding: 2rem;
    }

    h3.title {
        font-weight: 600;
        font-size: 1.5rem;
        text-align: center;
        margin-bottom: 1.5rem;
        color: #0f172a;
    }

    label {
        font-weight: 500;
        font-size: 0.9rem;
        margin-bottom: 5px;
        color: #374151;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #d1d5db;
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
        color: #1f2937;
    }

    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .text-danger {
        font-size: 0.75rem;
        color: #dc2626;
        margin-top: 3px;
    }

    textarea.form-control {
        height: 100px;
        resize: vertical;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1rem;
    }
/*Muestra el tamaño de la imagen y su calidad.*/
    .img-preview {
        margin-top: 0.5rem;
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }
/*Estilo del boton.*/
    .btn {
        font-weight: 600;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .btn-secondary {
        background-color: #e5e7eb;
        color: #1f2937;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #d1d5db;
    }

    .btn-info {
        background-color:  #16a34a; /* Verde un poco más oscuro al hacer hover */;
        border-color: #3b82f6;
        color: white;
    }

    .btn-info:hover {
        background-color: #2563eb;
        border-color: #2563eb;
    }

    .btn-group {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }
/*Visualiza la imagen mas de cerca.*/
    .lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .lightbox img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        transition: transform 0.3s ease;
    }

    .lightbox.show {
        display: flex;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
<!-- Vista de editor . -->
<div class="container-custom">
    <h3 class="title">Editar Diagnóstico de Equipo</h3>

    <form method="post" action="{{ route('registrodiagnostico.update', $registro->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
<!-- Muestra su select para seleccionar cada una de las empresas. -->
        <div class="form-group">
            <label for="empresa">Empresa</label>
            <select id="empresa" name="empresa" class="form-control @error('empresa') is-invalid @enderror">
                <option value="">Seleccione una opción</option>
                @foreach (['TAOSA', 'TAOPAR', 'Clasificadora y Exportadora de Tabaco', 'TAOMOR', 'TAOCA', 'TAOGUALI', 'La Vega', 'Calpule', 'San Luis', 'Azacualpa', 'Escogida3'] as $empresa)
                    <option value="{{ $empresa }}" {{ old('empresa', $registro->empresa) == $empresa ? 'selected' : '' }}>{{ $empresa }}</option>
                @endforeach
            </select>
            @error('empresa') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
<!-- Muestra en texto los datos ya creados.. -->
        <div class="form-row">
            <div class="form-group">
                <label for="equipo">Hardware</label>
                <input type="text" name="equipo" id="equipo" class="form-control @error('equipo') is-invalid @enderror"
                       value="{{ old('equipo', $registro->equipo) }}" maxlength="50">
                @error('equipo') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" name="modelo" id="modelo" class="form-control @error('modelo') is-invalid @enderror"
                       value="{{ old('modelo', $registro->modelo) }}" maxlength="30">
                @error('modelo') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control @error('marca') is-invalid @enderror"
                       value="{{ old('marca', $registro->marca) }}" maxlength="30">
                @error('marca') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="serie">Serie</label>
                <input type="text" name="serie" id="serie" class="form-control @error('serie') is-invalid @enderror"
                       value="{{ old('serie', $registro->serie) }}" maxlength="40">
                @error('serie') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción del diagnóstico</label>
            <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                      maxlength="300">{{ old('descripcion', $registro->descripcion) }}</textarea>
            @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror">
                <option value="">Seleccione una opción</option>
                <option value="Mal estado" {{ old('estado', $registro->estado) == 'Mal estado' ? 'selected' : '' }}>Mal estado</option>
                <option value="Regular" {{ old('estado', $registro->estado) == 'Regular' ? 'selected' : '' }}>Regular</option>
                <option value="Buen estado" {{ old('estado', $registro->estado) == 'Buen estado' ? 'selected' : '' }}>Buen estado</option>
            </select>
            @error('estado') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
<!-- Muestra las imagenes tanto iniciales y finales. -->
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
    <div class="form-group" style="flex: 1; min-width: 200px;">
        <label for="foto_antes">Imagen Inicial</label>
        <input type="file" name="foto_antes" id="foto_antes" accept="image/*" class="form-control @error('foto_antes') is-invalid @enderror" onchange="previewImage(this, 'previewAntes')">
        @error('foto_antes') <span class="text-danger">{{ $message }}</span> @enderror
        <img id="previewAntes" src="{{ $registro->foto_antes ? asset('img/post/' . $registro->foto_antes) : '' }}"
             class="img-preview"
             style="{{ $registro->foto_antes ? '' : 'display:none;' }}"
             onclick="openLightbox('{{ asset('img/post/' . $registro->foto_antes) }}')">
    </div>

    <div class="form-group" style="flex: 1; min-width: 200px;">
        <label for="foto_despues">Imagen Final</label>
        <input type="file" name="foto_despues" id="foto_despues" accept="image/*" class="form-control @error('foto_despues') is-invalid @enderror" onchange="previewImage(this, 'previewDespues')">
        @error('foto_despues') <span class="text-danger">{{ $message }}</span> @enderror
        <img id="previewDespues" src="{{ $registro->foto_despues ? asset('img/post/' . $registro->foto_despues) : '' }}"
             class="img-preview"
             style="{{ $registro->foto_despues ? '' : 'display:none;' }}"
             onclick="openLightbox('{{ asset('img/post/' . $registro->foto_despues) }}')">
    </div>
</div>
<!-- Boton para actualizar. -->
        <div class="btn-group">
            <a href="{{ route('registrodiagnostico.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Regresar</a>
            <button type="submit" class="btn btn-info"><i class="fas fa-sync-alt me-1"></i> Actualizar</button>
        </div>
    </form>
</div>

<!-- Lightbox general. -->
<div id="globalLightbox" class="lightbox" onclick="closeLightbox()">
    <img id="lightboxImage" src="" alt="Vista ampliada">
</div>

<script>    //Funcion para que las imagenes se puedan visualizar mas grandes o mas de cerca
    function previewImage(input, previewId) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.getElementById(previewId);
            img.src = e.target.result;
            img.style.display = 'block';
            img.onclick = () => openLightbox(e.target.result);
        };
        if (file) reader.readAsDataURL(file);
    }

    function openLightbox(src) {
        const lightbox = document.getElementById('globalLightbox');
        const lightboxImg = document.getElementById('lightboxImage');
        lightboxImg.src = src;
        lightbox.classList.add('show');
    }

    function closeLightbox() {
        const lightbox = document.getElementById('globalLightbox');
        lightbox.classList.remove('show');
    }
</script>

@endsection
