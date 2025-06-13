@extends('layouts.app')

@section('titulo', 'Listado de Empresas')

@section('contenido')

@include('sweetalert::alert')

<style> /* Estilos base. */     
    body {
        font-family: 'Poppins', sans-serif; /* Tipo de fuente. */
        background-color: #f8f9fa; /* Color de fondo. */
    }

    .card {
        border-radius: 12px; /* Radio de la curva. */
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-header {
        background-color: rgb(27, 119, 211); /* Color de fondo. */ 
        border-bottom: 1px solid rgba(0, 0, 0, 0.05); /* Borde. */
        padding: 1.5rem; /* Margen. */
    }

    .card-title {
        color: #ffffff;
        font-weight: 600;
    }

    .btn-nuevo-registro {
        background-color: #ffc107; /* Verde un poco más oscuro al hacer hover. */
        color: black; /* Color de texto oscuro. */
        font-weight: 600; /* Peso de la fuente. */
        transition: all 0.3s ease; /* Transicion. */
        padding: 0.75rem 1rem; /* Margen. */
        font-size: 0.80rem; /* Tamaño de la fuente. */
        min-width: 160px; /* Ancho minimo. */
        text-align: center;
    }

    .btn-nuevo-registro:hover {
        background-color:rgb(255, 222, 122); /* Verde un poco más oscuro al hacer hover. */
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3);  /* Sombra. */
        transform: translateY(-2px); /* Transformacion. */
    }

    table.dataTable tbody tr {
        border-radius: 8px; /* Radio de la curva. */
        transition: background 0.2s ease;
    }

    table.dataTable tbody tr:hover {
        background-color:rgb(218, 221, 224); /* Color de fondo. */
    }

    table.dataTable tbody td {
        padding: 12px 14px;
        font-size: 14px;
        vertical-align: middle;
    }

    table.dataTable thead th {
        background-color:rgb(172, 215, 255); /* Color de fondo. */
        color: #1f2937; /* Color de texto oscuro. */
        font-weight: 700; /* Peso de la fuente. */
        font-size: 14px; /* Tamaño de la fuente. */
        padding: 12px 14px; /* Margen. */
        text-align: center; /* Alineacion. */
        vertical-align: middle;
        white-space: nowrap;
    }

    .table-responsive {
        overflow-x: auto; /* Desbordamiento. */
        padding: 0 5px; /* Margen. */
    }

    .table {
        width: 100%; /* Ancho. */
        table-layout: auto; /* Radio de la curva. */
        word-wrap: break-word; /* Desbordamiento. */
    }

    td,
    th {
        white-space: normal;     /* Desbordamiento. */
        word-break: break-word; /* Desbordamiento. */
        max-width: 150px; /* Ancho. */
    }

    .acciones-columna {
        width: 200px !important; /* Ancho. */
        max-width: 200px !important; /* Ancho. */
        white-space: nowrap; /* Evita que el texto se divida en varias líneas. */
    }

    /* Ajuste del contenedor de controles (buscador y length menu). */
    div.dataTables_wrapper div.dataTables_length,
    div.dataTables_wrapper div.dataTables_filter {
        margin-bottom: 20px; /* Margen. */
    }

    div.dataTables_wrapper div.dataTables_filter {
        text-align: right !important; /* Alineacion. */
    }

    div.dataTables_wrapper div.dataTables_length {
        text-align: left !important; /* Alineacion. */
    }

    /* Opcional: Espaciado entre controles y tabla. */
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length {
        padding: 0 10px;
    }

    /* Alinea bien los controles en pantallas pequeñas también. */
    @media (max-width: 768px) {
        div.dataTables_wrapper div.dataTables_length,
        div.dataTables_wrapper div.dataTables_filter {
            text-align: center !important;
        }
    }

    @media (max-width: 768px) {
    .card-header .btn-nuevo-registro {
        width: 100%; /* Ancho. */
        text-align: center; /* Alineacion. */
    }
}
    
</style>
<!-- Formulario para crear la empresa. -->
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
    <!-- Modal para crear la empresa. -->
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success" id="mensaje-exito">
        {{ session('success') }}
    </div>
            @endif
            <!-- Tabla de empresas. -->
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
            <td class="text-center"> <!-- Acciones de los botones. -->
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
    // Funcion para confirmar la eliminacion de una empresa.
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

    // Funcion para eliminar una empresa.
setTimeout(function() {
            let mensaje = document.getElementById('mensaje-exito');
            if (mensaje) {
                mensaje.style.transition = 'opacity 0.5s ease';
                mensaje.style.opacity = '0';
                setTimeout(() => mensaje.remove(), 500);
            }
        }, 3000); // 3000 milisegundos = 3 segundos</script>

@endsection