@extends('Layouts.app')

@section('titulo', 'Detalles del Diagnóstico del Equipo')

@section('contenido')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<style>
    /* Estilos mejorados con enfoque responsive. */
    :root {
        --primary-color: #4361ee;   /* Color principal.*/
        --secondary-color: #3f37c9;  /* Color secundario.*/
        --accent-color: #4cc9f0;     /* Color de acento.*/
        --light-bg: #f8f9fa;         /* Color de fondo claro.*/
        --dark-text: #2b2d42;        /* Color de texto oscuro.*/
        --light-text: #8d99ae;       /* Color de texto claro.*/
        --success-color: #4caf50;    /* Color de éxito.*/
        --warning-color: #ff9800;    /* Color de advertencia.*/
        --danger-color: #f44336;     /* Color de peligro.*/
        --border-radius: 8px;        /* Radio de la esquina.*/
        --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra.*/
        --transition: all 0.3s ease;  /* Transición.*/
    }
     /* Fin de los estilos. */
    .card-detail {
        border: none;   /* Borde.*/
        border-radius: var(--border-radius); /* Radio de la esquina.*/
        box-shadow: var(--box-shadow); /* Sombra.*/
        overflow: hidden; /* Desbordamiento.*/
        background: white; /* Fondo.*/
        transition: var(--transition); /* Transición.*/
        margin-bottom: 2rem;
    }
    /* Fin de los estilos. */
    .card-header-custom {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); /* Gradiente.*/
        color: white; /* Color del texto.*/
        padding: 1.25rem; /* Margen interno.*/
        border-bottom: none; /* Borde inferior.*/
    }
    /* Fin de los estilos. */
    .card-title {
        font-weight: 700;           /* Peso de la fuente.*/
        font-size: 1.25rem;         /* Tamaño de la fuente.*/
        margin-bottom: 0.25rem;     /* Margen inferior.*/
    }
    /* Fin de los estilos. */
    .card-subtitle {
        color: rgba(255, 255, 255, 0.8); /* Color del texto.*/
        font-size: 0.85rem; /* Tamaño de la fuente.*/
    }
    /* Fin de los estilos. */
    .btn-back {
        background-color: white;
        color: var(--primary-color); /* Color del texto.*/  
        border: none;
        border-radius: 50px; /* Radio de la esquina.*/
        padding: 0.4rem 1rem; /* Margen interno.*/
        font-weight: 500; /* Peso de la fuente.*/
        transition:rgb(96, 142, 249); /* Transición.*/
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra.*/
        font-size: 0.85rem; /* Tamaño de la fuente.*/
    }
    /* Fin de los estilos. */
    .detail-container {
        padding: 1.5rem;    /* Margen interno.*/
    }
    /* Fin de los estilos. */
    .detail-header {
        display: flex; /* Flexbox.*/
        flex-direction: column; /* Flexbox.*/
        gap: 0.75rem; /* Margen interno.*/
        margin-bottom: 1.25rem; /* Margen inferior.*/
        padding-bottom: 1rem; /* Margen interno.*/
        border-bottom: 1px solid #eee; /* Borde inferior.*/
    }
    /* Fin de los estilos. */
    .detail-date, .detail-correlative {
        font-size: 0.85rem; /* Tamaño de la fuente.*/
    }
    /* Fin de los estilos. */
    .detail-correlative {
        background-color: var(--accent-color); /* Color de fondo.*/
        color: white; /* Color del texto.*/
        padding: 0.2rem 0.6rem; /* Margen interno.*/
        border-radius: 50px; /* Radio de la esquina.*/
        font-weight: 600; /* Peso de la fuente.*/
        align-self: flex-start; /* Alineacion.*/
    }
    /* Fin de los estilos. */
    .detail-grid {
        display: grid; /* Grid.*/
        grid-template-columns: 1fr; /* Grid.*/
        gap: 1rem; /* Margen interno.*/
        margin-bottom: 1.5rem; /* Margen inferior.*/
    }
    /* Fin de los estilos. */
    .detail-item {
        padding: 0.85rem; /* Margen interno.*/
        background-color: var(--light-bg); /* Color de fondo.*/
        border-radius: var(--border-radius); /* Radio de la esquina.*/
    }
    /* Fin de los estilos. */
    .detail-label {
        font-weight: 600;   /* Peso de la fuente.*/
        color: var(--primary-color); /* Color del texto.*/
        font-size: 0.75rem; /* Tamaño de la fuente.*/
        text-transform: uppercase; /* Transformacion.*/
        letter-spacing: 0.5px; /* Espacio entre letras.*/
        margin-bottom: 0.2rem; /* Margen inferior.*/
    }
    /* Fin de los estilos. */
    .detail-value {
        color: var(--dark-text); /* Color del texto.*/
        font-size: 0.9rem; /* Tamaño de la fuente.*/
    }
    /* Fin de los estilos. */
    .section-title {
        color: var(--dark-text); /* Color del texto.*/
        font-weight: 600; /* Peso de la fuente.*/
        margin: 1.5rem 0 1rem; /* Margen interno.*/
        padding-bottom: 0.5rem; /* Margen inferior.*/
        border-bottom: 2px solid var(--light-bg); /* Borde inferior.*/
        font-size: 1.1rem; /* Tamaño de la fuente.*/
    }
    /* Fin de los estilos. */
    .photo-grid {
        display: grid; /* Grid.*/
        grid-template-columns: 1fr; /* Grid.*/
        gap: 1.5rem; /* Margen interno.*/
        margin-top: 1rem; /* Margen superior.*/
    }
    /* Fin de los estilos. */
    .photo-card {
        background-color: white; /* Color de fondo.*/
        border-radius: var(--border-radius); /* Radio de la esquina.*/
        overflow: hidden; /* Desbordamiento.*/
        box-shadow: var(--box-shadow); /* Sombra.*/
    }
    /* Fin de los estilos. */
    .photo-header {
        background-color: var(--light-bg); /* Color de fondo.*/
        padding: 0.6rem 0.85rem; /* Margen interno.*/
        border-bottom: 1px solid #eee; /* Borde inferior.*/
        font-weight: 600; /* Peso de la fuente.*/
        font-size: 0.9rem; /* Tamaño de la fuente.*/
    }
    /* Fin de los estilos. */
    .photo-body {
        padding: 0.85rem; /* Margen interno.*/
    }
    /* Fin de los estilos. */
    .photo-img {
        width: 100%; /* Ancho maximo.*/
        height: auto; /* Altura maxima.*/
        max-height: 250px; /* Altura maxima.*/
        object-fit: contain; /* Contenido.*/
        border-radius: 4px; /* Radio de la esquina.*/
        background-color: #f9f9f9; /* Color de fondo.*/
        cursor: pointer;
    }
    /* Fin de los estilos. */
    .no-photo {
        height: 150px; /* Altura maxima.*/
        display: flex; /* Flexbox.*/
        flex-direction: column; /* Flexbox.*/
        align-items: center; /* Alineacion.*/
        justify-content: center; /* Alineacion.*/
        background-color: var(--light-bg); /* Color de fondo.*/
        color: var(--light-text);
        border-radius: 4px;
        font-style: italic;
        font-size: 0.85rem;
    }
    /* Fin de los estilos. */
    .action-buttons {
        margin-top: 2rem; /* Margen superior.*/
        display: grid; /* Grid.*/
        grid-template-columns: 1fr 1fr; /* Grid.*/
        gap: 0.75rem; /* Margen interno.*/
    }
    /* Fin de los estilos. */
    .btn-action {
        border-radius: 50px; /* Radio de la esquina.*/
        padding: 0.5rem; /* Margen interno.*/
        font-weight: 500; /* Peso de la fuente.*/
        font-size: 0.8rem; /* Tamaño de la fuente.*/
        display: inline-flex; /* Flexbox.*/
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: none;
        text-align: center;
    }
    /* Fin de los estilos. */
    .btn-action i {
        margin-right: 0.3rem;
        font-size: 0.9rem;
    }
    
    /* Lightbox */
    .lightbox {
        display: none;
        position: fixed;
        z-index: 9999; /* Z-index.*/
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.95); /* Color de fondo.*/
        align-items: center;
        justify-content: center;
    }
    
    .lightbox.show {
        display: flex;
    }
    /* Fin de los estilos. */
    .lightbox-content {
        width: 90%; /* Ancho maximo.*/
        max-width: 800px; /* Ancho maximo.*/
        text-align: center; /* Alineacion.*/
    }
    
    .lightbox-img {
        max-width: 100%; /* Ancho maximo.*/
        max-height: 80vh; /* Altura maxima.*/
        border-radius: 5px; /* Radio de la esquina.*/
    }
    
    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 20px;    /* Margen interno.*/
        color: white;   /* Color del texto.*/
        font-size: 30px; /* Tamaño de la fuente.*/
        cursor: pointer; /* Cursor.*/
    }
    
    /* Modal */
    .modal-content {
        border: none;   /* Borde.*/
        border-radius: var(--border-radius); /* Radio de la esquina.*/
    }
    
    .modal-header {
        background-color: var(--primary-color); /* Color de fondo.*/
        color: white; /* Color del texto.*/
        border-bottom: none; /* Borde inferior.*/
        padding: 1rem; /* Margen interno.*/
    }
    
    .modal-title {
        font-weight: 600; /* Peso de la fuente.*/
        font-size: 1.1rem; /* Tamaño de la fuente.*/
    }
    
    .modal-body {
        padding: 1.5rem; /* Margen interno.*/
    }
    
    /* Canvas */
    #firmaCanvas {
        width: 100%; /* Ancho maximo.*/
        height: 150px; /* Altura maxima.*/
        border: 1px solid #ddd; /* Borde.*/
        border-radius: var(--border-radius); /* Radio de la esquina.*/
        background-color: white; /* Color de fondo.*/
    }
    
    /* Media queries para tablets.   */
    @media (min-width: 576px) {
        .card-title {
            font-size: 1.5rem;
        }
        
        .detail-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .photo-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .action-buttons {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    /* Media queries para escritorio. */
    @media (min-width: 992px) {
        .card-header-custom {
            padding: 1.5rem;
        }
        
        .detail-header {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
        
        .detail-grid {
            grid-template-columns: repeat(3, 1fr);
        }
        
        .action-buttons {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            justify-content: flex-end;
        }
        
        .btn-action {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }
    }
    
    /* Ajustes para pantallas muy pequeñas. */
    @media (max-width: 400px) {
        .action-buttons {
            grid-template-columns: 1fr;
        }
        
        .btn-back {
            margin-top: 0.5rem;
            width: 100%;
        }
    }
</style>

<!-- Comienza la vista del Show. -->
<div class="container mt-3 mb-4">
    <div class="card card-detail">
        <!-- Encabezado. -->
        <div class="card-header card-header-custom">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    <h3 class="card-title mb-1">
                        <i class="fas fa-clipboard-check me-2"></i>Detalles del Diagnóstico
                    </h3>
                    <p class="card-subtitle mb-2 mb-md-0">Información técnica completa del equipo</p>
                </div>
                <a href="{{ route('registrodiagnostico.index') }}" class="btn btn-back mt-2 mt-md-0">
                    <i class="fas fa-arrow-left me-2"></i> Volver
                </a>
            </div>
        </div>
        
        <!-- Contenido principal. -->
        <div class="detail-container">
            <!-- Encabezado de detalles. -->
            <div class="detail-header">
                <span class="detail-date">
                    <i class="far fa-calendar-alt me-1"></i> 
                    <strong>Fecha:</strong> {{ $registro->created_at->format('d/m/Y H:i') }}
                </span>
                <span class="detail-correlative">
                    <i class="fas me-1"></i> Correlativo: {{ $correlativo }}
                </span>
            </div>
            
            <!-- Campos del dispositivo -->
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Empresa</span>
                    <span class="detail-value">
                        {{ $registro->empresa ? $registro->empresa->empresa : 'Sin empresa' }}
                    </span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Equipo</span>
                    <span class="detail-value">{{ $registro->equipo }}</span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Marca</span>
                    <span class="detail-value">{{ $registro->marca }}</span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Modelo</span>
                    <span class="detail-value">{{ $registro->modelo }}</span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Número de Serie</span>
                    <span class="detail-value">{{ $registro->serie }}</span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Descripción</span>
                    <span class="detail-value">{{ $registro->descripcion }}</span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Estado</span>
                    <span class="detail-value">{{ $registro->estado }}</span>
                </div>
            </div>
            
            <!-- Imagen inicial. -->
<div class="photo-card">
    <div class="photo-header">
        <i class="fas fa-camera me-2"></i>Imagen Inicial
    </div>
    <div class="photo-body">
        @if($registro->foto_antes)
            <img src="{{ asset('img/post/' . $registro->foto_antes) }}" 
                 alt="Foto Antes" 
                 class="photo-img"
                 onclick="mostrarLightbox(this, 'Imagen Inicial del Equipo')">
        @elseif($registro->foto_antes_camara)
            <img src="{{ asset('img/post/' . $registro->foto_antes_camara) }}" 
                 alt="Foto Antes (Cámara)" 
                 class="photo-img"
                 onclick="mostrarLightbox(this, 'Imagen Inicial del Equipo')">
        @else
            <div class="no-photo">
                <i class="far fa-image mb-1"></i>
                <p>No hay imagen inicial</p>
            </div>
        @endif
    </div>
</div>

<!-- Imagen final. -->
<div class="photo-card">
    <div class="photo-header">
        <i class="fas fa-camera-retro me-2"></i>Imagen Final
    </div>
    <div class="photo-body">
        @if($registro->foto_despues)
            <img src="{{ asset('img/post/' . $registro->foto_despues) }}" 
                 alt="Foto Después" 
                 class="photo-img"
                 onclick="mostrarLightbox(this, 'Imagen Final del Equipo')">
        @elseif($registro->foto_despues_camara)
            <img src="{{ asset('img/post/' . $registro->foto_despues_camara) }}" 
                 alt="Foto Después (Cámara)" 
                 class="photo-img"
                 onclick="mostrarLightbox(this, 'Imagen Final del Equipo')">
        @else
            <div class="no-photo">
                <i class="far fa-image mb-1"></i>
                <p>No hay imagen final</p>
            </div>
        @endif
    </div>
</div>

            
            <!-- Botones de acción. -->
            <div class="action-buttons">
                @if(Auth::user()->role !== 'Visualizador')
                <button onclick="abrirModalFirma('realizado')" class="btn btn-primary btn-action">
                    <i class="fas fa-check-circle me-1"></i>Firmar Realizado
                </button>
                
                <button onclick="abrirModalFirma('supervisado')" class="btn btn-warning btn-action">
                    <i class="fas fa-user-shield me-1"></i>Firmar Supervisado
                </button>
                
                <button onclick="abrirModalFirma('recibido')" class="btn btn-success btn-action">
                    <i class="fas fa-user-check me-1"></i>Firmar Recibido
                </button>
                @endif
                
                <a href="{{ route('registro_diagnostico.pdf', $registro->id) }}" target="_blank" class="btn btn-primary btn-action">
                    <i class="fas fa-file-pdf me-1"></i>Vista previa PDF
                </a>
                
                <a href="{{ route('diagnostico.descargar', $registro->id) }}" class="btn btn-info btn-action" target="_blank">
                    <i class="fas fa-download me-1"></i>Descargar PDF
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear la firma -->
<div class="modal fade" id="firmaModal" tabindex="-1" aria-labelledby="firmaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Firma</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-3">Por favor, dibuje su firma en el área inferior:</p>
        <canvas id="firmaCanvas"></canvas>
        <div class="mt-3">
            <button class="btn btn-sm btn-secondary" id="limpiarFirma">
                <i class="fas fa-eraser me-1"></i>Limpiar
            </button>
        </div>
<!-- Boton para guardar la firma. -->
        <form id="firmaForm" method="POST" action="{{ route('guardar.firma', $registro->id) }}">
            @csrf
            <input type="hidden" name="tipo_firma" id="tipoFirmaInput">
            <input type="hidden" name="firma" id="firmaInput">
            <button type="submit" class="btn btn-success mt-3">
                <i class="fas fa-save me-1"></i>Guardar Firma
            </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Lightbox para imágenes. -->
<div id="lightbox" class="lightbox">
    <span class="lightbox-close">&times;</span>
    <div class="lightbox-content">
        <img id="lightbox-img" class="lightbox-img" src="">
        <div id="lightbox-caption" class="lightbox-caption"></div>
    </div>
</div>

<script>
    // Inicialización del pad de firma.
    const canvas = document.getElementById('firmaCanvas');
    const signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)',
        penColor: 'rgb(0, 0, 0)'
    });
 // Redimensionar el canvas.
    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.clear();
    }
    
    window.addEventListener('resize', resizeCanvas);
    
    // Limpiar firma.
    document.getElementById('limpiarFirma').addEventListener('click', function () {
        signaturePad.clear();
    });

    // Validar formulario de firma.
    document.getElementById('firmaForm').addEventListener('submit', function (e) {
        if (signaturePad.isEmpty()) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Firma requerida',
                text: 'Por favor dibuja tu firma antes de guardar',
                confirmButtonColor: 'var(--primary-color)'
            });
            return;
        }
 // Obtener la firma.
        const firmaData = signaturePad.toDataURL();
        document.getElementById('firmaInput').value = firmaData;
    });

    // Abrir modal de firma
    function abrirModalFirma(tipo) {
        signaturePad.clear();
        document.getElementById('tipoFirmaInput').value = tipo;
        const modal = new bootstrap.Modal(document.getElementById('firmaModal'));
        modal.show();
        
        // Ajustar canvas después de que el modal se muestra.
        setTimeout(resizeCanvas, 300);
    }

    // Lightbox para imágenes
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const closeBtn = document.querySelector('.lightbox-close');
     // Mostrar lightbox.
    function mostrarLightbox(imgElement, caption) {
        lightboxImg.src = imgElement.src;
        lightboxCaption.textContent = caption;
        lightbox.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    // Cerrar lightbox.
    function cerrarLightbox() {
        lightbox.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
    
    closeBtn.addEventListener('click', cerrarLightbox); // Cerrar lightbox.
    
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            cerrarLightbox();
        }
    });
    // Cerrar lightbox con tecla escape.
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && lightbox.classList.contains('show')) {
            cerrarLightbox();
        }
    });
</script>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session('success') }}',
            confirmButtonColor: 'var(--primary-color)'
        });
    </script>
@endif

@endsection