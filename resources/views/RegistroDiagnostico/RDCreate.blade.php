@extends('layouts.app')  
@section('titulo','Registrar Diagnóstico de Equipo')  
@section('contenido')
@include('sweetalert::alert')

<style>
    /* Estilos base */
    :root {
        --primary-color: #3498db;
        --secondary-color: #2ecc71;
        --dark-color: #2c3e50;
        --light-color: #f8f9fa;
        --border-color: #dfe6e9;
        --error-color: #e74c3c;
    }
    
    body {
        background-color: #f5f7fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* Tarjeta principal */
    .diagnostic-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        margin: 1.5rem auto;
        border: none;
        max-width: 1200px;
    }
    
    /* Título del formulario */
    .form-title {
        color: var(--dark-color);
        font-weight: 700;
        font-size: 1.8rem;
        position: relative;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    
    .form-title:after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        margin: 0.5rem auto 0;
        border-radius: 3px;
    }
    
    /* Etiquetas de formulario */
    .form-label {
        font-weight: 600;
        color: #34495e;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    
    /* Campos de formulario */
    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }
    
    /* Contenedor de subida de imagen */
    .image-upload-container {
        border: 2px dashed #bdc3c7;
        border-radius: 10px;
        padding: 1.5rem;
        text-align: center;
        background-color: var(--light-color);
        transition: all 0.3s;
        margin-bottom: 1.5rem;
    }
    
    .image-upload-container:hover {
        border-color: var(--primary-color);
        background-color: #f1f9ff;
    }
    
    /* Vista previa de imagen */
    .img-preview {
        max-width: 100%;
        max-height: 250px;
        margin: 1rem auto 0;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        display: none;
        cursor: zoom-in;
        object-fit: contain;
    }
    
    /* Badge de correlativo */
    .correlative-badge {
        background-color: #e3f2fd;
        color: #1976d2;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }
    
    /* Botones principales compactos */
.btn-primary-custom, .btn-secondary-custom {
    padding: 0.5rem 1.25rem;       /* Más compacto que el original (0.75rem 1.75rem) */
    font-size: 0.875rem;           /* Tamaño de fuente ligeramente más pequeño (14px) */
    border-radius: 6px;             /* Bordes un poco menos redondeados */
    border: none;
    font-weight: 600;
    letter-spacing: 0.3px;          /* Menor espaciado entre letras */
    transition: all 0.25s;          /* Transición un poco más rápida */
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-primary-custom {
    background: rgb(71, 154, 255);
    color: white;
}

.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(52, 152, 219, 0.3); /* Sombra más sutil */
    color: white;                                   /* Mantiene el color blanco (cambié tu versión) */
    background: rgb(60, 140, 235);                  /* Color un poco más oscuro al hover */
}

.btn-secondary-custom {
    background-color: #95a5a6;
    color: white;
}

.btn-secondary-custom:hover {
    background-color: #7f8c8d;
    transform: translateY(-2px);
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);         /* Sombra más ligera */
    color: white;
}
    
    /* Lightbox para imagen */
    #lightbox {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        justify-content: center;
        align-items: center;
        z-index: 1050;
    }
    
    #lightbox.show {
        display: flex;
    }
    
    #lightbox img {
        max-width: 95%;
        max-height: 95%;
        border-radius: 8px;
        object-fit: contain;
    }
    
    /* Mensajes de error */
    .invalid-feedback {
        font-size: 0.85rem;
        color: var(--error-color);
    }
    
    /* ========== MEDIA QUERIES ========== */
    
    /* Tabletas (768px - 992px) */
    @media (max-width: 991.98px) {
        .diagnostic-card {
            padding: 1.75rem;
        }
        
        .form-title {
            font-size: 1.6rem;
        }
        
        .btn-primary-custom, .btn-secondary-custom {
            padding: 0.65rem 1.5rem;
        }
    }
    
    /* Teléfonos grandes (576px - 767px) */
    @media (max-width: 767.98px) {
        .diagnostic-card {
            padding: 1.5rem;
            margin: 1rem auto;
            border-radius: 10px;
        }
        
        .form-title {
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }
        
        .form-title:after {
            width: 60px;
            height: 3px;
        }
        
        .row {
            margin-bottom: 0.5rem !important;
        }
        
        .col-md-6 {
            margin-bottom: 1rem;
        }
        
        .image-upload-container {
            padding: 1.25rem;
        }
        
        .btn-primary-custom, .btn-secondary-custom {
            width: 100%;
            margin-bottom: 0.5rem;
        }
        
        .d-flex.justify-content-between {
            flex-direction: column;
        }
    }
    
    /* Teléfonos pequeños (hasta 575px) */
    @media (max-width: 575.98px) {
        .diagnostic-card {
            padding: 1.25rem;
            border-radius: 8px;
        }
        
        .form-title {
            font-size: 1.4rem;
            padding-bottom: 0.75rem;
        }
        
        .form-control, .form-select, .btn {
            padding: 0.65rem 0.9rem;
            font-size: 0.9rem;
        }
        
        .form-label {
            font-size: 0.9rem;
        }
        
        textarea.form-control {
            min-height: 120px;
        }
        
        .image-upload-container {
            padding: 1rem;
        }
        
        .correlative-badge {
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
        }
        
        .d-flex.gap-2 {
            flex-direction: column;
            gap: 0.5rem !important;
        }
        
        .btn-outline-primary, .btn-primary {
            width: 100%;
        }
    }
    
    /* Efectos hover para dispositivos con hover */
    @media (hover: hover) {
        .form-group:hover .form-label {
            color: var(--primary-color);
        }
        
        .btn-primary-custom:hover, .btn-secondary-custom:hover {
            transform: translateY(-2px);
        }
    }
