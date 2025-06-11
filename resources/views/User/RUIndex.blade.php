@extends('Layouts.app')

@section('titulo', 'User')

@section('contenido')
@include('sweetalert::alert')

<style>
    /* Estilos base (manteniendo tus estilos originales) */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }
    
    .container {
        max-width: 1240px;
        width: 100%;
        padding: 0 15px;
        margin: 0 auto;
    }
    
    .dataTables_filter {
        margin-bottom: 20px;
    }
    
    .dataTables_filter input {
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        width: 250px;
    }
    
    .dataTables_filter input:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
    }
    
    /* Tarjeta principal */
    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin: 1.5rem 0;
    }
    
    .card-title {
        color: #ffffff;
        font-weight: 600;
    }

    .card-header {
        background-color: rgb(27, 119, 211); 
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    /* Botones */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        font-size: 0.75rem;
    }
    
    .btn-info {
        background-color: #0ea5e9;
        border-color: #0ea5e9;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
        padding: 0.1rem 0.2rem;
        font-size: 0.95rem;
        border-radius: 8px;
    }
    
    .btn-info:hover {
        background-color: #0284c7;
        border-color: #0284c7;
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3);
        transform: translateY(-2px);
    }
    
    /* Tabla */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table {
        width: 100%;
        min-width: 600px;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table thead th {
        color: rgb(0, 0, 0);
        font-weight: 600;
        font-size: 0.875rem;
        padding: 12px;
        border-bottom: 1px solid #e2e8f0;
        background-color: rgb(172, 215, 255);
    }
    
    .table tbody td {
        padding: 12px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.875rem;
        color: #334155;
    }
    
    .table tbody tr:hover {
        background-color: rgb(218, 221, 224);
    }
    
    /* Columna de acciones */
    .acciones-columna {
        width: 120px;
        text-align: center;
    }

    .acciones-columna div {
        display: flex;
        justify-content: center;
        gap: 5px;
        flex-wrap: wrap;
    }
    
    /* Paginación */
    .dataTables_paginate .paginate_button {
        border-radius: 6px !important;
        margin: 0 2px !important;
    }
    
    .dataTables_paginate .paginate_button.current {
        background: #0ea5e9 !important;
        border-color: #0ea5e9 !important;
        color: white !important;
    }
    
    .dataTables_paginate .paginate_button:hover {
        background: #e2e8f0 !important;
        border-color: #e2e8f0 !important;
        color: #334155 !important;
    }
    
    .dataTables_info {
        color: #64748b;
        padding-top: 1rem;
    }

    /* Botón nuevo registro */
    .btn-nuevo-registro {
        background-color: #ffc107;
        border-color: #0ea5e9;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 0.75rem 1rem;
        font-size: 0.80rem;
        border-radius: 8px;
        min-width: 160px;
        text-align: center;
        width: 100%;
    }

    .btn-nuevo-registro:hover {
        background-color: rgb(255, 222, 122);
        border-color: #0284c7;
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3);
        transform: translateY(-2px);
    }

    /* Efectos hover */
    .btn-info:hover, .btn-warning:hover, .btn-danger:hover {
        color: #000000;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3);
    }

    .btn-warning {
        background-color: #f59e0b;
        border-color: #f59e0b;
        color: white;
    }

    .btn-danger {
        background-color: #ef4444;
        border-color: #ef4444;
        color: white;
    }

    /* Media queries para hacerlo responsive */
    @media (min-width: 576px) {
        .card-header {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
        
        .btn-nuevo-registro {
            width: auto;
        }
    }

    @media (max-width: 767px) {
        .container {
            padding: 0 10px;
        }
        
        .card-header {
            padding: 1rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .dataTables_filter input {
            width: 100%;
            max-width: 250px;
        }
        
        .table thead th,
        .table tbody td {
            padding: 8px 10px;
            font-size: 0.8rem;
        }
        
        .acciones-columna div {
            gap: 3px;
        }
    }

    @media (max-width: 400px) {
        .acciones-columna div {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<div class="container mt-3 mt-md-5">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title mb-0">
                <b>Registro de Usuarios</b>
            </h2>
            
            @if(Auth::user()->role !== 'Visualizador')
                <a href="{{ route('user.create') }}" class="btn btn-info btn-sm btn-nuevo-registro">
                    <i class="fas fa-plus"></i> Nuevo Registro
                </a>
            @endif
        </div>
        
        <div class="card-body p-3 p-md-4">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="users-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th class="acciones-columna text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('user.table') }}',
            responsive: true,
            autoWidth: false,
            columns: [
                {data: 'name', name: 'name'},
                {data: 'role', name: 'role'},
                {
                    data: 'acciones', 
                    name: 'acciones', 
                    orderable: false, 
                    searchable: false, 
                    className: 'acciones-columna',
                    responsivePriority: 1
                }
            ],
            language: {
                "processing": "Procesando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                "infoEmpty": "Mostrando 0 registros",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            initComplete: function() {
                $(this.api().table().container()).css('width', '100%');
            }
        });
    });
</script>
@endsection