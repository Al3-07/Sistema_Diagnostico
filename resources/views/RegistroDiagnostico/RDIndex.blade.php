@extends('Layouts.app')

@section('titulo', 'Gestión de Diagnósticos de Equipos')

@section('contenido')

@include('sweetalert::alert')

<style>
    /* Estilos base. */
    body {
        font-family: 'Poppins', sans-serif; /*Fuente.*/
        background-color: #f8f9fa; /*Color de fondo.*/
    }
    
    /* Contenedor de la tarjeta. */
    .diagnosticos-container {
        max-width: 100%; /*Ancho maximo.*/
        padding: 0 15px; /*Margen.*/
    }
    
    /* Tarjeta de la tarjeta. */
    .diagnosticos-card {
        border-radius: 12px; /*Redondeado.*/
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08); /*Sombra.*/
        overflow: hidden; /*Desbordamiento.*/
        margin-bottom: 30px;
    }

    /* Header de la tarjeta. */
    .card-header-diagnosticos {
        background-color: rgb(27, 119, 211); /*Color de fondo.*/
        border-bottom: 1px solid rgba(0, 0, 0, 0.05); /*Borde.*/
        padding: 1.5rem; /*Margen.*/
        display: flex; /*Flexbox.*/
        justify-content: space-between; /*Justificacion.*/
        align-items: center; /*Alineacion.*/
        flex-wrap: wrap; /*Flexbox.*/
    }

    /* Titulo de la tarjeta. */
    .card-title-diagnosticos {
        color: #ffffff; /*Color de texto.*/
        font-weight: 600; /*Negrita.*/
        margin: 0;
        font-size: 1.5rem;
    }

    /* Boton para nuevo diagnostico. */
    .btn-nuevo-diagnostico {
        background-color: #ffc107; /*Color de fondo.*/
        color: #212529; /*Color de texto.*/
        font-weight: 600; /*Negrita.*/
        transition: all 0.3s ease; /*Transicion.*/
        padding: 0.75rem 1.25rem; /*Margen.*/
        font-size: 0.85rem; /*Tamaño de la fuente.*/
        min-width: 160px; /*Ancho minimo.*/
        border: none; /*Bordes del contenedor.*/
        border-radius: 6px; /*Radio de la esquina del contenedor.*/
    }

    .btn-nuevo-diagnostico:hover {
        background-color: rgb(255, 222, 122); /*Color de fondo.*/
        transform: translateY(-2px); /*Transformacion.*/
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /*Sombra.*/
    }

    /* Estructura de la tabla - Versión escritorio. */
    .table-container {
        padding: 1.5rem; /*Margen.*/
        width: 100%; /*Ancho maximo.*/
    }

    /* Tabla de la tabla. */
    #equipos-table {
        width: 100% !important; /*Ancho maximo.*/
        margin: 0 auto; /*Margen.*/
        border-collapse: collapse; /*Colapsar bordes.*/
    }

    /* Encabezado de la tabla. */
    #equipos-table thead th {
        background-color: rgb(172, 215, 255); /*Color de fondo.*/
        color: #1f2937; /*Color de texto.*/
        font-weight: 700; /*Negrita.*/
        font-size: 0.85rem; /*Tamaño de la fuente.*/
        padding: 0.75rem 0.5rem; /*Margen.*/
        text-align: center; /*Alineacion.*/
        vertical-align: middle; /*Alineacion.*/
        position: sticky; /*Fijo.*/
        top: 0; /*Posicion.*/
    }

    /* Cuerpo de la tabla. */
    #equipos-table tbody td {
        padding: 0.75rem 0.5rem; /*Margen.*/
        font-size: 0.85rem; /*Tamaño de la fuente.*/
        vertical-align: middle; /*Alineacion.*/
        border-top: 1px solid #e9ecef; /*Borde.*/
        text-align: center; /*Alineacion.*/
        word-break: break-word; /* Ajuste de texto importante */
    }

    /* Hover de la tabla. */
    #equipos-table tbody tr:hover {
        background-color: rgba(218, 221, 224, 0.5); /*Color de fondo.*/
    }

    /* Imágenes. */
    .img-table {
        width: 60px; /*Ancho maximo.*/
        height: 45px; /*Altura maxima.*/
        border-radius: 4px; /*Radio de la esquina del contenedor.*/
        object-fit: cover; /*Ajuste de texto importante*/
        box-shadow: 0 0 3px rgba(0,0,0,0.1); /*Sombra.*/
        max-width: 100%; /*Ancho maximo.*/
    }

    /* Controles DataTables. */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        padding: 0.5rem 1rem; /*Margen.*/
    }

    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5em; /*Margen.*/
        border-radius: 4px; /*Radio de la esquina del contenedor.*/
        border: 1px solid #ddd; /*Bordes del contenedor.*/
        padding: 0.25rem 0.5rem; /*Margen.*/
    }

    /* Versión móvil - Solo aquí activamos scroll horizontal. */
    @media (max-width: 768px) {
        .table-container {
            padding: 1rem 0; /*Margen.*/
            overflow-x: auto; /* Scroll solo en móviles. */
            -webkit-overflow-scrolling: touch; /*Scroll horizontal.*/
        }
        
        .card-header-diagnosticos {
            flex-direction: column; /*Flexbox.*/
            align-items: flex-start; /*Alineacion.*/
        }
        
        .btn-nuevo-diagnostico {
            width: 100%; /*Ancho maximo.*/
            margin-top: 1rem;
        }
        
        #equipos-table {
            width: max-content !important; /* Fuerza el ancho según contenido. */
            min-width: 100%;
        }

        #equipos-table thead th,
        #equipos-table tbody td {
            padding: 0.5rem 0.3rem; /*Margen.*/
            font-size: 0.8rem; /*Tamaño de la fuente.*/
            white-space: nowrap; /* Evita saltos de línea */
        }
        
        .img-table {
            width: 50px; /*Ancho maximo.*/
            height: 40px;
        }
        
    }

     /* Ajustes para las columnas específicas. */
    #equipos-table th:nth-child(1), /* Fecha - primera columna. */
    #equipos-table td:nth-child(1) {
        width: 85px; /* Más ancha. */
        min-width: 85px;
        max-width: 85px;
    }
    
    #equipos-table th:nth-child(2), /* Empresa - segunda columna. */
    #equipos-table td:nth-child(2) {
        width: 120px; /* Más angosta. */
        min-width: 120px;
        max-width: 120px;
    }
    
    /* Versión móvil. */
    @media (max-width: 768px) {
        #equipos-table th:nth-child(1),
        #equipos-table td:nth-child(1) {
            width: 150px; /* Fecha sigue siendo más ancha. */
            min-width: 150px;
            max-width: 150px;
        }
        
        #equipos-table th:nth-child(2),
        #equipos-table td:nth-child(2) {
            width: 100px; /* Empresa más angosta. */
            min-width: 100px;
            max-width: 100px;
        }
    }

    /* Estilo para la celda de descripción */
