@extends('layouts.app')

@section('titulo', 'Bitácora del Sistema')
@section('contenido')
<style>
    /* Estilos base para móviles */
    .bitacora-container {
        padding: 0 0.5rem;
    }
    
    .bitacora-title {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
        color: #2c3e50;
    }
    
    .bitacora-card {
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .card-header {
        padding: 0.75rem 1rem;
        font-size: 0.85rem;
    }
    
    .badge-count {
        font-size: 0.8rem;
        padding: 0.35rem 0.65rem;
    }
    
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .table {
        width: 100%;
        margin-bottom: 0;
        font-size: 0.85rem;
    }
    
    .table thead {
        display: none;
    }
    
    .table tbody tr {
        display: block;
        margin-bottom: 1rem;
        border: 1px solid #e9ecef;
        border-radius: 0.5rem;
        padding: 0.75rem;
    }
    
    .table tbody tr td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem;
        border: none;
        border-bottom: 1px solid #f1f1f1;
    }
    
    .table tbody tr td:last-child {
        border-bottom: none;
    }
    
    .table tbody tr td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #495057;
        margin-right: 1rem;
        flex: 0 0 40%;
    }
    
    .badge-action {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        border-radius: 0.25rem;
    }
    
    .card-footer {
        flex-direction: column;
        align-items: center;
        padding: 0.75rem;
        font-size: 0.8rem;
    }
    
    .pagination-info {
        margin-bottom: 0.5rem;
        text-align: center;
    }
    
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
        margin: 0;
    }
    
    .page-item {
        margin: 0.15rem;
    }
    
    .page-link {
        padding: 0.3rem 0.6rem;
        font-size: 0.8rem;
        border-radius: 0.25rem;
    }
    
    /* Estilos para tablets */
    @media (min-width: 768px) {
        .bitacora-title {
            font-size: 1.75rem;
        }
        
        .table thead {
            display: table-header-group;
        }
        
        .table tbody tr {
            display: table-row;
            margin-bottom: 0;
            border: none;
            border-radius: 0;
            padding: 0;
        }
        
        .table tbody tr td {
            display: table-cell;
            padding: 0.75rem;
            border-bottom: 1px solid #e9ecef;
        }
        
        .table tbody tr td::before {
            display: none;
        }
        
        .card-footer {
            flex-direction: row;
            justify-content: space-between;
        }
        
        .pagination-info {
            margin-bottom: 0;
            text-align: left;
        }
    }
    
    /* Estilos para escritorio */
    @media (min-width: 992px) {
        .bitacora-container {
            padding: 0 1.5rem;
        }
        
        .card-header {
            padding: 1rem 1.5rem;
        }
        
        .table {
            font-size: 0.9rem;
        }
        
        .card-footer {
            padding: 1rem 1.5rem;
        }
    }
</style>

<div class="bitacora-container">
    <h2 class="bitacora-title text-center">
        Bitácora del Sistema
    </h2>
    
    <div class="bitacora-card card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span class="badge badge-count bg-light text-primary">
                Mostrando {{ $bitacoras->count() }} de {{ $bitacoras->total() }} resultados
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
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

        <div class="card-footer bg-white border-top">
            <div class="pagination-info">
                Mostrando <strong>{{ $bitacoras->count() }}</strong> de <strong>{{ $bitacoras->total() }}</strong> registros — Página <strong>{{ $bitacoras->currentPage() }}</strong> de <strong>{{ $bitacoras->lastPage() }}</strong>
            </div>

            {{-- Paginación responsive --}}
            <ul class="pagination">
                {{-- Botón anterior --}}
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