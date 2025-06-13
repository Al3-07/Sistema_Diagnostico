@extends('layouts.app')

@section('titulo', 'Bitácora del Sistema')
@section('contenido')
<style>
    /* Estilos base para móviles. */
    .bitacora-container {
        padding: 0 0.5rem;
    }
    
    /* Titulo de la tarjeta. */
    .bitacora-title {
        font-size: 1.5rem; /* Tamaño de la fuente. */
        margin-bottom: 1rem; /* Margen inferior. */
        font-weight: 600; /* Negrita. */
        color: #2c3e50; /* Color de texto. */
    }
    
    /* Tarjeta de la tarjeta. */
    .bitacora-card {
        border-radius: 0.75rem; /* Radio de la esquina del contenedor. */
        overflow: hidden; /* Desbordamiento. */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); /* Sombra. */
    }
    
    /* Header de la tarjeta. */
    .card-header {
        padding: 0.75rem 1rem; /* Margen. */
        font-size: 0.85rem; /* Tamaño de la fuente. */
    }
    
    /* Badge de la tarjeta. */
    .badge-count {
        font-size: 0.8rem; /* Tamaño de la fuente. */
        padding: 0.35rem 0.65rem;
    }
    
    /* Tabla de la tarjeta. */
    .table-responsive {
        overflow-x: auto; /* Desbordamiento. */
        -webkit-overflow-scrolling: touch; /* Desbordamiento. */
    }
    
    /* Tabla de la tarjeta. */
    .table {
        width: 100%; /* Ancho maximo. */
        margin-bottom: 0; /* Margen inferior. */
        font-size: 0.85rem; /* Tamaño de la fuente. */
    }
    
    /* Encabezado de la tabla. */
    .table thead {
        display: none; /* Desbordamiento. */
    }
    
    /* Cuerpo de la tabla. */
    .table tbody tr {   
        display: block; /* Desbordamiento. */
        margin-bottom: 1rem; /* Margen inferior. */
        border: 1px solid #e9ecef; /* Bordes del contenedor. */
        border-radius: 0.5rem; /* Radio de la esquina del contenedor. */
        padding: 0.75rem; /* Margen. */
    }
    
    /* Cuerpo de la tabla. */
    .table tbody tr td {
        display: flex; /* Flexbox. */
        justify-content: space-between; /* Justificacion. */
        align-items: center; /* Alineacion. */
        padding: 0.5rem; /* Margen. */
        border: none; /* Bordes del contenedor. */
        border-bottom: 1px solid #f1f1f1;
    }
    
    /* Cuerpo de la tabla. */
    .table tbody tr td:last-child {
        border-bottom: none; /* Bordes del contenedor. */
    }
    
    /* Cuerpo de la tabla. */
    .table tbody tr td::before {
        content: attr(data-label); /* Etiqueta. */
        font-weight: 600; /* Peso de la fuente. */
        color: #495057; /* Color de texto. */
        margin-right: 1rem; /* Margen. */
        flex: 0 0 40%; /* Radio de la esquina del contenedor. */
    }
    
    /* Badge de la tarjeta. */
    .badge-action {
        padding: 0.25rem 0.5rem; /* Margen. */
        font-size: 0.75rem; /* Tamaño de la fuente. */
        border-radius: 0.25rem; /* Radio de la esquina del contenedor. */
    }
    
    /* Footer de la tarjeta. */
    .card-footer {
        flex-direction: column; /* Flexbox. */
        align-items: center; /* Alineacion. */
        padding: 0.75rem; /* Margen. */
        font-size: 0.8rem; /* Tamaño de la fuente. */
    }
    
    /* Informacion de la paginacion. */
    .pagination-info {
        margin-bottom: 0.5rem; /* Margen. */
        text-align: center; /* Alineacion. */
    }
    
    /* Paginacion. */
    .pagination {
        flex-wrap: wrap; /* Flexbox. */
        justify-content: center; /* Alineacion. */
        margin: 0; /* Margen. */
    }
    
    /* Item de la paginacion. */
    .page-item {
        margin: 0.15rem; /* Margen. */
    }
    
    /* Link de la paginacion. */
    .page-link {
        padding: 0.3rem 0.6rem; /* Margen. */
        font-size: 0.8rem; /* Tamaño de la fuente. */
        border-radius: 0.25rem;
    }
    
    /* Estilos para tablets */
    @media (min-width: 768px) { /* Media query. */
        .bitacora-title {
            font-size: 1.75rem; /* Tamaño de la fuente. */
        }
        
        /* Encabezado de la tabla. */
        .table thead {
            display: table-header-group; /* Desbordamiento. */
        }
        
        /* Cuerpo de la tabla. */
        .table tbody tr {
            display: table-row; /* Desbordamiento. */
            margin-bottom: 0;
            border: none;
            border-radius: 0;
            padding: 0;
        }
        
        /* Cuerpo de la tabla. */
        .table tbody tr td {
            display: table-cell; /* Desbordamiento. */
            padding: 0.75rem; /* Margen. */
            border-bottom: 1px solid #e9ecef; /* Bordes del contenedor. */
        }
        
        /* Cuerpo de la tabla. */
        .table tbody tr td::before {
            display: none; /* Desbordamiento. */
        }
        
        /* Footer de la tarjeta. */
        .card-footer {
            flex-direction: row; /* Flexbox. */
            justify-content: space-between;
        }
        
        /* Informacion de la paginacion. */
        .pagination-info {
            margin-bottom: 0; /* Margen. */
            text-align: left; /* Alineacion. */
        }
    }
    
    /* Estilos para escritorio. */
    @media (min-width: 992px) {
        .bitacora-container {
            padding: 0 1.5rem; /* Margen. */
        }
        
        /* Header de la tarjeta. */
        .card-header {
            padding: 1rem 1.5rem;
        }
        
        /* Tabla de la tarjeta. */
        .table {
            font-size: 0.9rem; /* Tamaño de la fuente. */
        }
        
        /* Footer de la tarjeta. */
        .card-footer {
            padding: 1rem 1.5rem; /* Margen. */
        }
    }
