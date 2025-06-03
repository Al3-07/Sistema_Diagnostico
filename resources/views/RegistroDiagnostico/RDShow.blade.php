@extends('Layouts.app')

@section('titulo', 'Detalles del Diagnóstico del Equipo')

@section('contenido')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<style>  /* Estilos para la vista, titulos, texto, botones. */
    .card-detail {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .card-header-custom {
        background-color: #f8f9fa;
        border-bottom: 1px solid #eaeaea;
        padding: 1.25rem 1.5rem;
    }
    
    .card-title {
        color: #2c3e50;
        font-weight: 600;
    }
    
    .btn-back {
        background-color: #f1f5f9;
        color: #2c3e50;
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        background-color: #e2e8f0;
        transform: translateX(-3px);
    }
    
    .detail-container {
        padding: 1.5rem;
        background-color: white;
    }
    
    .detail-item {
        margin-bottom: 0.8rem;
        padding-bottom: 0.8rem;
        border-bottom: 1px solid #f1f1f1;
    }
    
    .detail-item:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        font-weight: 600;
        color: #344767;
        display: inline-block;
        min-width: 120px;
    }
    
    .detail-value {
        color: #4a5568;
    }
    
    .photo-section {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f1f1f1;
    }
    
    .photo-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-top: 1rem;
    }
    
    .photo-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
    }
    
    .photo-title {
        font-weight: 600;
        color: #344767;
        margin-bottom: 0.75rem;
    }
    
    .photo-img {
        width: 100%;
        max-height: 250px;
        object-fit: contain;
        border-radius: 6px;
        background-color: white;
        padding: 0.5rem;
        border: 1px solid #eaeaea;
    }
    
    .no-photo {
        background-color: #f1f3f5;
        border-radius: 6px;
        padding: 2rem;
        text-align: center;
        color: #7f8c8d;
        font-style: italic;
    }
    
    .action-buttons {
        margin-top: 2rem;
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    
    .btn-action {
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn-action i {
        margin-right: 0.5rem;
    }
    
    @media (max-width: 768px) {
        .photo-grid {
            grid-template-columns: 1fr;
        }
        
        .detail-label {
            display: block;
            margin-bottom: 0.25rem;
        }
    }


    /* Estilos para el lightbox. */
    .lightbox {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        align-items: center;
        justify-content: center;
    }
    
    .lightbox-content {
        max-width: 90%;
        max-height: 90%;
    }
    
    .lightbox-img {
        width: auto;
        height: auto;
        max-width: 100%;
        max-height: 80vh;
        border: 3px solid white;
        border-radius: 5px;
    }
    
    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 30px;
        color: white;
        font-size: 40px;
        cursor: pointer;
    }
    
    .lightbox-caption {
        color: white;
        text-align: center;
        margin-top: 15px;
        font-size: 1.2rem;
    }
</style>
        <!-- Comienza la vista del Show. -->
<div class="container mt-4">
    <div class="card card-detail">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <div>
                <!-- Titulo. -->
                <h3 class="mb-0 text-dark font-weight-bold">
                    <i class="fas fa-clipboard-check text-primary me-2"></i>Detalles del Diagnóstico
                </h3>
                <p class="mb-0 text-muted small">Información técnica completa del equipo</p>
            </div>
             <!-- Boton de Volver. -->
           <a href="{{ route('registrodiagnostico.index') }}" 
            class="btn btn-sm px-3 rounded-1 shadow-sm"
            style="background-color: #6c757d; color: white; border: none;">
            <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>
        
        <div class="detail-container">
            <h5 class="text-end mb-4" style="color: #00b894;">
                 <strong>Correlativo:</strong> {{ $correlativo }}
                </h5>
            <!-- Campos del dispositivo.  -->
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label text-uppercase text-muted small">Empresa:</span>
                        <span class="detail-value font-weight-medium">{{ $registro->empresa }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label text-uppercase text-muted small">Equipo:</span>
                        <span class="detail-value font-weight-medium">{{ $registro->equipo }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label text-uppercase text-muted small">Marca:</span>
                        <span class="detail-value font-weight-medium">{{ $registro->marca }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label text-uppercase text-muted small">Modelo:</span>
                        <span class="detail-value font-weight-medium">{{ $registro->modelo }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label text-uppercase text-muted small">Serie:</span>
                        <span class="detail-value font-weight-medium">{{ $registro->serie }}</span>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label text-uppercase text-muted small">Descripción:</span>
                        <span class="detail-value font-weight-medium">{{ $registro->descripcion }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label text-uppercase text-muted small">Estado:</span>
                        <span class="detail-value font-weight-medium">{{ $registro->estado }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Muestra de imágenes inicial y final. -->
            <div class="photo-section">
                <h5 class="photo-title">Imágenes del Equipo</h5>
                <div class="photo-grid">
                    <div class="photo-container">
                        <h6 class="photo-title">Imagen Inicial</h6>
                        @if($registro->foto_antes)
                            <img src="{{ asset('img/post/' . $registro->foto_antes) }}" 
                                alt="Foto Antes" 
                                class="photo-img"
                                onclick="mostrarLightbox(this, 'Imagen Inicial del Equipo')">
                        @else
                            <div class="no-photo">
                                <p>No hay foto antes disponible</p>
                            </div>
                        @endif
                    </div>
                    
                    <div class="photo-container">
                        <h6 class="photo-title">Imagen Final</h6>
                       @if($registro->foto_despues)
                    <img src="{{ asset('img/post/' . $registro->foto_despues) }}" 
                         alt="Foto Después" 
                         class="photo-img"
                         onclick="mostrarLightbox(this, 'Imagen Final del Equipo - {{ $registro->equipo }}')">
                @else
                    <div class="no-photo">
                        <p>No hay foto después disponible</p>
                    </div>
                @endif
                    </div>
                </div>
            </div>
            
            <!-- Apartado de las Firmas. -->
            <div class="action-buttons">
                <button onclick="abrirModalFirma('realizado')" class="btn btn-primary btn-action">
                    <i class="fas fa-check-circle"></i>Firmar Realizado
                </button>
                
                <button onclick="abrirModalFirma('supervisado')" class="btn btn-warning btn-action">
                    <i class="fas fa-user-shield"></i>Firmar Supervisado
                </button>
                
                <button onclick="abrirModalFirma('recibido')" class="btn btn-success btn-action">
                    <i class="fas fa-user-check"></i>Firmar Recibido
                </button>
                
                <!-- Boton de PDF. -->
                <a href="{{ route('diagnostico.descargar', $registro->id) }}" class="btn btn-info btn-action" target="_blank">
                    <i class="fas fa-file-pdf"></i>Descargar PDF
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Mensaje de confirmación. -->
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session('success') }}'
        });
    </script>
@endif

<!-- Modal para crear la firma. -->
<div class="modal fade" id="firmaModal" tabindex="-1" aria-labelledby="firmaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="firmaModalLabel">Firmar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <canvas id="firmaCanvas" width="500" height="200" style="border:1px solid #ccc;"></canvas>
        <div class="mt-3">
            <button class="btn btn-sm btn-secondary" id="limpiarFirma">Limpiar</button>
        </div>

        <!-- Boton para guardar la firma. -->
        <form id="firmaForm" method="POST" action="{{ route('guardar.firma', $registro->id) }}">
            @csrf
            <input type="hidden" name="tipo_firma" id="tipoFirmaInput">
            <input type="hidden" name="firma" id="firmaInput">
            <button type="submit" class="btn btn-success mt-3">Guardar Firma</button>
        </form>

       
            <!-- Mensaje de error. -->
        @if(session('error'))
         <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif
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
    // CÓDIGO JAVASCRIPT DE FIRMAS. 
    const canvas = document.getElementById('firmaCanvas');
    const signaturePad = new SignaturePad(canvas);

    document.getElementById('limpiarFirma').addEventListener('click', function () {
        signaturePad.clear();
    });

    document.getElementById('firmaForm').addEventListener('submit', function (e) {
        if (signaturePad.isEmpty()) {
            e.preventDefault();
            alert("Por favor dibuja una firma.");
            return;
        }

        const firmaData = signaturePad.toDataURL();
        document.getElementById('firmaInput').value = firmaData;
    });

    // Cuando abres el modal, le pasas el tipo de firma.
    function abrirModalFirma(tipo) {
        signaturePad.clear();
        document.getElementById('tipoFirmaInput').value = tipo;
        const modal = new bootstrap.Modal(document.getElementById('firmaModal'));
        modal.show();
    }

    // Lightbox para imágenes.
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const closeBtn = document.querySelector('.lightbox-close');
    
    function mostrarLightbox(imgElement, caption) {
        lightboxImg.src = imgElement.src;
        lightboxCaption.textContent = caption;
        lightbox.style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Evita el scroll
    }
    
    closeBtn.addEventListener('click', function() {
        lightbox.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            lightbox.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
    
    // Cerrar con tecla ESC.
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && lightbox.style.display === 'flex') {
            lightbox.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
</script>

@endsection