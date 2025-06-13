@extends('Layouts.app')

@section('titulo', 'Gestión de Roles')

@section('contenido')

<!-- Asegura que los mensajes de SweetAlert se muestren. -->
@include('sweetalert::alert')

<style>
    body {
        font-family: 'Poppins', sans-serif; /* Font-family. */
        background-color: #f8f9fa; /* Color de fondo. */
    }

    .container {
        max-width: 1240px; /* Ancho máximo del contenedor. */
    }

    .dataTables_filter {
        margin-bottom: 20px; /* Margen inferior del filtro. */
    }

    .dataTables_filter input {
        border: 1px solid #e2e8f0; /* Borde del input. */
        border-radius: 6px; /* Radio del borde. */
        padding: 0.5rem 1rem;
        width: 250px;
    }

    .dataTables_filter input:focus {
        border-color: #3b82f6; /* Color del borde del input al enfocarse. */
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25); /* Sombra del input al enfocarse. */
    }

    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-title {
        color:  #ffffff; /* Color del texto del título. */
        font-weight: 600; /* Peso del texto del título. */
    }

    .card-header {
        background-color: rgb(27, 119, 211); /* Color del encabezado. */
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }

    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        color:rgb(0, 0, 0); /* Color del texto de la tabla. */
        font-weight: 600; /* Peso del texto de la tabla. */
        font-size: 0.875rem; /* Tamaño del texto de la tabla. */
        padding: 12px; /* Margen interno de la tabla. */
        border-bottom: 1px solid #e2e8f0; /* Borde inferior de la tabla. */
        background-color: rgb(172, 215, 255); /* Color de fondo de la tabla. */
    }

    .table tbody td {
        padding: 12px; /* Margen interno de la tabla. */
        vertical-align: middle; /* Alineación vertical de la tabla. */
        border-bottom: 1px solid #f1f5f9; /* Borde inferior de la tabla. */
        font-size: 0.875rem; /* Tamaño del texto de la tabla. */
        color: #334155; /* Color del texto de la tabla. */
    }

    .table tbody tr:hover {
        background-color: rgb(218, 221, 224); /* Color de fondo de la tabla al pasar el mouse. */
    }

    .acciones-columna {
        width: 120px; /* Ancho de la columna de acciones. */
        text-align: center; /* Alineación del texto de la columna de acciones. */
    }

    .acciones-columna div {
        display: flex; /* Display flex. */
        justify-content: center; /* Alineación del texto de la columna de acciones. */
        gap: 5px; /* Gap. */
    }

    #roles-table tr td:nth-child(2), 
    #roles-table tr th:nth-child(2),
    #roles-table th.acciones-columna, 
    #roles-table td.acciones-columna {
        text-align: center !important; /* Alineación del texto de la columna de acciones. */
    }

    .dataTables_paginate .paginate_button {
        border-radius: 6px !important; /* Radio del borde. */
        margin: 0 2px !important; /* Margen. */
    }

    .dataTables_paginate .paginate_button.current {
        background: #0ea5e9 !important; /* Color del botón actual. */
        border-color: #0ea5e9 !important; /* Color del borde del botón actual. */
        color: white !important; /* Color del texto del botón actual. */
    }

    .dataTables_paginate .paginate_button:hover {
        background: #e2e8f0 !important; /* Color del botón al pasar el mouse. */
        border-color: #e2e8f0 !important; /* Color del borde del botón al pasar el mouse. */
        color: #334155 !important; /* Color del texto del botón al pasar el mouse. */
    }

    .dataTables_info {
        color: #64748b; /* Color del texto del botón al pasar el mouse. */
        padding-top: 1rem; /* Margen superior del botón al pasar el mouse. */
    }

    .rol-columna {
        text-align: left !important; /* Alineación del texto de la columna de acciones. */
    }

    .toggleEstado {
        transition: all 0.3s ease; /* Transición. */
        font-weight: 500; /* Peso del texto. */
    }

    .toggleEstado:hover {
        color: #000000; /* Color del texto al pasar el mouse. */
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3);
    }

    /* Nueva clase para botones más pequeños. */
    .btn {
        padding: 0.25rem 0.6rem; /* Margen interno del botón. */
        font-size: 0.8rem; /* Tamaño del texto del botón. */
        border-radius: 6px; /* Radio del borde del botón. */
        font-weight: 500; /* Peso del texto del botón. */
    }
</style>
<!-- Contenido de la tabla de roles -->
<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title mb-0">
                <b>Gestor de Roles</b>
            </h2>
        </div>
        <div class="card-body p-4"> <!-- Contenido de la tabla de roles -->
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped w-100" id="roles-table">
                    <thead>
                        <tr>
                            <th class="rol-columna">Rol</th>  
                            <th class="estado-columna">Estado</th>
                            <th class="acciones-columna">Acciones</th>     
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script> /* Script para la tabla de roles */
$(document).ready(function () {
    let table = $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('registrorol.table') }}',
        columns: [
            {data: 'rol', name: 'rol'},
            {data: 'estado_texto', name: 'estado_texto', orderable: false, searchable: false},
            {data: 'acciones', name: 'acciones', orderable: false, searchable: false}
        ],
        searching: false,
        paging: true,
       language: {
    processing: "Procesando...",
    lengthMenu: "Mostrar _MENU_ registros",
    zeroRecords: "No se encontraron resultados",
    info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
    infoFiltered: "(filtrado de un total de _MAX_ registros)",
    search: "Buscar:",
    paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior"
    }
},

        lengthChange: false 
    });

   // Evento para cambiar el estado con AJAX.
    $('#roles-table').on('click', '.toggleEstado', function() {
        let button = $(this);
        let roleId = button.data('id');
        let newEstado = button.data('estado') == 1 ? 0 : 1;
        let accion = newEstado == 1 ? 'activar' : 'desactivar';
        let mensaje = newEstado == 1 ? 'activado' : 'desactivado';
        /* Fin de los datos. */ 
        Swal.fire({
            title: '¿Estás seguro?',
            text: `¿Deseas ${accion} este rol?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('roles.toggleEstado') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: roleId,
                        estado: newEstado
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                '¡Listo!',
                                `El rol ha sido ${mensaje} correctamente.`,
                                'success'
                            );
                            table.ajax.reload(); /* Recarga la tabla automáticamente. */
                        } else {
                            Swal.fire(
                                'Error',
                                response.message || 'Ha ocurrido un error.',
                                'error'
                            );
                        }
                    }, /* Fin de la función success. */ 
                    error: function() {
                        Swal.fire(
                            'Error',
                            'Ha ocurrido un error en la operación.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>

@endsection