</style>

<div class="container">
    <div class="diagnostic-card">
        <form method="POST" action="{{ route('registrodiagnostico.store') }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Encabezado -->
            <h1 class="form-title">Informe de Diagnóstico Técnico</h1>
            
            <div class="text-end">
                <span class="correlative-badge">
                    <i class="fas me-1"></i>Correlativo: {{ $correlativo }}
                </span>
            </div>
            
            <!-- Fecha -->
            <div class="mb-4">
                <label for="fecha" class="form-label">Fecha del Diagnóstico</label>
                <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}">
            </div>
            
            <!-- Primera fila de campos -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="empresa_id" class="form-label">Empresa</label>
                    <select id="empresa_id" name="empresa_id" class="form-select @error('empresa_id') is-invalid @enderror">
                        <option value="">Seleccione una empresa</option>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}" {{ old('empresa_id') == $empresa->id ? 'selected' : '' }}>
                                {{ $empresa->empresa }}
                            </option>
                        @endforeach
                    </select>
                    @error('empresa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="equipo" class="form-label">Hardware/Equipo</label>
                    <input type="text" id="equipo" name="equipo" class="form-control @error('equipo') is-invalid @enderror" 
                           value="{{ old('equipo') }}" placeholder="Ej. Laptop, Impresora, Servidor">
                    @error('equipo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <!-- Segunda fila de campos -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" id="modelo" name="modelo" class="form-control @error('modelo') is-invalid @enderror" 
                           value="{{ old('modelo') }}" placeholder="Ej. ThinkPad X1 Carbon">
                    @error('modelo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="marca" class="form-label">Marca</label>
                    <input type="text" id="marca" name="marca" class="form-control @error('marca') is-invalid @enderror" 
                           value="{{ old('marca') }}" placeholder="Ej. Lenovo, HP, Dell">
                    @error('marca')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <!-- Tercera fila de campos -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="serie" class="form-label">Número de Serie</label>
                    <input type="text" id="serie" name="serie" class="form-control @error('serie') is-invalid @enderror" 
                           value="{{ old('serie') }}" placeholder="Ej. PF12345678">
                    @error('serie')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="estado" class="form-label">Estado del Equipo</label>
                    <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
                        <option value="">Seleccione el estado</option>
                        <option value="Mal estado" {{ old('estado') == 'Mal estado' ? 'selected' : '' }}>Mal estado</option>
                        <option value="Regular" {{ old('estado') == 'Regular' ? 'selected' : '' }}>Regular</option>
                        <option value="Buen estado" {{ old('estado') == 'Buen estado' ? 'selected' : '' }}>Buen estado</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <!-- Descripción -->
            <div class="mb-4">
                <label for="descripcion" class="form-label">Descripción del Diagnóstico</label>
                <textarea id="descripcion" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" 
                          rows="5" placeholder="Describa en detalle el diagnóstico técnico...">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Imagen -->
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
                            <label for="foto_antes_camera" class="btn btn-primary flex-grow-1 flex-md-grow-0">
                                <i class="fas fa-camera me-2"></i>Tomar Foto
                                <input type="file" name="foto_antes_camera" id="foto_antes_camera" 
                                       accept="image/*" capture="environment" class="d-none" 
                                       onchange="previewImage(this, 'previewAntes')">
                            </label>
                        </div>
                        
                        @error('foto_antes')
                            <div class="text-danger mt-2 small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Vista previa de la imagen -->
                    <img id="previewAntes" class="img-preview mt-3" onclick="openLightbox(this.src)">
                </div>
            </div>
            
            <!-- Botones de acción -->
            <div class="d-flex justify-content-between mt-4 pt-3 border-top flex-column flex-md-row gap-2">
                <a href="{{ route('registrodiagnostico.index') }}" class="btn btn-secondary-custom order-md-1 order-2">
                    <i class="fas fa-arrow-left me-2"></i>Regresar
                </a>
                
                <button type="submit" class="btn btn-primary-custom order-md-2 order-1 mb-md-0 mb-2">
                    <i class="fas fa-save me-2"></i>Guardar Diagnóstico
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Lightbox para ampliar imagen -->
<div id="lightbox" onclick="this.classList.remove('show')">
    <img src="" alt="Imagen ampliada">
</div>

<script>
    /* Función para cargar la imagen */
    function previewImage(input, previewId) {
        const file = input.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const img = document.getElementById(previewId);
            img.src = e.target.result;
            img.style.display = 'block';
        };
        
        if (file) {
            reader.readAsDataURL(file);
        }
    }
    
    /* Función para visualizar imagen en lightbox */
    function openLightbox(src) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = lightbox.querySelector('img');
        lightboxImg.src = src;
        lightbox.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    /* Cerrar lightbox con tecla ESC */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('lightbox').classList.remove('show');
            document.body.style.overflow = 'auto';
        }
    });
</script>
@endsection