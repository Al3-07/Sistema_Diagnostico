@extends('Layouts.app')
@section('titulo','Reportes por Área')
@section('contenido')
<div class="container-fluid">
<h2 class="mb-4 text-center" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
  Reportes
</h2>

  <!-- Filtros -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <form method="GET" action="{{ route('reportes.index') }}" class="row g-3">
        <div class="col-md-3">
          <label class="fw-bold">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}" placeholder="dd/mm/yyyy" max="{{ now()->format('Y-m-d') }}">
        </div>
        <div class="col-md-3">
          <label class="fw-bold">Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}" placeholder="dd/mm/yyyy" max="{{ now()->format('Y-m-d') }}">
        </div>
        <div class="col-md-2 align-self-end">
          <button class="btn btn-primary w-100"><i class="fas fa-filter"></i> Filtrar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Reportes por empresa -->
  @php
    $agrupados = $reportes->groupBy(fn($r) => optional($r->empresa)->empresa ?? 'Sin empresa');
    $colores = ['primary', 'success', 'danger', 'warning', 'info']; // Bootstrap color classes
  @endphp

  <div class="row">
    @forelse($agrupados as $nombreEmpresa => $grupo)
      @php
        $color = $colores[$loop->index % count($colores)];
      @endphp
      <div class="col-md-12 mb-4">
        <div class="card shadow">
         <div class="card-header bg-{{ $color }} text-white">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
    <h5 class="mb-2 mb-md-0">
      <i class="fas fa-building"></i> Empresa: {{ $nombreEmpresa }}
    </h5>
    <a href="{{ route('reportes.pdf.empresa', ['empresa' => $nombreEmpresa]) }}"
       class="btn btn-light btn-sm text-dark mt-2 mt-md-0"
       style="min-width: 150px; max-width: 150px;"
       target="_blank">
      <i class="fas fa-file-pdf"></i> PDF General
    </a>
  </div>
</div>

          <div class="card-body">
            <div style="max-height: 300px; overflow-y: auto;">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Equipo</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Serie</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>PDF</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($grupo as $r)
                  <tr>
                    <td>{{ $r->equipo }}</td>
                    <td>{{ $r->modelo }}</td>
                    <td>{{ $r->marca }}</td>
                    <td>{{ $r->serie }}</td>
                    <td>{{ $r->estado }}</td>
                    <td>{{ $r->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">
                      <a href="{{ route('reportes.pdf.individual', ['id' => $r->id]) }}" class="btn btn-outline-danger btn-sm" target="_blank" title="Ver PDF individual">
                        <i class="fas fa-file-pdf"></i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info text-center">No hay reportes para mostrar en el rango seleccionado.</div>
      </div>
    @endforelse
  </div>
</div>
@endsection
