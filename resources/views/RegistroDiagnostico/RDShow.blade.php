@extends('Layouts.app')

@section('titulo', 'Detalles del Diagnóstico del Equipo')

@section('contenido')

<style>
    .btn-secondary {
        background-color: #f1f5f9;
        color: #000;
        border: none;
    }
    
    .btn-secondary:hover {
        background-color: #e2e8f0;
    }
</style>

<!-- Mostrar los detalles del equipo -->
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
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
