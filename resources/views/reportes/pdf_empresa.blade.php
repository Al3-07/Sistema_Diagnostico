<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Reporte por Empresa</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 13px;
      margin: 30px;
    }
    h2.titulo-reporte {
      text-align: center;
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 20px;
      text-transform: uppercase;
      border-bottom: 2px solid #000;
      padding-bottom: 5px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      border: 1px solid #333;
      padding: 6px;
      text-align: left;
    }
    th {
      background-color: #f0f0f0;
    }
  </style>
</head>
<body>
  <h2 class="titulo-reporte">Reporte General de Diagnósticos - {{ $nombreEmpresa }}</h2>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Equipo</th>
        <th>Modelo</th>
        <th>Marca</th>
        <th>Serie</th>
        <th>Estado</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      @foreach($reportes as $r)
      <tr>
        <td>{{ $r->id }}</td>
        <td>{{ $r->equipo }}</td>
        <td>{{ $r->modelo }}</td>
        <td>{{ $r->marca }}</td>
        <td>{{ $r->serie }}</td>
        <td>{{ $r->estado }}</td>
        <td>{{ $r->created_at->format('d/m/Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
