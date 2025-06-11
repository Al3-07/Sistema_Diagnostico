@extends('Layouts.app')

@section('titulo', 'Detalles del Diagnóstico del Equipo')

@section('contenido')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<style>
    /* Estilos mejorados con enfoque responsive */
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4cc9f0;
        --light-bg: #f8f9fa;
        --dark-text: #2b2d42;
        --light-text: #8d99ae;
        --success-color: #4caf50;
        --warning-color: #ff9800;
        --danger-color: #f44336;
        --border-radius: 8px;
        --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }
    
    .card-detail {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
        background: white;
        transition: var(--transition);
        margin-bottom: 2rem;
    }
    
    .card-header-custom {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1.25rem;
        border-bottom: none;
    }
    
    .card-title {
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 0.25rem;
    }
    
    .card-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.85rem;
    }
    
    .btn-back {
        background-color: white;
        color: var(--primary-color);
        border: none;
        border-radius: 50px;
        padding: 0.4rem 1rem;
        font-weight: 500;
        transition:rgb(96, 142, 249);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-size: 0.85rem;
    }
    
    .detail-container {
        padding: 1.5rem;
    }
    
    .detail-header {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }
    
    .detail-date, .detail-correlative {
        font-size: 0.85rem;
    }
    
    .detail-correlative {
        background-color: var(--accent-color);
        color: white;
        padding: 0.2rem 0.6rem;
        border-radius: 50px;
        font-weight: 600;
        align-self: flex-start;
    }
    
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .detail-item {
        padding: 0.85rem;
        background-color: var(--light-bg);
        border-radius: var(--border-radius);
    }
    
    .detail-label {
        font-weight: 600;
        color: var(--primary-color);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.2rem;
    }
    
    .detail-value {
        color: var(--dark-text);
        font-size: 0.9rem;
    }
    
    .section-title {
        color: var(--dark-text);
        font-weight: 600;
        margin: 1.5rem 0 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--light-bg);
        font-size: 1.1rem;
    }
    
    .photo-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin-top: 1rem;
    }
    
    .photo-card {
        background-color: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--box-shadow);
    }
    
    .photo-header {
        background-color: var(--light-bg);
        padding: 0.6rem 0.85rem;
        border-bottom: 1px solid #eee;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .photo-body {
        padding: 0.85rem;
    }
    
    .photo-img {
        width: 100%;
        height: auto;
        max-height: 250px;
        object-fit: contain;
        border-radius: 4px;
        background-color: #f9f9f9;
        cursor: pointer;
    }
    
    .no-photo {
        height: 150px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: var(--light-bg);
        color: var(--light-text);
        border-radius: 4px;
        font-style: italic;
        font-size: 0.85rem;
    }
    
    .action-buttons {
        margin-top: 2rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
    }
    
    .btn-action {
        border-radius: 50px;
        padding: 0.5rem;
        font-weight: 500;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: none;
        text-align: center;
    }
    
    .btn-action i {
        margin-right: 0.3rem;
        font-size: 0.9rem;
    }
    
    /* Lightbox */
    .lightbox {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.95);
        align-items: center;
        justify-content: center;
    }
    
    .lightbox.show {
        display: flex;
    }
    
    .lightbox-content {
        width: 90%;
        max-width: 800px;
        text-align: center;
    }
    
    .lightbox-img {
        max-width: 100%;
        max-height: 80vh;
        border-radius: 5px;
    }
    
    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 20px;
        color: white;
        font-size: 30px;
        cursor: pointer;
    }
    
    /* Modal */
    .modal-content {
        border: none;
        border-radius: var(--border-radius);
    }
    
    .modal-header {
        background-color: var(--primary-color);
        color: white;
        border-bottom: none;
        padding: 1rem;
    }
    
    .modal-title {
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    #firmaCanvas {
        width: 100%;
        height: 150px;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
        background-color: white;
    }
    
    /* Media queries para tablets */
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
    
    /* Media queries para escritorio */
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
    
    /* Ajustes para pantallas muy pequeñas */
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
        <!-- Encabezado -->
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
        
        <!-- Contenido principal -->
        <div class="detail-container">
            <!-- Encabezado de detalles -->
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
            
            <!-- Sección de imágenes -->
            <h5 class="section-title">
                <i class="fas fa-images me-2"></i>Imágenes del Equipo
            </h5>
            
            <div class="photo-grid">
                <!-- Imagen inicial -->
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
                        @else
                            <div class="no-photo">
                                <i class="far fa-image mb-1"></i>
                                <p>No hay imagen inicial</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Imagen final -->
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
                        @else
                            <div class="no-photo">
                                <i class="far fa-image mb-1"></i>
                                <p>No hay imagen final</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Botones de acción -->
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

<!-- Lightbox para imágenes -->
<div id="lightbox" class="lightbox">
    <span class="lightbox-close">&times;</span>
    <div class="lightbox-content">
        <img id="lightbox-img" class="lightbox-img" src="">
        <div id="lightbox-caption" class="lightbox-caption"></div>
    </div>
</div>

<script>
    // Inicialización del pad de firma
    const canvas = document.getElementById('firmaCanvas');
    const signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)',
        penColor: 'rgb(0, 0, 0)'
    });

    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.clear();
    }
    
    window.addEventListener('resize', resizeCanvas);
    
    // Limpiar firma
    document.getElementById('limpiarFirma').addEventListener('click', function () {
        signaturePad.clear();
    });

    // Validar formulario de firma
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

        const firmaData = signaturePad.toDataURL();
        document.getElementById('firmaInput').value = firmaData;
    });

    // Abrir modal de firma
    function abrirModalFirma(tipo) {
        signaturePad.clear();
        document.getElementById('tipoFirmaInput').value = tipo;
        const modal = new bootstrap.Modal(document.getElementById('firmaModal'));
        modal.show();
        
        // Ajustar canvas después de que el modal se muestra
        setTimeout(resizeCanvas, 300);
    }

    // Lightbox para imágenes
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const closeBtn = document.querySelector('.lightbox-close');
    
    function mostrarLightbox(imgElement, caption) {
        lightboxImg.src = imgElement.src;
        lightboxCaption.textContent = caption;
        lightbox.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    function cerrarLightbox() {
        lightbox.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
    
    closeBtn.addEventListener('click', cerrarLightbox);
    
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            cerrarLightbox();
        }
    });
    
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