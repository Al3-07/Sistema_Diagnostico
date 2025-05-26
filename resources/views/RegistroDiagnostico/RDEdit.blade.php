@extends('Layouts.app')

@section('titulo', 'Editar Diagnóstico de Equipo')

@section('contenido')

@include('sweetalert::alert')

<style>  
    /* Estilos base */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #000;
        font-size: 15px;
    }

    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin: 50px auto;
        max-width: 700px;
    }
    
    .card-body {
        padding: 1.5rem;
        background-color: #fff;
        margin-top: -10px; /* Reduce el margen superior para acercar el formulario al título */
    }

    /* Form layout - más compacto */
    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin: -8px;
        margin-bottom: 0.25rem; /* Reduce el margen inferior */
    }

    .form-group {
        flex: 1 1 calc(50% - 16px);
        min-width: 250px;
        padding: 8px;
        margin-bottom: 0.25rem; /* Reduce el margen inferior */
    }

    /* LABELS - más compactos */
    .form-label {
        display: block;
        margin-bottom: 4px;
        font-weight: 600;
        color: #344767;
        font-size: 0.95rem !important;
        letter-spacing: 0.3px;
    }

    /* INPUTS - Tamaño reducido */
    .form-control {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        color: #344767;
    }
    
    .form-control:focus {
        border-color: #0ea5e9;
        outline: none;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.25);
    }
    
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    
    .text-danger {
        color: #dc3545;
        font-size: 0.75rem;
        margin-top: 2px;
        display: block;
    }
    
    /* Área de texto más pequeña */
    textarea.form-control {
        height: 80px;
        resize: vertical;
    }
    
    /* Botones */
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .btn-secondary {
        background-color: #f1f5f9;
        color: #344767;
        border: none;
    }
    
    .btn-secondary:hover {
        background-color: #e2e8f0;
        transform: translateY(-2px);
    }
    
    .btn-custom, .btn-info {
        background-color: #0ea5e9;
        border-color: #0ea5e9;
        color: #344767;
    }

    .btn-custom:hover, .btn-info:hover {
        background-color: #0284c7;
        border-color: #0284c7;
        color: white;
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3);
        transform: translateY(-2px);
    }
    
    /* Footer para botones */
    .d-flex {
        display: flex;
    }
    
    .justify-content-end {
        justify-content: flex-end;
    }
    
    .gap-3 {
        gap: 0.75rem;
    }
    
    @media (max-width: 768px) {
        .form-group {
            flex: 1 1 100%;
        }
    }

    /* Estilos para vista previa imágenes */
    .img-preview {
        display: block;
        max-width: 200px;
        margin-top: 10px;
        border-radius: 8px;
        box-shadow: 0 0 5px rgba(0,0,0,0.2);
    }
</style>

