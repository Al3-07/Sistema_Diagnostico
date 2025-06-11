@extends('Layouts.app')

@section('titulo', 'Gestión de Diagnósticos de Equipos')

@section('contenido')

@include('sweetalert::alert')

<style>
    /* Estilos base */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .diagnosticos-container {
        max-width: 100%;
        padding: 0 15px;
    }

    .diagnosticos-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 30px;
    }

    /* Header de la tarjeta */
    .card-header-diagnosticos {
        background-color: rgb(27, 119, 211);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .card-title-diagnosticos {
        color: #ffffff;
        font-weight: 600;
        margin: 0;
        font-size: 1.5rem;
    }

    .btn-nuevo-diagnostico {
        background-color: #ffc107;
        color: #212529;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 0.75rem 1.25rem;
        font-size: 0.85rem;
        min-width: 160px;
        border: none;
        border-radius: 6px;
    }

    .btn-nuevo-diagnostico:hover {
        background-color: rgb(255, 222, 122);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Estructura de la tabla - Versión escritorio */
    .table-container {
        padding: 1.5rem;
        width: 100%;
    }

    #equipos-table {
        width: 100% !important;
        margin: 0 auto;
        border-collapse: collapse;
    }

    #equipos-table thead th {
        background-color: rgb(172, 215, 255);
        color: #1f2937;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.75rem 0.5rem;
        text-align: center;
        vertical-align: middle;
        position: sticky;
        top: 0;
    }

    #equipos-table tbody td {
        padding: 0.75rem 0.5rem;
        font-size: 0.85rem;
        vertical-align: middle;
        border-top: 1px solid #e9ecef;
        text-align: center;
        word-break: break-word; /* Ajuste de texto importante */
    }

    #equipos-table tbody tr:hover {
        background-color: rgba(218, 221, 224, 0.5);
    }

    /* Imágenes */
    .img-table {
        width: 60px;
        height: 45px;
        border-radius: 4px;
        object-fit: cover;
        box-shadow: 0 0 3px rgba(0,0,0,0.1);
        max-width: 100%;
    }

    /* Controles DataTables */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        padding: 0.5rem 1rem;
    }

    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5em;
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 0.25rem 0.5rem;
    }

    /* Versión móvil - Solo aquí activamos scroll horizontal */
    @media (max-width: 768px) {
        .table-container {
            padding: 1rem 0;
            overflow-x: auto; /* Scroll solo en móviles */
            -webkit-overflow-scrolling: touch;
        }
        
        .card-header-diagnosticos {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .btn-nuevo-diagnostico {
            width: 100%;
            margin-top: 1rem;
        }
        
        #equipos-table {
            width: max-content !important; /* Fuerza el ancho según contenido */
            min-width: 100%;
        }
        
        #equipos-table thead th,
        #equipos-table tbody td {
            padding: 0.5rem 0.3rem;
            font-size: 0.8rem;
            white-space: nowrap; /* Evita saltos de línea */
        }
        
        .img-table {
            width: 50px;
            height: 40px;
        }
        
    }

     /* Ajustes para las columnas específicas */
    #equipos-table th:nth-child(1), /* Fecha - primera columna */
    #equipos-table td:nth-child(1) {
        width: 85px; /* Más ancha */
        min-width: 85px;
        max-width: 85px;
    }
    
    #equipos-table th:nth-child(2), /* Empresa - segunda columna */
    #equipos-table td:nth-child(2) {
        width: 120px; /* Más angosta */
        min-width: 120px;
        max-width: 120px;
    }
    
    /* Versión móvil */
    @media (max-width: 768px) {
        #equipos-table th:nth-child(1),
        #equipos-table td:nth-child(1) {
            width: 150px; /* Fecha sigue siendo más ancha */
            min-width: 150px;
            max-width: 150px;
        }
        
        #equipos-table th:nth-child(2),
        #equipos-table td:nth-child(2) {
            width: 100px; /* Empresa más angosta */
            min-width: 100px;
            max-width: 100px;
        }
    }
    
</style>

<div class="diagnosticos-container">
    <div class="diagnosticos-card">
        <div class="card-header-diagnosticos">
            <h2 class="card-title-diagnosticos">
                <b>Diagnósticos de Equipos</b>
            </h2>
            @if(Auth::user()->role !== 'Visualizador')
                <a href="{{ route('registrodiagnostico.create') }}" class="btn btn-nuevo-diagnostico">
                    <i class="fas fa-plus"></i> Nuevo Diagnóstico
                </a>
            @endif
        </div>
        
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="equipos-table">
                    <thead>
                        <tr>
                            <th class="columna-fecha">Fecha</th>
                            <th class="columna-empresa">Empresa</th>
                            <th class="columna-hardware">Hardware</th>
                            <th class="columna-modelo">Modelo</th>
                            <th class="columna-marca">Marca</th>
                            <th class="columna-serie">Serie</th>
                            <th class="columna-descripcion">Descripción</th>
                            <th class="columna-estado">Estado</th>
                            <th class="columna-imagen">Inicial</th>
                            <th class="columna-imagen">Final</th>
                            <th class="columna-acciones">Acciones</th>
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
        $('#equipos-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('registrodiagnostico.table') }}',
            columns: [
                { 
                    data: 'fecha', 
                    name: 'fecha',
                    className: 'columna-fecha'
                },
                { 
                    data: 'empresa', 
                    name: 'empresa',
                    className: 'columna-empresa'
                },
                { 
                    data: 'equipo', 
                    name: 'equipo',
                    className: 'columna-hardware'
                },
                { 
                    data: 'modelo', 
                    name: 'modelo',
                    className: 'columna-modelo'
                },
                { 
                    data: 'marca', 
                    name: 'marca',
                    className: 'columna-marca'
                },
                { 
                    data: 'serie', 
                    name: 'serie',
                    className: 'columna-serie'
                },
                {
                    data: 'descripcion',
                    name: 'descripcion',
                    className: 'columna-descripcion',
                    render: function(data) {
                        return data ? `<div class="descripcion-celda" title="${data}">${data}</div>` : '';
                    }
                },
                { 
                    data: 'estado', 
                    name: 'estado',
                    className: 'columna-estado'
                },
                {
                    data: 'foto_antes',
                    name: 'foto_antes',
                    className: 'columna-imagen',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return data ? `<img src="{{ asset('img/post') }}/${data}" class="img-table" alt="Foto Antes">` : '';
                    }
                },
                {
                    data: 'foto_despues',
                    name: 'foto_despues',
                    className: 'columna-imagen',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return data ? `<img src="{{ asset('img/post') }}/${data}" class="img-table" alt="Foto Después">` : '';
                    }
                },
                {
                    data: 'acciones',
                    name: 'acciones',
                    className: 'columna-acciones',
                    orderable: false,
                    searchable: false
                }
            ],
            language: {
                "processing": "Procesando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            autoWidth: false,
            scrollX: false,
            responsive: true
        });
    });
</script>

<script>
    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');
        var url = "{{ url('registrodiagnostico') }}/" + id;

        Swal.fire({
            title: '¿Estás seguro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        $('#equipos-table').DataTable().ajax.reload(null, false);
                        Swal.fire('¡Eliminado!', 'El diagnóstico ha sido eliminado.', 'success');
                    },
                    error: function (xhr) {
                        Swal.fire('Error', 'No se pudo eliminar el diagnóstico.', 'error');
                    }
                });
            }
        });
    });
</script>

@endsection