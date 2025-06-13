@extends('layouts.app')

@section('titulo', 'Editar Empresa')

@section('contenido')

@include('sweetalert::alert')

<style> /* Estilos base. */
    :root {
        --primary-color: #2563eb;
        --edit-color: #f59e0b; /* Naranja para acciones de edición. */
        --secondary-color: #16a34a; /* Verde para acciones secundarias. */
        --hover-color: #1e40af; /* Azul para acciones de hover. */
        --text-dark: #1f2937; /* Texto oscuro. */
        --text-light: #6b7280; /* Texto claro. */
        --light-bg: #f9fafb; /* Fondo claro. */
        --border-color: #e5e7eb; /* Color de borde. */
        --error-color: #dc2626;
        --success-color: #16a34a;   /* Verde para acciones de éxito. */
        --warning-bg: #fffbeb; /* Fondo para alertas de edición. */
    }
    /* Contenedor. */
    .edit-container {
        max-width: 850px; /* Ancho maximo. */
        margin: 2rem auto; /* Margen. */
        background: white; /* Fondo. */
        border-radius: 16px; /* Radio de la curva. */
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08); /* Sombra. */
        padding: 2.5rem; /* Margen. */
        border: 1px solid var(--border-color); /* Borde. */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transicion. */
        position: relative; /* Posicionamiento. */
        overflow: hidden; /* Desbordamiento. */
    }
    /* Fondo. */
    .edit-container::before {
        content: '';  /* Contenido. */
        position: absolute; /* Posicionamiento. */
        top: 0; /* Margen. */
        left: 0; /* Margen. */
        width: 5px; /* Ancho. */
        height: 100%; /* Altura. */
        background:rgb(146, 152, 155);
    }
    /* Responsive. */
    @media (min-width: 992px) {
        .edit-container { /* Contenedor. */
            margin-top: 100px; /* Margen. */
            margin-left: 200px; /* Margen. */
        }
    }
    /* Hover. */
    .edit-container:hover {
        transform: translateY(-2px); /* Transformacion. */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12); /* Sombra. */
    }
    /* Titulo. */
    .edit-title {   
        font-weight: 700; /* Peso de la fuente. */
        font-size: 1.8rem; /* Tamaño de la fuente. */
        text-align: center; /* Alineacion. */
        margin-bottom: 2rem; /* Margen inferior. */
        color: var(--text-dark); /* Color de texto oscuro. */
        position: relative; /* Posicionamiento. */  
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
    }
    /* Titulo. */
    .edit-title:after {
        content: ''; /* Contenido. */
        display: block; /* Desbordamiento. */
        width: 80px; /* Ancho. */
        height: 4px; /* Altura. */
        margin: 1rem auto 0; /* Margen. */
        border-radius: 2px; /* Radio de la curva. */
    }
    /* Badge. */
    .edit-badge {
        background-color: var(--edit-color); /* Color de fondo. */
        color: white; /* Color de texto oscuro. */
        padding: 0.3rem 0.8rem; /* Margen. */
        border-radius: 20px; /* Radio de la curva. */
        font-size: 0.8rem; /* Tamaño de la fuente. */
        font-weight: 600; /* Peso de la fuente. */
        display: inline-flex; /* Desbordamiento. */
        align-items: center; /* Alineacion. */
        gap: 0.3rem; /* Margen. */
    }

    label {
        font-weight: 600; /* Peso de la fuente. */
        font-size: 0.95rem; /* Tamaño de la fuente. */
        margin-bottom: 0.5rem; /* Margen inferior. */
        color: var(--text-dark); /* Color de texto oscuro. */
        display: block; /* Desbordamiento. */
    }
    /* Input. */
    .form-control {
        border-radius: 10px; /* Radio de la curva. */
        border: 1px solid var(--border-color); /* Borde. */
        padding: 0.75rem 1rem; /* Margen. */
        font-size: 1rem; /* Tamaño de la fuente. */
        color: var(--text-dark); /* Color de texto oscuro. */
        transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Transicion. */
        background-color: #f8fafc;
    }
    /* Focus. */
    .form-control:focus {
        border-color: var(--edit-color); /* Color de borde. */
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1); /* Sombra. */
        outline: none; /* Desbordamiento. */
        background-color: white; /* Color de fondo. */
    }
    /* Invalid. */
    .form-control.is-invalid {
        border-color: var(--error-color); /* Color de borde. */
    }
    /* Texto. */
    .text-danger {
        font-size: 0.8rem; /* Tamaño de la fuente. */
        color: var(--error-color); /* Color de texto oscuro. */
        margin-top: 0.5rem; /* Margen superior. */
        display: flex; /* Desbordamiento. */
        align-items: center; /* Alineacion. */
        gap: 0.3rem; /* Margen. */
    }
    /* Grupo. */
    .form-group {
        margin-bottom: 1.5rem; /* Margen inferior. */
    }
    /* Alerta. */
    .alert-warning {
        background-color: var(--warning-bg); /* Color de fondo. */
        color: #92400e; /* Color de texto oscuro. */
        border: 1px solid #fcd34d; /* Borde. */
        border-radius: 8px; /* Radio de la curva. */
        padding: 1rem; /* Margen. */
        margin-bottom: 1.5rem; /* Margen inferior. */
        display: flex; /* Desbordamiento. */
        align-items: center; /* Alineacion. */
        gap: 0.5rem;
    }

    .btn {
        font-weight: 600; /* Peso de la fuente. */
        padding: 0.625rem 1.5rem; /* Margen. */
        border-radius: 8px; /* Radio de la curva. */
        font-size: 0.9rem; /* Tamaño de la fuente. */
        transition: all 0.3s ease; /* Transicion. */
        display: inline-flex; /* Desbordamiento. */
        align-items: center; /* Alineacion. */
        gap: 0.5rem; /* Margen. */
        border: none; /* Borde. */
        cursor: pointer; /* Cursor. */
    }

    .btn-secondary {
        background-color: #e5e7eb; /* Color de fondo. */
        color: var(--text-dark); /* Color de texto oscuro. */
        border: 1px solid var(--border-color); /* Borde. */
    }

    .btn-secondary:hover { /* Hover. */ 
        background-color: #d1d5db;
        transform: translateY(-1px);
    }

    .btn-edit { /* Editar. */
        background-color: rgb(85, 122, 255);
        color: white;
    }

    .btn-edit:hover { /* Hover. */
        background-color: rgb(71, 154, 255);
        transform: translateY(-1px);
    }

    .buttons-container { /* Botones. */
        display: flex; /* Desbordamiento. */
        justify-content: space-between; /* Alineacion. */
        align-items: center; /* Alineacion. */
        margin-top: 2rem; /* Margen superior. */
        flex-wrap: wrap; /* Desbordamiento. */
        gap: 1rem; /* Margen. */
    }

    .edit-info { /* Informacion. */
        font-size: 0.85rem; /* Tamaño de la fuente. */
        color: var(--text-light); /* Color de texto oscuro. */
        display: flex; /* Desbordamiento. */
        align-items: center; /* Alineacion. */
        gap: 0.5rem; /* Margen. */
    }

    .buttons-group { /* Botones. */
    display: flex; /* Desbordamiento. */
    gap: 1rem; /* Margen. */
}

    /* Responsive adjustments. */
    @media (max-width: 768px) {
        .edit-container { /* Contenedor. */
            padding: 1.5rem; /* Margen. */
            margin: 1rem; /* Margen. */
            margin-top: 80px; /* Margen superior. */
            margin-left: 1rem; /* Margen. */
        }

        .edit-title { /* Titulo. */
            font-size: 1.5rem; /* Tamaño de la fuente. */
            flex-direction: column; /* Desbordamiento. */
            gap: 0.5rem; /* Margen. */
        }

        /* Agrega solo estas nuevas reglas para los botones. */
    .buttons-container {
        flex-direction: column-reverse; /* Desbordamiento. */
        gap: 1.5rem; /* Margen. */
    }
    
    .buttons-group { /* Botones. */
        width: 80%; /* Ancho maximo. */
        flex-direction: column; /* Desbordamiento. */
        gap: 0.75rem; /* Margen. */
    }
    
    .buttons-group .btn { /* Botones. */
        width: 100%; /* Ancho maximo. */
    }
    
    .edit-info { /* Informacion. */
        width: 100%; /* Ancho maximo. */
        justify-content: center; /* Alineacion. */
        text-align: center; /* Alineacion. */
        margin-bottom: 0.5rem; /* Margen inferior. */
    }
}
   

    @media (max-width: 576px) { /* Responsive adjustments. */
        .edit-container {
            padding: 1.25rem; /* Margen. */
        }

        .form-control {
            padding: 0.65rem 0.9rem;
        }
    }
</style>
<!-- Formulario de edicion. -->
<div class="edit-container">
    <h3 class="edit-title">
        <span>Editar Empresa</span>
        <span class="edit-badge">
            <i class="fas fa-edit"></i> Modo Edición
        </span>
    </h3>
    <!-- Alertas. -->
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

    <form action="{{ route('empresa.update', $empresa->id) }}" method="POST">   <!-- Formulario de edicion. -->
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

        <div class="buttons-container"> <!-- Botones. -->
            <div class="edit-info"> <!-- Informacion. -->
                <i class="fas fa-info-circle"></i>
                <span>Registro creado el {{ $empresa->created_at->format('d/m/Y') }}</span>
            </div>
            
            <div class="buttons-group"> <!-- Botones. -->
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