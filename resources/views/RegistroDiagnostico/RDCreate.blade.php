@extends('Layouts.app')

@section('titulo','Registrar Diagnóstico de Equipo')

@section('contenido')

@include('sweetalert::alert')

<style>
    
    .img-preview {
        display: none;
        max-width: 200px;
        margin-top: 10px;
        border-radius: 8px;
        box-shadow: 0 0 5px rgba(0,0,0,0.2);
    }
</style>

<div class="card p-4">
    <form method="POST" action="{{ route('registrodiagnostico.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Título -->
        <div class="text-center mb-5" style="background-color: #f0f0f0; color: #344767; padding: 15px; border-radius: 8px;">
            <h3 class="m-0">Registro de Diagnóstico de Equipo</h3>
        </div>

        <div class="card-body">
            <!-- Primera fila -->
             <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="empresa">Empresa</label>
                    <select id="empresa" name="empresa" class="form-control @error('empresa') is-invalid @enderror" value="{{ old('empresa') }}">
                        <option value="">Seleccione una opción</option>
                    <option value="TAOSA">TAOSA</option>
                    <option value="Clasificadora y Exportadora de Tabaco">Clasificadora y Exportadora de Tabaco</option>
                    <option value="TAOMOR">TAOMOR </option>
                    <option value="TAOCA">TAOCA</option>
                    <option value="TAOGUALI">TAOGUALI</option>
                    <option value="La Vega">La Vega</option>
                    <option value="Calpule">Calpule</option>
                    <option value="Azacualpa">Azacualpa</option>
                    <option value="Escogida3">Escogida3</option>
                </select>
                    @error('empresa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="equipo">Hardware</label>
                    <input type="text" id="equipo" name="equipo" class="form-control @error('equipo') is-invalid @enderror" value="{{ old('equipo') }}">
                    @error('equipo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="modelo">Modelo</label>
                    <input type="text" id="modelo" name="modelo" class="form-control @error('modelo') is-invalid @enderror" value="{{ old('modelo') }}">
                    @error('modelo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Segunda fila -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="marca">Marca</label>
                    <input type="text" id="marca" name="marca" class="form-control @error('marca') is-invalid @enderror" value="{{ old('marca') }}">
                    @error('marca')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="serie">Serie</label>
                    <input type="text" id="serie" name="serie" class="form-control @error('serie') is-invalid @enderror" value="{{ old('serie') }}">
                    @error('serie')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Tercera fila -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="descripcion">Descripción del diagnóstico</label>
                    <textarea id="descripcion" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
 <!-- Cuarta fila -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="estado">Estado</label>
                    <select id="estado" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado') }}">
                        <option value="">Seleccione una opción</option>
                    <option value="Mal estado">Mal estado</option>
                    <option value="Buen estado">Buen estado</option>
                    
                </select>
                    @error('estado')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            <!-- Campos para imágenes -->
            <div class="form-row mt-3">
                <div class="form-group">
                    <label for="foto_antes">Estado Inicial del Equipo</label>
                    <input type="file" id="foto_antes" name="foto_antes" accept="image/*" class="form-control @error('foto_antes') is-invalid @enderror" onchange="previewImage(this, 'previewAntes')">
                    @error('foto_antes')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <img id="previewAntes" class="img-preview" alt="Vista previa foto antes">
                </div>

                <!--
                <div class="form-group">
                    <label for="foto_despues">Foto Después</label>
                    <input type="file" id="foto_despues" name="foto_despues" accept="image/*" class="form-control @error('foto_despues') is-invalid @enderror" onchange="previewImage(this, 'previewDespues')">
                    @error('foto_despues')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <img id="previewDespues" class="img-preview" alt="Vista previa foto después">
                </div>
   
                    -->
            
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-end gap-3 mt-4">
               <a href="{{ route('registrodiagnostico.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Regresar
                </a>
                <button type="submit" class="btn btn-custom">
                    <i class="fas fa-save me-1"></i> Guardar
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
