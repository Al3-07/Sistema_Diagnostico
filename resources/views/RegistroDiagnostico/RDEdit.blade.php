@extends('Layouts.app')

@section('titulo', 'Editar Diagnóstico de Equipo')

@section('contenido')

@include('sweetalert::alert')

<style> 
/* Estilos CSS para la vista, agregados titulos, textos imagenes, botones.*/
    body {  
        background: #f3f4f6; /* Fondo de la página.*/       
        font-family: 'Poppins', sans-serif;
        color: #111827; /* Color del texto.*/ 
    }
    
    .container-custom {
        max-width: 850px;   /* Ancho maximo del contenedor.*/
        margin: 40px auto; /* Margen superior e inferior.*/
        background: white; /* Color de fondo del contenedor.*/
        border-radius: 16px; /* Radio de la esquina del contenedor.*/
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08); /* Sombra del contenedor.*/
        padding: 2rem; /* Margen interno del contenedor.*/
    }

    h3.title {
        font-weight: 600; /* Peso de la fuente.*/
        font-size: 1.5rem; /* Tamaño de la fuente.*/
        text-align: center; /* Alineación del texto.*/
        margin-bottom: 1.5rem; /* Margen inferior.*/
        color: #0f172a; /* Color del texto.*/
    }

    label {
        font-weight: 500; /* Peso de la fuente.*/
        font-size: 0.9rem; /* Tamaño de la fuente.*/
        margin-bottom: 5px; /* Margen inferior.*/
        color: #374151; /* Color del texto.*/
    }

    .form-control {
        border-radius: 10px; /* Radio de la esquina del contenedor.*/
        border: 1px solid #d1d5db; /* Bordes del contenedor.*/
        padding: 0.6rem 1rem; /* Margen interno del contenedor.*/
        font-size: 0.9rem; /* Tamaño de la fuente.*/
        color: #1f2937; /* Color del texto.*/ 
    }

    .form-control:focus {
        border-color: #3b82f6; /* Bordes del contenedor.*/
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2); /* Sombra del contenedor.*/
    }

    .form-control.is-invalid {
        border-color: #dc3545; /* Bordes del contenedor.*/
    }

    .text-danger {
        font-size: 0.75rem; /* Tamaño de la fuente.*/
        color: #dc2626; /* Color del texto.*/
        margin-top: 3px; /* Margen superior.*/
    }

    textarea.form-control {
        height: 100px; /* Altura del textarea.*/
        resize: vertical; /* Redimensionar verticalmente.*/
    }

    .form-group {
        margin-bottom: 1rem; /* Margen inferior.*/
    }

    .form-row {
        display: grid; /* Grid.*/
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); /* Columnas.*/
        gap: 1rem; /* Margen.*/
    }
/*Muestra el tamaño de la imagen y su calidad.*/
    .img-preview {
        margin-top: 0.5rem; /* Margen superior.*/
        max-width: 100%; /* Ancho maximo.*/
        height: auto; /* Altura maxima.*/
        border-radius: 10px; /* Radio de la esquina del contenedor.*/
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra del contenedor.*/
        cursor: pointer;
    }
/*Estilo del boton.*/
    .btn {
        font-weight: 600; /* Peso de la fuente.*/
        padding: 0.5rem 1.25rem; /* Margen interno del contenedor.*/
        border-radius: 8px; /* Radio de la esquina del contenedor.*/
        font-size: 0.9rem; /* Tamaño de la fuente.*/
        transition: all 0.3s ease; /* Transicion.*/
    }

    .btn-secondary {
        background-color: #95a5a6; /* Color del boton.*/
        color: #1f2937; /* Color del texto.*/
        border: none; /* Bordes del contenedor.*/
    }

    .btn-secondary:hover {
        background-color: #7f8c8d; /* Color del boton.*/
    }

    .btn-info {
        background-color:  rgb(71, 154, 255); /* Color del boton.*/
        border-color: #3b82f6; /* Color del texto.*/
        color: white; /* Color del texto.*/
    }

    .btn-info:hover {
        background-color: rgb(60, 140, 235); /* Color del boton.*/
        border-color: #2563eb; /* Color del texto.*/
    }

    .btn-group {
        display: flex; /* Flexbox.*/
        justify-content: flex-end; /* Alineación del texto.*/
        gap: 1rem; /* Margen.*/
        margin-top: 2rem; /* Margen superior.*/
    }
