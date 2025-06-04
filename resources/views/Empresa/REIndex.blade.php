@extends('layouts.app')

@section('titulo', 'Listado de Empresas')

@section('contenido')

@include('sweetalert::alert')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-header {
        background-color: rgb(226, 228, 230); 
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }

    .card-title {
        color: #344767;
        font-weight: 600;
    }

    .btn-nuevo-registro {
        background-color:  #16a34a; /* Verde un poco más oscuro al hacer hover */;
        border-color: #0ea5e9;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 0.75rem 1rem;
        font-size: 0.80rem;
        min-width: 160px;
        text-align: center;
    }

    .btn-nuevo-registro:hover {
        background-color:  #16a34a; /* Verde un poco más oscuro al hacer hover */;
        border-color: #0284c7;
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3);
        transform: translateY(-2px);
    }

    table.dataTable tbody tr {
        border-radius: 8px;
        transition: background 0.2s ease;
    }

    table.dataTable tbody tr:hover {
        background-color: #f1f5f9;
    }

    table.dataTable tbody td {
        padding: 12px 14px;
        font-size: 14px;
        vertical-align: middle;
    }

    table.dataTable thead th {
        background-color: #e2e8f0;
        color: #1f2937;
        font-weight: 700;
        font-size: 14px;
        padding: 12px 14px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table-responsive {
        overflow-x: auto;
        padding: 0 5px;
    }

    .table {
        width: 100%;
        table-layout: auto;
        word-wrap: break-word;
    }

    td,
    th {
        white-space: normal;
        word-break: break-word;
        max-width: 150px;
    }

    .acciones-columna {
        width: 200px !important;
        max-width: 200px !important;
        white-space: nowrap; /* Evita que el texto se divida en varias líneas */
    }
</style>

<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title mb-0">
                <b>Listado de Empresas</b>
            </h2>
            @if(Auth::user()->role !== 'Visualizador')  <!--Solo usuarios que no son 'Visualizador' pueden ver el botón  -->
            <a href="{{ route('empresa.create') }}" class="btn btn-info btn-sm btn-nuevo-registro">
                <i class="fas fa-plus"></i> Agregar Empresa
            </a>
            @endif
        </div>
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped w-100" id="empresas-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de la Empresa</th>
                            <th class="acciones-columna text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empresas as $empresa)
                            <tr>
                                <td>{{ $empresa->id }}</td>
                                <td>{{ $empresa->empresa }}</td>
                                <td class="text-center">
                                 @if(Auth::user()->role !== 'Visualizador')  <!--Solo usuarios que no son 'Visualizador' pueden ver el botón  -->
                                    <a href="{{ route('empresa.edit', $empresa->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('empresa.destroy', $empresa->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta empresa?')">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection