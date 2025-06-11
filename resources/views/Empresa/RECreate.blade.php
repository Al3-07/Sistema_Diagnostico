@extends('layouts.app')  
@section('titulo', 'Crear Empresa')  
@section('contenido') 
@include('sweetalert::alert')  

<style>
    :root {
        --primary-color: #2563eb;
        --secondary-color: #16a34a;
        --hover-color: #1e40af;
        --text-dark: #1f2937;
        --text-light: #6b7280;
        --light-bg: #f9fafb;
        --border-color: #e5e7eb;
    }
    
    .contenedor {
        display: flex;
        justify-content: center;
        align-items: flex-start; /* Cambiado a flex-start para mejor flujo */
        min-height: 60vh;
        padding: 2rem 1rem;
        background-color: var(--light-bg);
    }
    
    .card {
        background-color: white;
        border-radius: 16px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        padding: 2.5rem;
        width: 100%;
        max-width: 700px;
        border: 1px solid var(--border-color);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .form-label {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-control {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }
    
    .btn {
        border-radius: 8px;
        padding: 0.625rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .btn-secondary {
        background-color:rgb(150, 156, 166);
        color: var(--text-dark);
        border: 1px solid var(--border-color);
    }
    
    .btn-secondary:hover {
        background-color:rgb(138, 131, 131);
        color: var(--text-dark);
    }
    
    .btn-custom {
        background-color:rgb(71, 154, 255);
        color: white;
    }
    
    .btn-custom:hover {
        background-color:rgb(85, 122, 255);
        transform: translateY(-1px);
    }
    
    .card-title {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 1.875rem;
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .card-title:after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        margin: 1rem auto 0;
        border-radius: 2px;
    }
    
    .buttons-container {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }
    
    .alert-success {
        background-color: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .text-danger {
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
    }
    
    /* Ajustes para móviles */
    @media (max-width: 768px) {
        .contenedor {
            padding: 1rem;
            min-height: auto;
        }
        
        .card {
            padding: 1.5rem;
        }
        
        .card-title {
            font-size: 1.5rem;
        }
        
        .buttons-container {
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .buttons-container .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>  

<div class="contenedor">
  <div class="card">     
    <h2 class="card-title">
      Crear Nueva Empresa
    </h2>

    @if(session('success'))
      <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
      </div>
    @endif

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