/*Visualiza la imagen mas de cerca.*/
    .lightbox {
        position: fixed; /* Posicion fija.*/
        top: 0; /* Margen superior.*/
        left: 0; /* Margen izquierdo.*/
        width: 100%; /* Ancho maximo.*/
        height: 100%; /* Altura maxima.*/
        background: rgba(0, 0, 0, 0.8); /* Color del texto.*/
        display: none; /* Display none.*/
        align-items: center; /* Alineación del texto.*/
        justify-content: center; /* Alineación del texto.*/
        z-index: 9999; /* Z-index.*/
    }

    .lightbox img {
        max-width: 90%; /* Ancho maximo.*/
        max-height: 90%; /* Altura maxima.*/
        border-radius: 12px; /* Radio de la esquina del contenedor.*/
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.3); /* Sombra del contenedor.*/
        transition: transform 0.3s ease; /* Transicion.*/
    }

    .lightbox.show {
        display: flex; /* Display flex.*/
        animation: fadeIn 0.3s ease; /* Transicion.*/
    }

    @keyframes fadeIn {
        from { opacity: 0; } /* Opacidad.*/
        to { opacity: 1; } /* Opacidad.*/
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
<!-- Muestra en texto los datos ya creados. -->
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
  <!-- Imagen Antes. -->
  <div class="mb-4">
    <label class="form-label">Imagen del Equipo</label>
    <div class="image-upload-container">
      <div class="d-flex flex-column align-items-center">
        <i class="fas fa-camera fa-3x mb-2" style="color: var(--primary-color);"></i>
        <p class="mb-3 text-muted">Suba una imagen o tome una foto del equipo</p>

        <div class="d-flex gap-2 justify-content-center w-100 flex-wrap">
          <!-- Input normal para seleccionar archivo. -->
          <label for="foto_antes" class="btn btn-outline-primary flex-grow-1 flex-md-grow-0">
            <i class="fas fa-upload me-2"></i>Seleccionar
            <input type="file" name="foto_antes" id="foto_antes" 
                   accept="image/*" class="d-none" 
                   onchange="previewImage(this, 'previewAntes')">
          </label>

          <!-- Botón para abrir cámara. -->
          <label for="foto_antes_camera_file" class="btn btn-primary flex-grow-1 flex-md-grow-0">
            <i class="fas fa-camera me-2"></i>Tomar Foto
            <input type="file" name="foto_antes_camera_file" id="foto_antes_camera_file" 
                   accept="image/*" capture="environment" class="d-none" 
                   onchange="handleCameraFile(this, 'foto_antes_camera', 'previewAntes')">
          </label>

          <!-- Input oculto para enviar Base64. -->
          <input type="hidden" name="foto_antes_camera" id="foto_antes_camera">
        </div>

        @error('foto_antes')
          <div class="text-danger mt-2 small">{{ $message }}</div>
        @enderror
      </div>

      <!-- Vista previa de la imagen antes. -->
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
          <!-- Input normal para seleccionar archivo. -->
          <label for="foto_despues" class="btn btn-outline-primary flex-grow-1 flex-md-grow-0">
            <i class="fas fa-upload me-2"></i>Seleccionar
            <input type="file" name="foto_despues" id="foto_despues" 
                   accept="image/*" class="d-none" 
                   onchange="previewImage(this, 'previewDespues')">
          </label>

          <!-- Botón para abrir cámara. -->
          <label for="foto_despues_camera_file" class="btn btn-primary flex-grow-1 flex-md-grow-0">
            <i class="fas fa-camera me-2"></i>Tomar Foto
            <input type="file" name="foto_despues_camera_file" id="foto_despues_camera_file" 
                   accept="image/*" capture="environment" class="d-none" 
                   onchange="handleCameraFile(this, 'foto_despues_camera', 'previewDespues')">
          </label>

          <!-- Input oculto para enviar Base64. -->
          <input type="hidden" name="foto_despues_camera" id="foto_despues_camera">
        </div>

        @error('foto_despues')
          <div class="text-danger mt-2 small">{{ $message }}</div>
        @enderror
      </div>

      <!-- Vista previa de la imagen despues. -->
      <img id="previewDespues" class="img-preview mt-3" onclick="openLightbox(this.src)">
    </div>
    <div class="d-flex justify-content-end mt-auto pt-3"><!-- Botones para actualizar y regresar. -->
            <a href="{{ route('registrodiagnostico.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-1"></i> Regresar
            </a>
            <button type="submit" class="btn btn-info">
                <i class="fas fa-sync-alt me-1"></i> Actualizar
            </button>
        </div>
  </div>
</div>
    </form>
</div>

<!-- Lightbox general. -->
<div id="globalLightbox" class="lightbox" onclick="closeLightbox()">
    <img id="lightboxImage" src="" alt="Vista ampliada">
</div>

<script>    //Función para que las imagenes se puedan visualizar mas grandes o mas de cerca.
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
    
    //Función para que las imagenes se puedan visualizar mas grandes o mas de cerca.
    function openLightbox(src) {
        const lightbox = document.getElementById('globalLightbox');
        const lightboxImg = document.getElementById('lightboxImage');
        lightboxImg.src = src;
        lightbox.classList.add('show');
    }

    //Función para que las imagenes se puedan visualizar mas grandes o mas de cerca.
    function closeLightbox() {
        const lightbox = document.getElementById('globalLightbox');
        lightbox.classList.remove('show');
    }
     // Función para preview de archivos normales (antes o después).
  function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById(previewId).src = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  // Convierte archivo de input file a base64, actualiza input hidden y vista previa.
function handleCameraFile(inputFile, hiddenInputId, previewImgId) {
    const file = inputFile.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        // e.target.result = base64.
        document.getElementById(hiddenInputId).value = e.target.result;

        // Actualizar vista previa.
        document.getElementById(previewImgId).src = e.target.result;
    };
    reader.readAsDataURL(file);
}

// Vista previa simple para inputs tipo file normales.
function previewImage(inputFile, previewImgId) {
    const file = inputFile.files[0];
    if (!file) return;
    const url = URL.createObjectURL(file);
    document.getElementById(previewImgId).src = url;
}

</script>

@endsection
