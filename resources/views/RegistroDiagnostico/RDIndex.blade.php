@extends('Layouts.app')

@section('titulo', 'Gestión de Diagnósticos de Equipos')

@section('contenido')

@include('sweetalert::alert')

<style>
    /* (Mantén todos tus estilos actuales) */

    /* Ajuste para las imágenes en la tabla */
    .img-table {
        max-width: 80px;
        max-height: 60px;
        border-radius: 6px;
        object-fit: cover;
        box-shadow: 0 0 3px rgba(0,0,0,0.15);
    }
</style>

<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title mb-0"><b>Diagnósticos de Equipos</b></h2>
            @if(Auth::user()->role !== 'Visualizador')
                <a href="{{ route('registrodiagnostico.create') }}" class="btn btn-info btn-sm btn-nuevo-registro">
                    <i class="fas fa-plus"></i> Nuevo diagnóstico
                </a>
            @endif
        </div>
        <div class="card-body p-4">
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped w-100" id="equipos-table">
                    <thead>
                        <tr>
                            <th>Hardware</th>
                            <th>Modelo</th>
                            <th>Marca</th>
                            <th>Serie</th>
                            <th>Descripción</th>
                            <th>Foto Antes</th>
                            <th>Foto Después</th>
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
        $('#equipos-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('registrodiagnostico.table') }}',
            columns: [
                { data: 'equipo', name: 'equipo' },
                { data: 'modelo', name: 'modelo' },
                { data: 'marca', name: 'marca' },
                { data: 'serie', name: 'serie' },
                { data: 'descripcion', name: 'descripcion' },
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
            ],
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

@endsection
