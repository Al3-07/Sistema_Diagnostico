@extends('layouts.app')

@section('titulo', 'Editar Empresa')

@section('contenido')

@include('sweetalert::alert')

<style>
    body {
        background: #f3f4f6;
        font-family: 'Poppins', sans-serif;
        color: #111827;
    }

    .container-custom {
        max-width: 850px;
        margin: 40px auto;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        padding: 2rem;
    }

    h3.title {
        font-weight: 600;
        font-size: 1.5rem;
        text-align: center;
        margin-bottom: 1.5rem;
        color: #0f172a;
    }

    label {
        font-weight: 500;
        font-size: 0.9rem;
        margin-bottom: 5px;
        color: #374151;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #d1d5db;
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
        color: #1f2937;
    }

    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .text-danger {
        font-size: 0.75rem;
        color: #dc2626;
        margin-top: 3px;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .btn {
        font-weight: 600;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .btn-secondary {
        background-color: #e5e7eb;
        color: #1f2937;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #d1d5db;
    }

    .btn-success {
        background-color: #16a34a; /* Verde un poco más oscuro al hacer hover */
        color: white;
    }

    .btn-success:hover {
        background-color: #2563eb;
    }

    .btn-group {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }
</style>

<div class="container-custom">
    <h3 class="title">Editar Empresa</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('empresa.update', $empresa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="empresa">Nombre de la Empresa:</label>
            <input type="text" name="empresa" id="empresa" class="form-control @error('empresa') is-invalid @enderror" value="{{ $empresa->empresa }}" required>
            @error('empresa') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="btn-group">
            <a href="{{ route('empresa.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Regresar</a>
            <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt me-1"></i> Actualizar</button>
        </div>
    </form>
</div>

@endsection