.descripcion-celda {
    display: -webkit-box;
    -webkit-line-clamp: 1; /* Limita a 2 líneas */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis; /* Agrega puntos suspensivos */
    max-width: 200px; /* Ancho máximo para la celda */
    line-height: 1.2; /* Altura de línea */
    max-height: 1.2em; /* 2 líneas (1.2em x 2) */
    word-break: break-word; /* Rompe palabras largas */
}

/* Para versión móvil */
@media (max-width: 768px) {
    .descripcion-celda {
        max-width: 150px; /* Menor ancho en móviles */
    }
}
    
</style>
     <!-- Contenido. -->
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
         <!-- Tabla. -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="equipos-table">
                    <thead>
                        <tr>     <!-- Columnas. -->
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
 <!-- Script. -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#equipos-table').DataTable({// DataTable.
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
                        // Si no hay datos, devuelve vacío
                        if (!data) return '';
                        
                        // Reemplaza saltos de línea con espacios para mejor visualización
                        data = data.replace(/(\r\n|\n|\r)/gm, " ");
                        
                        // Devuelve el texto con el contenedor que aplicará el estilo CSS
                        return `<div class="descripcion-celda" title="${data}">${data}</div>`;
                    }
                },
                { 
                    data: 'estado', 
                    name: 'estado',
                    className: 'columna-estado'
                },
                {
    data: 'foto_antes_img',
    name: 'foto_antes_img',
    className: 'columna-imagen',
    orderable: false,
    searchable: false,
    render: function(data) {
        return data ?? '';
    }
},
{
    data: 'foto_despues_img',
    name: 'foto_despues_img',
    className: 'columna-imagen',
    orderable: false,
    searchable: false,
    render: function(data) {
        return data ?? '';
    }
                },
                {
                    data: 'acciones',
                    name: 'acciones',
                    className: 'columna-acciones',
                    orderable: false,
                    searchable: false
                }
            ],  // Columnas.    
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
            },  // Idioma. 
            autoWidth: false,
            scrollX: false,
            responsive: true
        });
    });
</script>

<script>    // Script. 
    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');
        var url = "{{ url('registrodiagnostico') }}/" + id;
            //  SweetAlert.
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
                    },  // Success.
                    error: function (xhr) {
                        Swal.fire('Error', 'No se pudo eliminar el diagnóstico.', 'error');
                    }  // Error.
                });
            }
        });
    });
</script>

@endsection