<div class="card p-4">
    <form method="post" action="{{ route('registrodiagnostico.update', $registro->id) }}" enctype="multipart/form-data" id="diagnostico-form">
        @csrf
        @method('PUT')

        <!-- Título -->
        <div class="text-center mb-5" style="background-color: #f0f0f0; color: #344767; padding: 15px; border-radius: 8px;">
            <h3 class="m-0">Editar Diagnóstico de Equipo</h3>
        </div>

        <div class="card-body">
            <!-- Primera fila: Equipo y Modelo -->
              <div class="form-row">
                <div class="form-group">
    <label class="form-label" for="empresa">Empresa</label>
    <select id="empresa" name="empresa" class="form-control @error('empresa') is-invalid @enderror">
        <option value="">Seleccione una opción</option>
        <option value="TAOSA" {{ old('empresa', $registro->empresa ?? '') == 'TAOSA' ? 'selected' : '' }}>TAOSA</option>
        <option value="Clasificadora y Exportadora de Tabaco" {{ old('empresa', $registro->empresa ?? '') == 'Clasificadora y Exportadora de Tabaco' ? 'selected' : '' }}>Clasificadora y Exportadora de Tabaco</option>
        <option value="TAOMOR" {{ old('empresa', $registro->empresa ?? '') == 'TAOMOR' ? 'selected' : '' }}>TAOMOR</option>
        <option value="TAOCA" {{ old('empresa', $registro->empresa ?? '') == 'TAOCA' ? 'selected' : '' }}>TAOCA</option>
        <option value="TAOGUALI" {{ old('empresa', $registro->empresa ?? '') == 'TAOGUALI' ? 'selected' : '' }}>TAOGUALI</option>
        <option value="La Vega" {{ old('empresa', $registro->empresa ?? '') == 'La Vega' ? 'selected' : '' }}>La Vega</option>
        <option value="Calpule" {{ old('empresa', $registro->empresa ?? '') == 'Calpule' ? 'selected' : '' }}>Calpule</option>
        <option value="Azacualpa" {{ old('empresa', $registro->empresa ?? '') == 'Azacualpa' ? 'selected' : '' }}>Azacualpa</option>
        <option value="Escogida3" {{ old('empresa', $registro->empresa ?? '') == 'Escogida3' ? 'selected' : '' }}>Escogida3</option>
    </select>
    @error('empresa')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="equipo">Hardware</label>
                    <input type="text" id="equipo" name="equipo" class="form-control @error('equipo') is-invalid @enderror"
                           value="{{ old('equipo', $registro->equipo) }}" maxlength="50">
                    @error('equipo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="modelo">Modelo</label>
                    <input type="text" id="modelo" name="modelo" class="form-control @error('modelo') is-invalid @enderror"
                           value="{{ old('modelo', $registro->modelo) }}" maxlength="30">
                    @error('modelo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Segunda fila: Marca y Serie -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="marca">Marca</label>
                    <input type="text" id="marca" name="marca" class="form-control @error('marca') is-invalid @enderror"
                           value="{{ old('marca', $registro->marca) }}" maxlength="30">
                    @error('marca')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="serie">Serie</label>
                    <input type="text" id="serie" name="serie" class="form-control @error('serie') is-invalid @enderror"
                           value="{{ old('serie', $registro->serie) }}" maxlength="40">
                    @error('serie')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Descripción -->
            <div class="form-row">
                <div class="form-group" style="flex: 1 1 100%;">
                    <label class="form-label" for="descripcion">Descripción del diagnóstico</label>
                    <textarea id="descripcion" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                              maxlength="300">{{ old('descripcion', $registro->descripcion) }}</textarea>
                    @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

             <!-- Cuarta fila -->
            <div class="form-row">
                <div class="form-group">
    <label for="estado">Estado</label>
    <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror">
        <option value="">Seleccione una opción</option>
        <option value="Mal estado" {{ old('estado', $registro->estado ?? '') == 'Mal estado' ? 'selected' : '' }}>Mal estado</option>
        <option value="Buen estado" {{ old('estado', $registro->estado ?? '') == 'Buen estado' ? 'selected' : '' }}>Buen estado</option>
    </select>
    @error('estado')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

                </div>

            <!-- Campos para imágenes -->
            <div class="form-row mt-3">
                <div class="form-group" style="flex: 1 1 50%;">
                    <label for="foto_antes">Condición Original</label>
                    <input type="file" id="foto_antes" name="foto_antes" accept="image/*" class="form-control @error('foto_antes') is-invalid @enderror" onchange="previewImage(this, 'previewAntes')">
                    @error('foto_antes')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    @if($registro->foto_antes)
                        <img src="{{ asset('img/post/' . $registro->foto_antes) }}" alt="Foto Antes actual" class="img-preview" id="previewAntes">
                    @else
                        <img id="previewAntes" class="img-preview" style="display:none;" alt="Vista previa foto antes">
                    @endif
                </div>

                <div class="form-group" style="flex: 1 1 50%;">
                    <label for="foto_despues">Resultado Final</label>
                    <input type="file" id="foto_despues" name="foto_despues" accept="image/*" class="form-control @error('foto_despues') is-invalid @enderror" onchange="previewImage(this, 'previewDespues')">
                    @error('foto_despues')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    @if($registro->foto_despues)
                        <img src="{{ asset('img/post/' . $registro->foto_despues) }}" alt="Foto Después actual" class="img-preview" id="previewDespues">
                    @else
                        <img id="previewDespues" class="img-preview" style="display:none;" alt="Vista previa foto después">
                    @endif
                </div>
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-end gap-3 mt-4">
                 <a href="{{ route('registrodiagnostico.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Regresar
                </a>
                <button type="submit" class="btn btn-info">
                    <i class="fas fa-sync-alt me-1"></i> Actualizar
                </button>
            </div>
        </div>
    </form>

<script>
    function previewImage(input, previewId) {
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            const img = document.getElementById(previewId);
            img.src = e.target.result;
            img.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

</div>

@endsection