</style>
 <!-- Formulario para la bitacora -->
<div class="bitacora-container">
    <h2 class="bitacora-title text-center">
        Bitácora del Sistema
    </h2>
        <!-- Tarjeta de la bitacora -->
    <div class="bitacora-card card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span class="badge badge-count bg-light text-primary">
                Mostrando {{ $bitacoras->count() }} de {{ $bitacoras->total() }} resultados
            </span>
        </div>
        <!-- Cuerpo de la tarjeta -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>    <!-- Encabezado de la tabla -->
                            <th scope="col">📅 Fecha</th>
                            <th scope="col">👤 Usuario</th>
                            <th scope="col">⚙️ Acción</th>
                            <th scope="col">📝 Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bitacoras as $log)
                            <tr>
                                <td data-label="📅 Fecha">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                <td data-label="👤 Usuario">{{ $log->user_id }}</td>
                                <td data-label="⚙️ Acción">
                                    <span class="badge bg-success badge-action">{{ $log->accion }}</span>
                                </td>
                                <td data-label="📝 Descripción">{{ $log->descripcion }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">No hay registros en la bitácora.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Footer de la tarjeta. -->
        <div class="card-footer bg-white border-top">
            <div class="pagination-info">
                Mostrando <strong>{{ $bitacoras->count() }}</strong> de <strong>{{ $bitacoras->total() }}</strong> registros — Página <strong>{{ $bitacoras->currentPage() }}</strong> de <strong>{{ $bitacoras->lastPage() }}</strong>
            </div>
            <!-- Paginación responsive. -->
            <ul class="pagination">
                <!-- Botón anterior. -->
                @if ($bitacoras->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $bitacoras->previousPageUrl() }}" aria-label="Anterior">
                            &laquo;
                        </a>
                    </li>
                @endif

                {{-- Páginas cercanas --}}
                @php
                    $start = max(1, $bitacoras->currentPage() - 2);
                    $end = min($bitacoras->lastPage(), $bitacoras->currentPage() + 2);
                    
                    if($start > 1) {
                        echo '<li class="page-item"><a class="page-link" href="'.$bitacoras->url(1).'">1</a></li>';
                        if($start > 2) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                    }
                    
                    for ($i = $start; $i <= $end; $i++) {
                        $active = $i == $bitacoras->currentPage() ? 'active' : '';
                        echo '<li class="page-item '.$active.'"><a class="page-link" href="'.$bitacoras->url($i).'">'.$i.'</a></li>';
                    }
                    
                    if($end < $bitacoras->lastPage()) {
                        if($end < $bitacoras->lastPage() - 1) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                        echo '<li class="page-item"><a class="page-link" href="'.$bitacoras->url($bitacoras->lastPage()).'">'.$bitacoras->lastPage().'</a></li>';
                    }
                @endphp

                {{-- Botón siguiente --}}
                @if ($bitacoras->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $bitacoras->nextPageUrl() }}" aria-label="Siguiente">
                            &raquo;
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&raquo;</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endsection