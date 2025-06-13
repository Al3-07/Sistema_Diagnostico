@extends('Layouts.app')

@section('titulo', 'User')

@section('contenido')
@include('sweetalert::alert')

<style>
    /* Estilos base (manteniendo tus estilos originales). */
    body {
        font-family: 'Poppins', sans-serif; /* Fin del font-family. */
        background-color: #f8f9fa; /* Fin del background-color. */
    }
    
    .container {
        max-width: 1240px; /* Fin del max-width. */
        width: 100%; /* Fin del width. */
        padding: 0 15px; /* Fin del padding. */
        margin: 0 auto; /* Fin del margin. */
    }
    
    .dataTables_filter {
        margin-bottom: 20px; /* Fin del margin-bottom. */
    }
    
    .dataTables_filter input {
        border: 1px solid #e2e8f0; /* Fin del border. */
        border-radius: 6px; /* Fin del border-radius. */
        padding: 0.5rem 1rem; /* Fin del padding. */
        width: 250px; /* Fin del width. */
    }
    
    .dataTables_filter input:focus {
        border-color: #3b82f6; /* Fin del border-color. */
        outline: none; /* Fin del outline. */
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25); /* Fin del box-shadow. */
    }
    
    /* Tarjeta principal */
    .card {
        border-radius: 12px; /* Fin del border-radius. */
        border: none; /* Fin del border. */
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08); /* Fin del box-shadow. */
        overflow: hidden; /* Fin del overflow. */
        margin: 1.5rem 0; /* Fin del margin. */
    }
    
    .card-title {
        color: #ffffff; /* Fin del color. */
        font-weight: 600; /* Fin del font-weight. */
    }

    .card-header {
        background-color: rgb(27, 119, 211); /* Fin del background-color. */
        border-bottom: 1px solid rgba(0, 0, 0, 0.05); /* Fin del border-bottom. */
        padding: 1.5rem; /* Fin del padding. */
        display: flex; /* Fin del display. */
        flex-direction: column; /* Fin del flex-direction. */
        align-items: flex-start; /* Fin del align-items. */
        gap: 1rem; /* Fin del gap. */
    }

    /* Botones */
    .btn-sm {
        padding: 0.25rem 0.5rem; /* Fin del padding. */
        border-radius: 6px; /* Fin del border-radius. */
        font-size: 0.75rem; /* Fin del font-size. */
    }
    
    .btn-info {
        background-color: #0ea5e9; /* Fin del background-color. */
        border-color: #0ea5e9; /* Fin del border-color. */
        color: white; /* Fin del color. */
        font-weight: 500; /* Fin del font-weight. */
        transition: all 0.3s ease; /* Fin del transition. */
        padding: 0.1rem 0.2rem; /* Fin del padding. */
        font-size: 0.95rem; /* Fin del font-size. */
        border-radius: 8px; /* Fin del border-radius. */
    }
    
    .btn-info:hover {
        background-color: #0284c7; /* Fin del background-color. */
        border-color: #0284c7; /* Fin del border-color. */
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3); /* Fin del box-shadow. */
        transform: translateY(-2px); /* Fin del transform. */
    }
    
    /* Tabla. */
    .table-responsive {
        width: 100%; /* Fin del width. */
        overflow-x: auto; /* Fin del overflow-x. */
        -webkit-overflow-scrolling: touch; /* Fin del -webkit-overflow-scrolling. */
    }

    .table {
        width: 100%; /* Fin del width. */
        min-width: 600px; /* Fin del min-width. */
        border-collapse: separate; /* Fin del border-collapse. */
        border-spacing: 0; /* Fin del border-spacing. */
    }
    
    .table thead th {
        color: rgb(0, 0, 0); /* Fin del color. */
        font-weight: 600; /* Fin del font-weight. */
        font-size: 0.875rem; /* Fin del font-size. */
        padding: 12px; /* Fin del padding. */
        border-bottom: 1px solid #e2e8f0; /* Fin del border-bottom. */
        background-color: rgb(172, 215, 255); /* Fin del background-color. */
    }
    
    .table tbody td {
        padding: 12px; /* Fin del padding. */
        vertical-align: middle; /* Fin del vertical-align. */
        border-bottom: 1px solid #f1f5f9; /* Fin del border-bottom. */
        font-size: 0.875rem; /* Fin del font-size. */
        color: #334155; /* Fin del color. */
    }
    
    .table tbody tr:hover {
        background-color: rgb(218, 221, 224); /* Fin del background-color. */
    }
    
    /* Columna de acciones. */
    .acciones-columna {
        width: 120px; /* Fin del width. */
        text-align: center; /* Fin del text-align. */
    }

    .acciones-columna div {
        display: flex; /* Fin del display. */
        justify-content: center; /* Fin del justify-content. */
        gap: 5px; /* Fin del gap. */
        flex-wrap: wrap; /* Fin del flex-wrap. */
    }
    
    /* Paginación. */
    .dataTables_paginate .paginate_button {
        border-radius: 6px !important; /* Fin del border-radius. */
        margin: 0 2px !important; /* Fin del margin. */
    }
    
    .dataTables_paginate .paginate_button.current {
        background: #0ea5e9 !important; /* Fin del background. */
        border-color: #0ea5e9 !important; /* Fin del border-color. */
        color: white !important; /* Fin del color. */
    }
    
    .dataTables_paginate .paginate_button:hover {
        background: #e2e8f0 !important; /* Fin del background. */
        border-color: #e2e8f0 !important; /* Fin del border-color. */
        color: #334155 !important; /* Fin del color. */
    }
    
    .dataTables_info {
        color: #64748b; /* Fin del color. */
        padding-top: 1rem; /* Fin del padding-top. */
    }

    /* Botón nuevo registro. */
    .btn-nuevo-registro {
        background-color: #ffc107; /* Fin del background-color. */
        border-color: #0ea5e9; /* Fin del border-color. */
        color: white; /* Fin del color. */
        font-weight: 600; /* Fin del font-weight. */
        transition: all 0.3s ease; /* Fin del transition. */
        padding: 0.75rem 1rem; /* Fin del padding. */
        font-size: 0.80rem; /* Fin del font-size. */
        border-radius: 8px; /* Fin del border-radius. */
        min-width: 160px; /* Fin del min-width. */
        text-align: center; /* Fin del text-align. */
        width: 100%; /* Fin del width. */
    }

    .btn-nuevo-registro:hover {
        background-color: rgb(255, 222, 122); /* Fin del background-color. */
        border-color: #0284c7; /* Fin del border-color. */
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3); /* Fin del box-shadow. */
        transform: translateY(-2px); /* Fin del transform. */
    }

    /* Efectos hover. */
    .btn-info:hover, .btn-warning:hover, .btn-danger:hover {
        color: #000000; /* Fin del color. */
        transform: translateY(-2px); /* Fin del transform. */
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3); /* Fin del box-shadow. */
    }

    .btn-warning {
        background-color: #f59e0b; /* Fin del background-color. */
        border-color: #f59e0b; /* Fin del border-color. */
        color: white; /* Fin del color. */
    }

    .btn-danger {
        background-color: #ef4444; /* Fin del background-color. */
        border-color: #ef4444; /* Fin del border-color. */
        color: white; /* Fin del color. */
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
            padding: 0 10px; /* Fin del padding. */
        }
        
        .card-header {
            padding: 1rem; /* Fin del padding. */
        }
        
        .card-body {
            padding: 1rem; /* Fin del padding. */
        }
        
        .dataTables_filter input {
            width: 100%; /* Fin del width. */
            max-width: 250px; /* Fin del max-width. */
        }
        
        .table thead th,
        .table tbody td {
            padding: 8px 10px; /* Fin del padding. */
            font-size: 0.8rem; /* Fin del font-size. */
        }
        
        .acciones-columna div {
            gap: 3px; /* Fin del gap. */
        }
    }

    @media (max-width: 400px) {
        .acciones-columna div { /* Fin del acciones-columna div. */
            flex-direction: column; /* Fin del flex-direction. */
            align-items: center; /* Fin del align-items. */
        }
    }
</style>
<!-- Formulario para crear el usuario. -->
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
            <!-- Tabla de usuarios. -->
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

<!-- Script para la tabla de usuarios. -->
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