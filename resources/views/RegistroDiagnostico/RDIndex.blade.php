@extends('Layouts.app')

@section('titulo', 'Gestión de Diagnósticos de Equipos')

@section('contenido')

@include('sweetalert::alert')

<style> /*CSS estilo del titulo, texto, tabla y botones.*/
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
        border-radius: 8px;
        min-width: 160px;
        text-align: center;
    }

    .btn-nuevo-registro:hover {
        background-color:  #16a34a; /* Verde un poco más oscuro al hacer hover. */;
        border-color: #16a34a;
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3);
        transform: translateY(-2px);
    }

    /* Muestra el diseño de la tabla.*/
    .img-table {
        max-width: 60px;
        max-height: 50px;
        border-radius: 6px;
        object-fit: cover;
        box-shadow: 0 0 3px rgba(0,0,0,0.15);
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


    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        padding: 10px;
        margin-bottom: 20px;
    }

    .datatable-controls {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 20px;
        padding: 0 10px;
    }

    .datatable-controls .dataTables_length,
    .datatable-controls .dataTables_filter {
        margin-bottom: 10px;
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

    .descripcion-celda {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 13px;
        max-width: 200px;
    }
</style>

    <!-- Vista los datos del Index. -->
<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
    <h2 class="card-title mb-0">
        <b>Diagnósticos de Equipos</b>
    </h2>
    <!-- Muestra nombre del usuario y boton de nuevo registro. -->
    @if(Auth::user()->role !== 'Visualizador')
        <a href="{{ route('registrodiagnostico.create') }}" class="btn btn-info btn-sm btn-nuevo-registro">
            <i class="fas fa-plus"></i> Nuevo Diagnóstico
        </a>
    @endif
</div>
            <!-- Campos de la tabla. -->
        <div class="card-body p-4">
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped w-100" id="equipos-table">
                    <thead>
                        <tr>
                             <th>Empresa</th>
                            <th>Hardware</th>
                            <th>Modelo</th>
                            <th>Marca</th>
                            <th>Serie</th>
                            <th>Descripción</th>
                             <th>Estado</th>
                            <th>Imagen Inicial</th>
                            <th>Imagen Final</th>
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
    <!-- Funcionalidad de la tabla con sus campos. -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#equipos-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('registrodiagnostico.table') }}',
            columns: [
                 { data: 'empresa', name: 'empresa' },
                { data: 'equipo', name: 'equipo' },
                { data: 'modelo', name: 'modelo' },
                { data: 'marca', name: 'marca' },
                { data: 'serie', name: 'serie' },
{
    data: 'descripcion',
    name: 'descripcion',
    render: function(data) {
        if (!data) return '';
        return `<div class="descripcion-celda" title="${data}">${data}</div>`;
    }
},
                 { data: 'estado', name: 'estado' },
                {
                    data: 'foto_antes',
                    name: 'foto_antes',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        if(data) {
                            return '<img src="{{ asset("img/post") }}/' + data + '" class="img-table" alt="Foto Antes">';
                        }
                        return '';
                    }
                },
                {
                    data: 'foto_despues',
                    name: 'foto_despues',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        if(data) {
                            return '<img src="{{ asset("img/post") }}/' + data + '" class="img-table" alt="Foto Después">';
                        }
                        return '';
                    }
                },
                {
                    data: 'acciones',
                    name: 'acciones',
                    orderable: false,
                    searchable: false,
                    className: 'acciones-columna'
                }
            ],//Muestra de traductor de idioma en los campos.
            language: {
                "processing": "Procesando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
</script>

</script>
<script>
    // Delegamos evento a los botones con clase .delete-btn mensaje de error.
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
