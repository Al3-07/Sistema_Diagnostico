@extends('layouts.app')  
@section('titulo', 'Crear Empresa')  
@section('contenido') 
@include('sweetalert::alert')  

<style>/* Modal para crear la firma. */
    :root {
        --primary-color: #2563eb; /* Color principal. */   
        --secondary-color: #16a34a; /* Color secundario. */
        --hover-color: #1e40af; /* Color de hover. */
        --text-dark: #1f2937; /* Color de texto oscuro. */
        --text-light: #6b7280; /* Color de texto claro. */
        --light-bg: #f9fafb; /* Color de fondo claro. */
        --border-color: #e5e7eb;
    }
    
    .contenedor {
        display: flex;
        justify-content: center;
        align-items: flex-start; /* Cambiado a flex-start para mejor flujo. */
        min-height: 60vh; /* Altura minima. */
        padding: 2rem 1rem; /* Margen. */
        background-color: var(--light-bg); /* Color de fondo claro. */
    }
    
    .card {
        background-color: white; /* Color de fondo. */
        border-radius: 16px; /* Radio de la curva. */
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* Sombra. */
        padding: 2.5rem; /* Margen. */
        width: 100%; /* Ancho maximo. */
        max-width: 700px; /* Ancho maximo. */
        border: 1px solid var(--border-color); /* Borde. */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transicion. */
    }
    
    .card:hover {
        transform: translateY(-2px); /* Transformacion. */
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); /* Sombra. */
    }
    
    .form-label {
        font-weight: 600; /* Peso de la fuente. */
        color: var(--text-dark); /* Color de texto oscuro. */
        margin-bottom: 0.5rem; /* Margen inferior. */
        display: block;
    }
    
    .form-control {
        border: 1px solid var(--border-color); /* Borde. */
        border-radius: 8px; /* Radio de la curva. */
        padding: 0.75rem 1rem; /* Margen. */
        font-size: 1rem; /* Tamaño de la fuente. */
        transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Transicion. */
    }
    
    .form-control:focus {
        border-color: var(--primary-color); /* Borde. */
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); /* Sombra. */
        outline: none;
    }
    
    .btn {
        border-radius: 8px; /* Radio de la curva. */
        padding: 0.625rem 1.25rem; /* Margen. */
        font-size: 0.875rem; /* Tamaño de la fuente. */
        font-weight: 500; /* Peso de la fuente. */
        display: inline-flex; /* Desbordamiento. */
        align-items: center; /* Alineacion. */
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .btn-secondary {
        background-color:rgb(150, 156, 166); /* Color de fondo. */
        color: var(--text-dark); /* Color de texto oscuro. */
        border: 1px solid var(--border-color); /* Borde. */
    }
    
    .btn-secondary:hover {
        background-color:rgb(138, 131, 131); /* Color de fondo. */
        color: var(--text-dark); /* Color de texto oscuro. */
    }
    
    .btn-custom {
        background-color:rgb(71, 154, 255); /* Color de fondo. */
        color: white;
    }
    
    .btn-custom:hover {
        background-color:rgb(85, 122, 255); /* Color de fondo. */
        transform: translateY(-1px); /* Transformacion. */
    }
    
    .card-title {
        color: var(--text-dark); /* Color de texto oscuro. */
        font-weight: 700; /* Peso de la fuente. */
        font-size: 1.875rem; /* Tamaño de la fuente. */
        text-align: center; /* Alineacion. */
        margin-bottom: 2rem; /* Margen inferior. */
        position: relative; /* Posicionamiento. */
    }
    
    .card-title:after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color)); /* Color de fondo. */
        margin: 1rem auto 0; /* Margen. */
        border-radius: 2px; /* Radio de la curva. */
    }
    
    .buttons-container {
        display: flex; /* Desbordamiento. */
        justify-content: flex-end; /* Alineacion. */
        gap: 1rem; /* Margen. */
        margin-top: 2rem; /* Margen superior. */
        flex-wrap: wrap; /* Ajuste de la imagen. */
    }
    
    .alert-success {
        background-color: #f0fdf4; /* Color de fondo. */
        color: #15803d; /* Color de texto oscuro. */
        border: 1px solid #bbf7d0; /* Borde. */
        border-radius: 8px; /* Radio de la curva. */
        padding: 1rem; /* Margen. */
        margin-bottom: 1.5rem; /* Margen inferior. */
    }
    
    .text-danger {
        color: #dc2626; /* Color de texto oscuro. */
        font-size: 0.875rem; /* Tamaño de la fuente. */
        margin-top: 0.25rem; /* Margen superior. */
        display: block; /* Desbordamiento. */
    }
    
    /* Ajustes para móviles. */
    @media (max-width: 768px) {
        .contenedor {
            padding: 1rem; /* Margen. */
            min-height: auto; /* Altura minima. */
        }
        
        .card {
            padding: 1.5rem; /* Margen. */
        }
        
        .card-title {
            font-size: 1.5rem; /* Tamaño de la fuente. */
        }
        
        .buttons-container {
            flex-direction: column; /* Desbordamiento. */
            gap: 0.75rem; /* Margen. */
        }
        
        .buttons-container .btn {
            width: 100%; /* Ancho maximo. */
            justify-content: center;
        }
    }
</style>  
<!-- Contenedor. -->
<div class="contenedor">
  <div class="card">     
    <h2 class="card-title">
      Crear Nueva Empresa
    </h2>
    <!-- Alerta de exito. -->
    @if(session('success'))
      <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
      </div>
    @endif
    <!-- Formulario. -->
    <form action="{{ route('empresa.store') }}" method="POST">
      @csrf
      <div class="form-group mb-4">
        <label for="empresa" class="form-label">Nombre de la Empresa</label>
        <input type="text" name="empresa" id="empresa" class="form-control @error('empresa') is-invalid @enderror" required placeholder="Ingrese el nombre de la empresa">
        @error('empresa') 
          <span class="text-danger">
            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
          </span> 
        @enderror
      </div>
      <!-- Botones. -->
      <div class="buttons-container">
        <a href="{{ route('empresa.index') }}" class="btn btn-secondary">
          <i class="fas fa-arrow-left me-2"></i> Regresar
        </a>
        <button type="submit" class="btn btn-custom">
          <i class="fas fa-save me-2"></i> Guardar
        </button>
      </div>
    </form>
  </div>
</div>
@endsection