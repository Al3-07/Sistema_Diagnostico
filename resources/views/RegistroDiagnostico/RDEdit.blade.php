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
        background-color: #95a5a6;
        color: #1f2937;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #7f8c8d;
    }

    .btn-info {
        background-color:  rgb(71, 154, 255); /* Verde un poco más oscuro al hacer hover */;
        border-color: #3b82f6;
        color: white;
    }

    .btn-info:hover {
        background-color: rgb(60, 140, 235);
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
    <h5 class="text-end mb-4" style="color: #00b894;">
    <strong>Correlativo:</strong> {{ $correlativo }}
    </h5>
    <form method="post" action="{{ route('registrodiagnostico.update', $registro->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
<!-- Muestra su select para seleccionar cada una de las empresas. -->
 <div class="mb-3">
    <label for="fecha" class="form-label">Fecha</label>
<input type="date" name="fecha" class="form-control" value="{{ old('fecha', $registro->fecha) }}">
</div>

        <div class="form-group">
            <label for="empresa_id" class="form-label">Empresa</label>
                <select id="empresa_id" name="empresa_id" class="form-control @error('empresa_id') is-invalid @enderror">
                 <option value="">Seleccione una opción</option>
                     @foreach ($empresas as $empresa)
                   <option value="{{ $empresa->id }}" {{ $empresa->id == old('empresa_id', $registro->empresa_id) ? 'selected' : '' }}>
                     {{ $empresa->empresa }}
                     </option>
                     @endforeach
                </select>
                     @error('empresa_id')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
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
  <!-- Imagen Antes -->
  <div class="mb-4">
    <label class="form-label">Imagen del Equipo</label>
    <div class="image-upload-container">
      <div class="d-flex flex-column align-items-center">
        <i class="fas fa-camera fa-3x mb-2" style="color: var(--primary-color);"></i>
        <p class="mb-3 text-muted">Suba una imagen o tome una foto del equipo</p>

        <div class="d-flex gap-2 justify-content-center w-100 flex-wrap">
          <!-- Input normal para seleccionar archivo -->
          <label for="foto_antes" class="btn btn-outline-primary flex-grow-1 flex-md-grow-0">
            <i class="fas fa-upload me-2"></i>Seleccionar
            <input type="file" name="foto_antes" id="foto_antes" 
                   accept="image/*" class="d-none" 
                   onchange="previewImage(this, 'previewAntes')">
          </label>

          <!-- Botón para abrir cámara -->
          <label for="foto_antes_camera_file" class="btn btn-primary flex-grow-1 flex-md-grow-0">
            <i class="fas fa-camera me-2"></i>Tomar Foto
            <input type="file" name="foto_antes_camera_file" id="foto_antes_camera_file" 
                   accept="image/*" capture="environment" class="d-none" 
                   onchange="handleCameraFile(this, 'foto_antes_camera', 'previewAntes')">
          </label>

          <!-- Input oculto para enviar Base64 -->
          <input type="hidden" name="foto_antes_camera" id="foto_antes_camera">
        </div>

        @error('foto_antes')
          <div class="text-danger mt-2 small">{{ $message }}</div>
        @enderror
      </div>

      <!-- Vista previa de la imagen -->
      <img id="previewAntes" class="img-preview mt-3" onclick="openLightbox(this.src)">
    </div>
  </div>

  <!-- Imagen Después -->
  <div class="mb-4">
    <label class="form-label">Imagen del Equipo</label>
    <div class="image-upload-container">
      <div class="d-flex flex-column align-items-center">
        <i class="fas fa-camera fa-3x mb-2" style="color: var(--primary-color);"></i>
        <p class="mb-3 text-muted">Suba una imagen o tome una foto del equipo</p>

        <div class="d-flex gap-2 justify-content-center w-100 flex-wrap">
          <!-- Input normal para seleccionar archivo -->
          <label for="foto_despues" class="btn btn-outline-primary flex-grow-1 flex-md-grow-0">
            <i class="fas fa-upload me-2"></i>Seleccionar
            <input type="file" name="foto_despues" id="foto_despues" 
                   accept="image/*" class="d-none" 
                   onchange="previewImage(this, 'previewDespues')">
          </label>

          <!-- Botón para abrir cámara -->
          <label for="foto_despues_camera_file" class="btn btn-primary flex-grow-1 flex-md-grow-0">
            <i class="fas fa-camera me-2"></i>Tomar Foto
            <input type="file" name="foto_despues_camera_file" id="foto_despues_camera_file" 
                   accept="image/*" capture="environment" class="d-none" 
                   onchange="handleCameraFile(this, 'foto_despues_camera', 'previewDespues')">
          </label>

          <!-- Input oculto para enviar Base64 -->
          <input type="hidden" name="foto_despues_camera" id="foto_despues_camera">
        </div>

        @error('foto_despues')
          <div class="text-danger mt-2 small">{{ $message }}</div>
        @enderror
      </div>

      <!-- Vista previa de la imagen -->
      <img id="previewDespues" class="img-preview mt-3" onclick="openLightbox(this.src)">
    </div>
    <div class="d-flex justify-content-end mt-auto pt-3">
            <a href="{{ route('registrodiagnostico.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-1"></i> Regresar
            </a>
            <button type="submit" class="btn btn-info">
                <i class="fas fa-sync-alt me-1"></i> Actualizar
            </button>
        </div>
  </div>
</div>


<!-- Boton para actualizar. -->
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
     // Función para preview de archivos normales (antes o después)
  function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById(previewId).src = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  // Convierte archivo de input file a base64, actualiza input hidden y vista previa
function handleCameraFile(inputFile, hiddenInputId, previewImgId) {
    const file = inputFile.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        // e.target.result = base64
        document.getElementById(hiddenInputId).value = e.target.result;

        // Actualizar vista previa
        document.getElementById(previewImgId).src = e.target.result;
    };
    reader.readAsDataURL(file);
}

// Vista previa simple para inputs tipo file normales
function previewImage(inputFile, previewImgId) {
    const file = inputFile.files[0];
    if (!file) return;
    const url = URL.createObjectURL(file);
    document.getElementById(previewImgId).src = url;
}

</script>

@endsection
