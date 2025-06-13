<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Reporte por Empresa</title>
  <style>
    body {
      font-family: Arial, sans-serif; /* Font-family. */    
      font-size: 13px; /* Font-size. */
      margin: 30px; /* Margin. */
    }
    h2.titulo-reporte {
      text-align: center; /* Text-align. */
      font-size: 20px; /* Font-size. */
      font-weight: bold; /* Font-weight. */
      margin-bottom: 20px; /* Margin-bottom. */
      text-transform: uppercase; /* Text-transform. */
      border-bottom: 2px solid #000; /* Border-bottom. */
      padding-bottom: 5px;
    }
    table {
      width: 100%; /* Width. */
      border-collapse: collapse; /* Border-collapse. */
      margin-top: 10px; /* Margin-top. */
    }
    th, td {
      border: 1px solid #333; /* Border. */
      padding: 6px; /* Padding. */
      text-align: left; /* Text-align. */
    }
    th {
      background-color: #f0f0f0; /* Background-color. */
    }
  </style>
</head>
<body>
  <h2 class="titulo-reporte">Reporte General de Diagnósticos - {{ $nombreEmpresa }}</h2>

  <table>
    <thead>
      <tr>
        <th>ID</th> <!-- ID. -->
        <th>Equipo</th> <!-- Equipo. -->
        <th>Modelo</th> <!-- Modelo. -->
        <th>Marca</th> <!-- Marca. -->
        <th>Serie</th> <!-- Serie. -->
        <th>Estado</th> <!-- Estado. -->
        <th>Fecha</th> <!-- Fecha. -->
      </tr>
    </thead>
    <tbody>
      @foreach($reportes as $r)
      <tr>
        <td>{{ $r->id }}</td> <!-- ID. -->
        <td>{{ $r->equipo }}</td> <!-- Equipo. -->
        <td>{{ $r->modelo }}</td> <!-- Modelo. -->
        <td>{{ $r->marca }}</td> <!-- Marca. -->
        <td>{{ $r->serie }}</td> <!-- Serie. -->
        <td>{{ $r->estado }}</td> <!-- Estado. -->
        <td>{{ $r->created_at->format('d/m/Y') }}</td> <!-- Fecha. -->
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
