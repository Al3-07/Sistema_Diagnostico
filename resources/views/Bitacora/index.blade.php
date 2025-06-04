@extends('layouts.app')

@section('titulo', 'Bitácora del Sistema')

@section('contenido')
<div class="container mt-4">
    <h2>Bitácora</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Acción</th>
                <th>Descripción</th>
            
            </tr>
        </thead>
        <tbody>
            @foreach ($bitacoras as $log)
                <tr>
                    <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $log->user_id }}</td>
                    <td>{{ $log->accion }}</td>
                    <td>{{ $log->descripcion }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $bitacoras->links() }}
</div>
@endsection
