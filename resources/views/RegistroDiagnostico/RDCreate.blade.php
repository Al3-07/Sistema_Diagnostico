@extends('layouts.app')  
@section('titulo','Registrar Diagnóstico de Equipo')  
@section('contenido') 
@include('sweetalert::alert')  

<style>     
    /*Imagen inicial y la imagen final.*/
    .img-preview {         
        display: none;         
        max-width: 200px;         
        margin-top: 10px;         
        border-radius: 8px;         
        box-shadow: 0 0 5px rgba(0,0,0,0.2);     
    }     
    /* LIGHTBOX elegante y sin distorsión. */
    #lightbox {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 1050;
    }

    #lightbox.show {
        display: flex;
    }

    #lightbox img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
        transition: transform 0.3s ease;
    }

    .form-label {         
        font-weight: bold;     
    }     
    .btn-custom {         
        background-color:  #16a34a; /* Verde un poco más oscuro al hacer hover */;
        color: white;     
    }     
    .btn-custom:hover {         
        background-color:  #16a34a; /* Verde un poco más oscuro al hacer hover */;
        color: white;     
    }     
    .card {         
        background-color: white;         
        border-radius: 12px;         
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);         
        padding: 2rem;         
        margin-top: 2rem;     
    } 
</style>  

<div class="card">     
    <form method="POST" action="{{ route('registrodiagnostico.store') }}" enctype="multipart/form-data">         
        @csrf          
        <!-- Titulo de la vista. -->
<h2 class="text-center mb-4" style="color: #2c3e50; font-weight: 600; font-size: 28px; position: relative;">
    Informe de Diagnóstico Técnico
    <span style="display: block; width: 60px; height: 3px; background-color: #00b894; margin: 8px auto 0; border-radius: 2px;"></span>
</h2>
<h5 class="text-end mb-4" style="color: #00b894;">
    <strong>Correlativo:</strong> {{ $correlativo }}
</h5>

        <div class="row mb-3">          <!-- Datos de la Vista.-->           
            <div class="col-md-6">                 
                <label for="empresa_id" class="form-label">Empresa</label>
                    <select id="empresa_id" name="empresa_id" class="form-control @error('empresa_id') is-invalid @enderror">
                     <option value="">Seleccione una opción</option>
                     @foreach ($empresas as $empresa)
                      <option value="{{ $empresa->id }}">{{ $empresa->empresa }}</option>
                    @endforeach
                    </select>
                    @error('empresa_id')
                     <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>             
            <div class="col-md-6">                 
                <label for="equipo" class="form-label">Hardware</label>                 
                <input type="text" id="equipo" name="equipo" class="form-control @error('equipo') is-invalid @enderror" value="{{ old('equipo') }}">                 
                @error('equipo')                     
                    <span class="text-danger">{{ $message }}</span>                 
                @enderror             
            </div>         
        </div>          

        <div class="row mb-3">             
            <div class="col-md-6">                 
                <label for="modelo" class="form-label">Modelo</label>                 
                <input type="text" id="modelo" name="modelo" class="form-control @error('modelo') is-invalid @enderror" value="{{ old('modelo') }}">                 
                @error('modelo')                     
                    <span class="text-danger">{{ $message }}</span>                 
                @enderror             
            </div>             
            <div class="col-md-6">                 
                <label for="marca" class="form-label">Marca</label>                 
                <input type="text" id="marca" name="marca" class="form-control @error('marca') is-invalid @enderror" value="{{ old('marca') }}">                 
                @error('marca')                     
                    <span class="text-danger">{{ $message }}</span>                 
                @enderror             
            </div>         
        </div>          

        <div class="row mb-3">             
            <div class="col-md-6">                 
                <label for="serie" class="form-label">Serie</label>                 
                <input type="text" id="serie" name="serie" class="form-control @error('serie') is-invalid @enderror" value="{{ old('serie') }}">                 
                @error('serie')                     
                    <span class="text-danger">{{ $message }}</span>                 
                @enderror             
            </div>             
            <div class="col-md-6">                 
                <label for="estado" class="form-label">Estado</label>                 
                <select id="estado" name="estado" class="form-control @error('estado') is-invalid @enderror">                     
                    <option value="">Seleccione una opción</option>                     
                    <option value="Mal estado">Mal estado</option>                     
                    <option value="Regular">Regular</option>                     
                    <option value="Buen estado">Buen estado</option>                 
                </select>                 
                @error('estado')                     
                    <span class="text-danger">{{ $message }}</span>                 
                @enderror             
            </div>
        
        </div>          

        <div class="mb-3">             
            <label for="descripcion" class="form-label">Descripción del diagnóstico</label>             
            <textarea id="descripcion" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="4">{{ old('descripcion') }}</textarea>             
            @error('descripcion')                 
                <span class="text-danger">{{ $message }}</span>             
            @enderror         
        </div>          

      <!-- Muestra la imagen inicial -->
<div class="form-group" style="flex: 1; min-width: 200px;">
    <label for="foto_antes" class="form-label">Imagen Inicial</label>

    <div style="display: flex; gap: 10px; align-items: center;">
        <!-- Input normal visible para seleccionar archivo -->
        <input type="file" name="foto_antes" id="foto_antes"
               accept="image/*"
               class="form-control @error('foto_antes') is-invalid @enderror"
               onchange="previewImage(this, 'previewAntes')"
               style="flex: 1;">

        <!-- Botón para abrir cámara -->
        <button type="button" class="btn" style="background-color:rgb(90, 196, 90); color: white;" onclick="document.getElementById('foto_antes_camera').click()">
            📷 Tomar Foto
        </button>

    </div>
    <!-- Input oculto para abrir cámara -->
    <input type="file" name="foto_antes_camera" id="foto_antes_camera"
           accept="image/*"
           capture="environment"
           onchange="previewImage(this, 'previewAntes')"
           style="display:none;">

    @error('foto_antes') <span class="text-danger">{{ $message }}</span> @enderror

    <!-- Imagen preview sin src al inicio -->
    <img id="previewAntes" 
         class="img-preview"
         style="display:none;"
         onclick="openLightbox(this.src)">
</div>
        <!-- Botones de Regresar y Guardar.-->
        <div class="d-flex justify-content-end gap-3">             
            <a href="{{ route('registrodiagnostico.index') }}" class="btn btn-secondary">                 
                <i class="fas fa-arrow-left me-1"></i> Regresar             
            </a>             
            <button type="submit" class="btn btn-custom">                 
                <i class="fas fa-save me-1"></i> Guardar             
            </button>         
        </div>     
    </form> 
</div>  
<!-- Contenedor invisible para ampliar image inicial. -->
<div id="lightbox" onclick="this.classList.remove('show')">
    <img src="" alt="Imagen ampliada">
</div>

<script>   
/*Funcion para cargar la imagen.*/  
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
    
    /*Funcion para que la imagen se visualice mejor.*/
    function openLightbox(src) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = lightbox.querySelector('img');
    lightboxImg.src = src;
    lightbox.classList.add('show');
}

</script> 
@endsection
