@extends('Layouts.app')

@section('titulo', 'Editar Diagnóstico de Equipo')

@section('contenido')

@include('sweetalert::alert')

<style>
    :root {
        --primary: #4361ee;
        --primary-light: #3f37c9;
        --secondary: #3a0ca3;
        --accent: #f72585;
        --light: #f8f9fa;
        --dark: #212529;
        --gray: #6c757d;
        --light-gray: #e9ecef;
        --success: #4cc9f0;
        --warning: #f8961e;
        --danger: #ef233c;
        --border-radius: 12px;
        --box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    .edit-container {
        max-width: 900px;
        margin: 1rem auto;
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 1.5rem;
        border: none;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
    }

    .edit-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background:rgb(165, 165, 165);
    }

    @media (min-width: 768px) {
        .edit-container {
            padding: 2rem;
            margin: 2rem auto;
        }
    }

    @media (min-width: 992px) {
        .edit-container {
            margin-top: 60px;
            margin-left: 220px;
            margin-right: 20px;
        }
    }

    .edit-container:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
    }

    .edit-header {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    @media (min-width: 576px) {
        .edit-header {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }

    .edit-title {
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--dark);
        position: relative;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin: 0;
    }

    @media (min-width: 768px) {
        .edit-title {
            font-size: 1.8rem;
        }
    }

    .edit-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--primary);
        border-radius: 2px;
    }

    .edit-badge {
        background: linear-gradient(135deg, var(--warning), #f3722c);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .correlativo {
        background-color: var(--light-gray);
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        color: var(--gray);
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.9rem;
    }

    .form-section {
        margin-bottom: 1.5rem;
    }

    @media (min-width: 768px) {
        .form-section {
            margin-bottom: 2rem;
        }
    }

    .section-title {
        font-weight: 600;
        font-size: 1rem;
        color:var(--primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--light-gray);
    }

    @media (min-width: 768px) {
        .section-title {
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
        }
    }

    label {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        color: var(--dark);
        display: block;
    }

    @media (min-width: 768px) {
        label {
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid var(--light-gray);
        padding: 0.65rem 0.9rem;
        font-size: 0.95rem;
        color: var(--dark);
        transition: var(--transition);
        background-color: white;
        width: 100%;
    }

    @media (min-width: 768px) {
        .form-control {
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        outline: none;
    }

    .form-control.is-invalid {
        border-color: var(--danger);
    }

    .invalid-feedback {
        font-size: 0.8rem;
        color: var(--danger);
        margin-top: 0.3rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .form-row {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    @media (min-width: 576px) {
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
    }

    .form-group {
        margin-bottom: 1rem;
    }

    @media (min-width: 768px) {
        .form-group {
            margin-bottom: 1.2rem;
        }
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    @media (min-width: 768px) {
        textarea.form-control {
            min-height: 120px;
        }
    }

    .image-upload-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        .image-upload-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
    }

    .image-upload-card {
        border: 1px dashed var(--gray);
        border-radius: var(--border-radius);
        padding: 1.2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: var(--transition);
        background-color: var(--light);
    }

    @media (min-width: 768px) {
        .image-upload-card {
            padding: 1.5rem;
        }
    }

    .image-upload-card:hover {
        border-color: var(--primary);
        background-color: rgba(67, 97, 238, 0.03);
    }

    .img-preview-container {
        position: relative;
        width: 100%;
        margin-top: 0.8rem;
    }

    .img-preview {
        width: 100%;
        height: 180px;
        object-fit: contain;
        border-radius: var(--border-radius);
        border: 1px solid var(--light-gray);
        cursor: pointer;
        transition: var(--transition);
        background-color: white;
    }

    @media (min-width: 768px) {
        .img-preview {
            height: 200px;
        }
    }

    .img-preview:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .camera-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 0.8rem;
        padding: 0.6rem;
        font-size: 0.9rem;
    }

    @media (min-width: 768px) {
        .camera-btn {
            padding: 0.7rem;
            font-size: 0.95rem;
        }
    }

    .btn {
        font-weight: 600;
        padding: 0.65rem 1.2rem;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 100%;
        justify-content: center;
    }

    @media (min-width: 576px) {
        .btn {
            width: auto;
            padding: 0.7rem 1.5rem;
            font-size: 0.95rem;
        }
    }

    .btn-secondary, .btn-primary {
    padding: 0.4rem 0.8rem; /* Reduje el padding para hacerlos más pequeños */
    font-size: 0.875rem; /* Tamaño de fuente más pequeño (14px aprox) */
    border-radius: 0.375rem; /* Radio de borde moderado */
    border: none;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    white-space: nowrap;
}

.btn-secondary {
    background-color: var(--light-gray);
    color: var(--dark);
}

.btn-secondary:hover {
    background-color: #d1d5db;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.btn-primary {
    background-color: var(--primary);
    color: white;
}

.btn-primary:hover {
    background-color: var(--primary-light);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

    .btn-success {
        background-color: var(--success);
        color: white;
    }

    .btn-success:hover {
        background-color: #3a86ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .footer-actions {
        display: flex;
        flex-direction: column-reverse;
        gap: 1.5rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--light-gray);
    }

    @media (min-width: 576px) {
        .footer-actions {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }
    }

    .meta-info {
        font-size: 0.85rem;
        color: var(--gray);
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    @media (min-width: 576px) {
        .meta-info {
            flex-direction: row;
            align-items: center;
            gap: 1rem;
            font-size: 0.9rem;
        }
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        width: 100%;
    }

    @media (min-width: 576px) {
        .action-buttons {
            flex-direction: row;
            justify-content: flex-end;
            gap: 1rem;
            width: auto;
        }
    }

    /* Lightbox styles */
    .lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        cursor: zoom-out;
    }

    .lightbox img {
        max-width: 95%;
        max-height: 95%;
        border-radius: var(--border-radius);
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
        animation: fadeIn 0.3s ease;
    }

    @media (min-width: 768px) {
        .lightbox img {
            max-width: 90%;
            max-height: 90%;
        }
    }

    .lightbox.show {
        display: flex;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Alert styles */
    .alert {
        padding: 0.8rem 1rem;
        border-radius: var(--border-radius);
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.9rem;
    }

    @media (min-width: 768px) {
        .alert {
            padding: 1rem;
            font-size: 1rem;
            gap: 0.8rem;
        }
    }

    .alert-warning {
        background-color: #fff3cd;
        color: #856404;
        border-left: 4px solid var(--warning);
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 4px solid var(--success);
    }
</style>

<div class="edit-container">
    <div class="edit-header">
        <h3 class="edit-title">
            <i class="fas fa-clipboard-check"></i>
            <span>Editar Diagnóstico</span>
        </h3>
        <div class="correlativo">
            <i class="fas"></i>
            <span>Correlativo: {{ $correlativo }}</span>
        </div>
    </div>

    @if(session('warning'))
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <form method="post" action="{{ route('registrodiagnostico.update', $registro->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Información Básica -->
        <div class="form-section">
            <h4 class="section-title">
                <i class="fas fa-info-circle"></i>
                Información Básica
            </h4>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="fecha"><i class="far fa-calendar-alt"></i> Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $registro->fecha) }}">
                </div>
                
                <div class="form-group">
                    <label for="empresa_id"><i class="fas fa-building"></i> Empresa</label>
                    <select id="empresa_id" name="empresa_id" class="form-control @error('empresa_id') is-invalid @enderror">
                        <option value="">Seleccione una empresa</option>
                        @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}" {{ $empresa->id == old('empresa_id', $registro->empresa_id) ? 'selected' : '' }}>
                            {{ $empresa->empresa }}
                        </option>
                        @endforeach
                    </select>
                    @error('empresa_id')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Detalles del Equipo -->
        <div class="form-section">
            <h4 class="section-title">
                <i class="fas fa-laptop"></i>
                Detalles del Equipo
            </h4>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="equipo"><i class="fas fa-desktop"></i> Hardware</label>
                    <input type="text" name="equipo" id="equipo" class="form-control @error('equipo') is-invalid @enderror"
                           value="{{ old('equipo', $registro->equipo) }}" maxlength="50" placeholder="Ej. Laptop, Impresora, etc.">
                    @error('equipo')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="modelo"><i class="fas fa-barcode"></i> Modelo</label>
                    <input type="text" name="modelo" id="modelo" class="form-control @error('modelo') is-invalid @enderror"
                           value="{{ old('modelo', $registro->modelo) }}" maxlength="30" placeholder="Modelo del equipo">
                    @error('modelo')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="marca"><i class="fas fa-tag"></i> Marca</label>
                    <input type="text" name="marca" id="marca" class="form-control @error('marca') is-invalid @enderror"
                           value="{{ old('marca', $registro->marca) }}" maxlength="30" placeholder="Marca del equipo">
                    @error('marca')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="serie"><i class="fas fa-hashtag"></i> N° Serie</label>
                    <input type="text" name="serie" id="serie" class="form-control @error('serie') is-invalid @enderror"
                           value="{{ old('serie', $registro->serie) }}" maxlength="40" placeholder="Número de serie">
                    @error('serie')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Diagnóstico -->
        <div class="form-section">
            <h4 class="section-title">
                <i class="fas fa-search-plus"></i>
                Diagnóstico
            </h4>
            
            <div class="form-group">
                <label for="descripcion"><i class="fas fa-align-left"></i> Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                          maxlength="300" placeholder="Describa el problema encontrado...">{{ old('descripcion', $registro->descripcion) }}</textarea>
                @error('descripcion')
                    <span class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="estado"><i class="fas fa-clipboard-list"></i> Estado del Equipo</label>
                <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror">
                    <option value="">Seleccione el estado</option>
                    <option value="Mal estado" {{ old('estado', $registro->estado) == 'Mal estado' ? 'selected' : '' }}>Mal estado</option>
                    <option value="Regular" {{ old('estado', $registro->estado) == 'Regular' ? 'selected' : '' }}>Regular</option>
                    <option value="Buen estado" {{ old('estado', $registro->estado) == 'Buen estado' ? 'selected' : '' }}>Buen estado</option>
                </select>
                @error('estado')
                    <span class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <!-- Evidencia Fotográfica -->
        <div class="form-section">
            <h4 class="section-title">
                <i class="fas fa-camera"></i>
                Evidencia Fotográfica
            </h4>
            
            <div class="image-upload-container">
                <!-- Imagen Inicial -->
                <div class="image-upload-card">
                    <label for="foto_antes"><i class="fas fa-image"></i> Imagen Inicial</label>
                    <input type="file" name="foto_antes" id="foto_antes" accept="image/*" capture="environment"
                           class="form-control @error('foto_antes') is-invalid @enderror"
                           onchange="previewImage(this, 'previewAntes')" style="display: none;">
                    
                    <button type="button" class="btn btn-success camera-btn" onclick="document.getElementById('foto_antes').click()">
                        <i class="fas fa-upload"></i> Subir Imagen
                    </button>
                    
                    <input type="file" name="foto_antes_camera" id="foto_antes_camera" accept="image/*" capture="environment"
                           onchange="previewImage(this, 'previewAntes')" style="display: none;">
                    
                    <button type="button" class="btn btn-primary camera-btn" onclick="document.getElementById('foto_antes_camera').click()">
                        <i class="fas fa-camera"></i> Tomar Foto
                    </button>

                    @error('foto_antes')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </span>
                    @enderror

                    <div class="img-preview-container">
                        <img id="previewAntes"
                             src="{{ $registro->foto_antes ? asset('img/post/' . $registro->foto_antes) : 'https://via.placeholder.com/300x200?text=Sin+imagen' }}"
                             class="img-preview"
                             onclick="openLightbox(this.src)">
                    </div>
                </div>

                <!-- Imagen Final -->
                <div class="image-upload-card">
                    <label for="foto_despues"><i class="fas fa-image"></i> Imagen Final</label>
                    <input type="file" name="foto_despues" id="foto_despues" accept="image/*" capture="environment"
                           class="form-control @error('foto_despues') is-invalid @enderror"
                           onchange="previewImage(this, 'previewDespues')" style="display: none;">
                    
                    <button type="button" class="btn btn-success camera-btn" onclick="document.getElementById('foto_despues').click()">
                        <i class="fas fa-upload"></i> Subir Imagen
                    </button>
                    
                    <input type="file" name="foto_despues_camera" id="foto_despues_camera" accept="image/*" capture="environment"
                           onchange="previewImage(this, 'previewDespues')" style="display: none;">
                    
                    <button type="button" class="btn btn-primary camera-btn" onclick="document.getElementById('foto_despues_camera').click()">
                        <i class="fas fa-camera"></i> Tomar Foto
                    </button>

                    @error('foto_despues')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </span>
                    @enderror

                    <div class="img-preview-container">
                        <img id="previewDespues"
                             src="{{ $registro->foto_despues ? asset('img/post/' . $registro->foto_despues) : 'https://via.placeholder.com/300x200?text=Sin+imagen' }}"
                             class="img-preview"
                             onclick="openLightbox(this.src)">
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="footer-actions">
            <div class="meta-info">
                <i class="far fa-clock"></i>
                <span>Registro creado el {{ $registro->created_at->format('d/m/Y H:i') }}</span>
                @if($registro->created_at != $registro->updated_at)
                    <i class="fas fa-sync-alt"></i>
                    <span>Última actualización: {{ $registro->updated_at->format('d/m/Y H:i') }}</span>
                @endif
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('registrodiagnostico.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Lightbox -->
<div id="globalLightbox" class="lightbox" onclick="closeLightbox()">
    <img id="lightboxImage" src="" alt="Vista ampliada">
</div>

<script>
    function previewImage(input, previewId) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.getElementById(previewId);
            img.src = e.target.result;
            img.onclick = () => openLightbox(e.target.result);
        };
        if (file) reader.readAsDataURL(file);
    }

    function openLightbox(src) {
        const lightbox = document.getElementById('globalLightbox');
        const lightboxImg = document.getElementById('lightboxImage');
        lightboxImg.src = src;
        lightbox.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lightbox = document.getElementById('globalLightbox');
        lightbox.classList.remove('show');
        document.body.style.overflow = 'auto';
    }

    // Cerrar lightbox con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });
</script>

@endsection