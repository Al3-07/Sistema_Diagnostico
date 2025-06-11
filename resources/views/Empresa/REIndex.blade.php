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
        background-color: rgb(27, 119, 211); 
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }

    .card-title {
        color: #ffffff;
        font-weight: 600;
    }

    .btn-nuevo-registro {
        background-color: #ffc107; /* Verde un poco más oscuro al hacer hover */;
        color: black;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 0.75rem 1rem;
        font-size: 0.80rem;
        min-width: 160px;
        text-align: center;
    }

    .btn-nuevo-registro:hover {
        background-color:rgb(255, 222, 122); /* Verde un poco más oscuro al hacer hover */;
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3);
        transform: translateY(-2px);
    }

    table.dataTable tbody tr {
        border-radius: 8px;
        transition: background 0.2s ease;
    }

    table.dataTable tbody tr:hover {
        background-color:rgb(218, 221, 224);
    }

    table.dataTable tbody td {
        padding: 12px 14px;
        font-size: 14px;
        vertical-align: middle;
    }

    table.dataTable thead th {
        background-color:rgb(172, 215, 255);
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

    /* Ajuste del contenedor de controles (buscador y length menu) */
    div.dataTables_wrapper div.dataTables_length,
    div.dataTables_wrapper div.dataTables_filter {
        margin-bottom: 20px;
    }

    div.dataTables_wrapper div.dataTables_filter {
        text-align: right !important;
    }

    div.dataTables_wrapper div.dataTables_length {
        text-align: left !important;
    }

    /* Opcional: Espaciado entre controles y tabla */
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length {
        padding: 0 10px;
    }

    /* Alinea bien los controles en pantallas pequeñas también */
    @media (max-width: 768px) {
        div.dataTables_wrapper div.dataTables_length,
        div.dataTables_wrapper div.dataTables_filter {
            text-align: center !important;
        }
    }

    @media (max-width: 768px) {
    .card-header .btn-nuevo-registro {
        width: 100%;
        text-align: center;
    }

    /* POR AQUI ME QUEDE DE MUJER :)*/
}
    
</style>

<div class="container mt-5">
    <div class="card">
                <div class="card-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h2 class="card-title mb-2 mb-md-0">
                    <b>Listado de Empresas</b>
                </h2>
                @if(Auth::user()->role !== 'Visualizador')
                <a href="{{ route('empresa.create') }}" class="btn btn-info btn-sm btn-nuevo-registro mt-2 mt-md-0">
                    <i class="fas fa-plus"></i> Agregar Empresa
                </a>
                @endif
            </div>
        </div>

        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success" id="mensaje-exito">
        {{ session('success') }}
    </div>
            @endif

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped w-100" id="empresas-table">
                    <thead>
    <tr>
        <th>Nombre de la Empresa</th>
        <th class="acciones-columna text-center">Acciones</th>
    </tr>
</thead>
<tbody>
    @foreach($empresas as $empresa)
        <tr>
            <td>{{ $empresa->empresa }}</td>
            <td class="text-center">
                @if(Auth::user()->role !== 'Visualizador')
                    <a href="{{ route('empresa.edit', $empresa->id) }}" class="btn btn-sm btn-warning" title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form id="form-eliminar-{{ $empresa->id }}" action="{{ route('empresa.destroy', $empresa->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger" title="Eliminar" onclick="confirmarEliminacion({{ $empresa->id }})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
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

<script>
    function confirmarEliminacion(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará la empresa del sistema.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-eliminar-' + id).submit();
            }
        });
    }


// Activar DataTable con búsqueda, selector de cantidad y paginación
    $(document).ready(function () {
        $('#empresas-table').DataTable({
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ empresas",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                },
                zeroRecords: "No se encontraron resultados",
                infoEmpty: "Mostrando 0 de 0 empresas",
                infoFiltered: "(filtrado de _MAX_ empresas en total)",
            },
            columnDefs: [
                { orderable: false, targets: 1 } // desactiva ordenamiento en columna de acciones
            ]
        });
    });

setTimeout(function() {
            let mensaje = document.getElementById('mensaje-exito');
            if (mensaje) {
                mensaje.style.transition = 'opacity 0.5s ease';
                mensaje.style.opacity = '0';
                setTimeout(() => mensaje.remove(), 500);
            }
        }, 3000); // 3000 milisegundos = 3 segundos</script>

@endsection