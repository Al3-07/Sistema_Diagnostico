<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Reporte PDF</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 14px; }
    h1 {
      text-align: center;
      font-size: 22px;
      margin-bottom: 10px;
      text-transform: uppercase;
    }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #333; padding: 8px; text-align: left; }
  </style>
</head>
<body>
  <h1>Reporte de Diagnóstico N.º {{ $reporte->id }}</h1>

  <p><strong>Empresa:</strong> {{ optional($reporte->empresa)->empresa }}</p>

  <table>
    <tr><th>Equipo</th><td>{{ $reporte->equipo }}</td></tr>
    <tr><th>Modelo</th><td>{{ $reporte->modelo }}</td></tr>
    <tr><th>Marca</th><td>{{ $reporte->marca }}</td></tr>
    <tr><th>Serie</th><td>{{ $reporte->serie }}</td></tr>
    <tr><th>Estado</th><td>{{ $reporte->estado }}</td></tr>
    <tr><th>Fecha</th><td>{{ $reporte->created_at->format('d/m/Y') }}</td></tr>
  </table>
</body>
</html>
