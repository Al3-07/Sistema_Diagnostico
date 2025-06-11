@extends('layouts.app')

@section('titulo', 'Editar Empresa')

@section('contenido')

@include('sweetalert::alert')

<style>
    :root {
        --primary-color: #2563eb;
        --edit-color: #f59e0b; /* Naranja para acciones de edición */
        --secondary-color: #16a34a;
        --hover-color: #1e40af;
        --text-dark: #1f2937;
        --text-light: #6b7280;
        --light-bg: #f9fafb;
        --border-color: #e5e7eb;
        --error-color: #dc2626;
        --success-color: #16a34a;
        --warning-bg: #fffbeb; /* Fondo para alertas de edición */
    }
    
    .edit-container {
        max-width: 850px;
        margin: 2rem auto;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        padding: 2.5rem;
        border: 1px solid var(--border-color);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .edit-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background:rgb(146, 152, 155);
    }

    @media (min-width: 992px) {
        .edit-container {
            margin-top: 100px;
            margin-left: 200px;
        }
    }

    .edit-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }

    .edit-title {
        font-weight: 700;
        font-size: 1.8rem;
        text-align: center;
        margin-bottom: 2rem;
        color: var(--text-dark);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
    }

    .edit-title:after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        margin: 1rem auto 0;
        border-radius: 2px;
    }

    .edit-badge {
        background-color: var(--edit-color);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    label {
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
        display: block;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid var(--border-color);
        padding: 0.75rem 1rem;
        font-size: 1rem;
        color: var(--text-dark);
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        background-color: #f8fafc;
    }

    .form-control:focus {
        border-color: var(--edit-color);
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        outline: none;
        background-color: white;
    }

    .form-control.is-invalid {
        border-color: var(--error-color);
    }

    .text-danger {
        font-size: 0.8rem;
        color: var(--error-color);
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .alert-warning {
        background-color: var(--warning-bg);
        color: #92400e;
        border: 1px solid #fcd34d;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn {
        font-weight: 600;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
    }

    .btn-secondary {
        background-color: #e5e7eb;
        color: var(--text-dark);
        border: 1px solid var(--border-color);
    }

    .btn-secondary:hover {
        background-color: #d1d5db;
        transform: translateY(-1px);
    }

    .btn-edit {
        background-color: rgb(85, 122, 255);
        color: white;
    }

    .btn-edit:hover {
        background-color: rgb(71, 154, 255);
        transform: translateY(-1px);
    }

    .buttons-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .edit-info {
        font-size: 0.85rem;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .buttons-group {
    display: flex;
    gap: 1rem;
}

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .edit-container {
            padding: 1.5rem;
            margin: 1rem;
            margin-top: 80px;
            margin-left: 1rem;
        }

        .edit-title {
            font-size: 1.5rem;
            flex-direction: column;
            gap: 0.5rem;
        }

        /* Agrega solo estas nuevas reglas para los botones */
    .buttons-container {
        flex-direction: column-reverse;
        gap: 1.5rem;
    }
    
    .buttons-group {
        width: 80%;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .buttons-group .btn {
        width: 100%;
    }
    
    .edit-info {
        width: 100%;
        justify-content: center;
        text-align: center;
        margin-bottom: 0.5rem;
    }
}
   

    @media (max-width: 576px) {
        .edit-container {
            padding: 1.25rem;
        }

        .form-control {
            padding: 0.65rem 0.9rem;
        }
    }
</style>

<div class="edit-container">
    <h3 class="edit-title">
        <span>Editar Empresa</span>
        <span class="edit-badge">
            <i class="fas fa-edit"></i> Modo Edición
        </span>
    </h3>

    @if(session('warning'))
        <div class="alert-warning">
            <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('empresa.update', $empresa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="empresa">Nombre de la Empresa</label>
            <input type="text" name="empresa" id="empresa" 
                   class="form-control @error('empresa') is-invalid @enderror" 
                   value="{{ old('empresa', $empresa->empresa) }}" 
                   placeholder="Ingrese el nuevo nombre" required>
            @error('empresa') 
                <span class="text-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </span> 
            @enderror
        </div>

        <div class="buttons-container">
            <div class="edit-info">
                <i class="fas fa-info-circle"></i>
                <span>Registro creado el {{ $empresa->created_at->format('d/m/Y') }}</span>
            </div>
            
            <div class="buttons-group">
                <a href="{{ route('empresa.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-edit">
                    <i class="fas fa-save"></i> Actualizar
                </button>
            </div>
        </div>
    </form>
</div>

@endsection