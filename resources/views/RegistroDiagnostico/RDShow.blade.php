@extends('Layouts.app')

@section('titulo', 'Detalles del Diagnóstico del Equipo')

@section('contenido')

<style>
    .img-mismo-tamano {
        width: 300px;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
        margin-bottom: 15px;
    }
    .btn-secondary {
        background-color: #f1f5f9;
        color: #000;
        border: none;
    }
    
    .btn-secondary:hover {
        background-color: #e2e8f0;
    }

    .foto-detalle {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
        margin-bottom: 15px;
    }

    .foto-container {
        margin-top: 15px;
    }

    .foto-label {
        font-weight: 600;
        color: #344767;
        margin-bottom: 5px;
        display: block;
    }
</style>

<div class="container mt-5">        
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #e2e8f0; color: #344767;">
            <h3 class="card-title mb-0">
                <i class="fas fa-tools me-2"></i><b>Detalles del Diagnóstico del Equipo</b>
            </h3>
            <a href="javascript:window.history.back();" class="btn btn-secondary btn-icon">
                <i class="fas fa-arrow-left"></i> 
            </a>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-md-6">
                    <p style="color: #334155;"><strong>Equipo:</strong> {{ $registro->equipo }}</p>
                    <p style="color: #334155;"><strong>Marca:</strong> {{ $registro->marca }}</p>
                    <p style="color: #334155;"><strong>Modelo:</strong> {{ $registro->modelo }}</p>
                    <p style="color: #334155;"><strong>Serie:</strong> {{ $registro->serie }}</p>
                </div>
                <div class="col-md-6">
                    <p style="color: #334155;"><strong>Descripción:</strong> {{ $registro->descripcion }}</p>

                    <div class="foto-container">
                     <span class="foto-label">Condición Original:</span>
                     @if($registro->foto_antes)
                    <img src="{{ asset('img/post/' . $registro->foto_antes) }}" alt="Foto Antes" class="img-mismo-tamano">
                     @else
                    <p>No hay foto antes disponible.</p>
                    @endif
                    </div>

                    <div class="foto-container">
                        <span class="foto-label">Resultado Final:</span>
                        @if($registro->foto_despues)
                            <img src="{{ asset('img/post/' . $registro->foto_despues) }}" alt="Foto Después" class="img-mismo-tamano">
                        @else
                            <p>No hay foto después disponible.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
