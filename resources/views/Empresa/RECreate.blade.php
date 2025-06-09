@extends('layouts.app')  
@section('titulo', 'Crear Empresa')  
@section('contenido') 
@include('sweetalert::alert')  

<style>     
    .form-label {         
        font-weight: bold;     
    }     
    .btn-custom {         
        background-color:  #16a34a; /* Verde un poco más oscuro al hacer hover */ 
        color: white;     
    }     
    .btn-custom:hover {         
        background-color:  #16a34a; /* Verde un poco más oscuro al hacer hover */ 
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
    <h2 class="text-center mb-4" style="color: #2c3e50; font-weight: 600; font-size: 28px; position: relative;">
        Crear Empresa
        <span style="display: block; width: 60px; height: 3px; background-color: #00b894; margin: 8px auto 0; border-radius: 2px;"></span>
    </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('empresa.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="empresa" class="form-label">Nombre de la Empresa:</label>
            <input type="text" name="empresa" id="empresa" class="form-control @error('empresa') is-invalid @enderror" required>
            @error('empresa') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('empresa.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Regresar
            </a>
            <button type="submit" class="btn btn-custom">
                <i class="fas fa-save me-1"></i> Guardar
            </button>
        </div>

    </form>
</div>
@endsection