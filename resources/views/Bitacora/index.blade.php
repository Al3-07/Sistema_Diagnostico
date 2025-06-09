@extends('layouts.app')

@section('titulo', 'Bitácora del Sistema')
@section('contenido')
<div class="container mt-0">
<h2 class="mb-4 text-center w-100" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    Bitácora del Sistema
</h2>
    <div class="card shadow-lg rounded-4 border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
            <span class="badge bg-light text-primary">Mostrando {{ $bitacoras->count() }} de {{ $bitacoras->total() }} resultados</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle text-center">
                    <thead class="bg-primary text-white">
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
                                <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $log->user_id }}</td>
                                <td><span class="badge bg-success text-white">{{ $log->accion }}</span></td>
                                <td>{{ $log->descripcion }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">No hay registros en la bitácora.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer px-4 py-2 bg-white border-top d-flex justify-content-between align-items-center" style="font-size: 0.85rem;">
            <span class="text-muted">
                Mostrando <strong>{{ $bitacoras->count() }}</strong> de <strong>{{ $bitacoras->total() }}</strong> registros — Página <strong>{{ $bitacoras->currentPage() }}</strong> de <strong>{{ $bitacoras->lastPage() }}</strong>
            </span>

            {{-- Paginación compacta --}}
            <div>
                <ul class="pagination pagination-sm mb-0">
                    {{-- Botón anterior --}}
                    @if ($bitacoras->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">«</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $bitacoras->previousPageUrl() }}">«</a></li>
                    @endif

                    {{-- Páginas --}}
                    @for ($i = 1; $i <= $bitacoras->lastPage(); $i++)
                        <li class="page-item {{ $i == $bitacoras->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $bitacoras->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Botón siguiente --}}
                    @if ($bitacoras->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $bitacoras->nextPageUrl() }}">»</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">»</span></li>
                    @endif
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection
