<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Reporte PDF</title> <!-- Fin del title. -->
  <style>
    body { font-family: Arial, sans-serif; font-size: 14px; } /* Fin del style. */
    h1 {
      text-align: center; /* Text-align. */
      font-size: 22px; /* Font-size. */
      margin-bottom: 10px; /* Margin-bottom. */
      text-transform: uppercase; /* Text-transform. */
    }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; } /* Fin de la tabla. */
    th, td { border: 1px solid #333; padding: 8px; text-align: left; } /* Fin de la tabla. */
  </style>
</head>
<body>
  <h1>Reporte de Diagnóstico N.º {{ $reporte->id }}</h1>

  <p><strong>Empresa:</strong> {{ optional($reporte->empresa)->empresa }}</p>

  <table>
    <tr><th>Equipo</th><td>{{ $reporte->equipo }}</td></tr> <!-- Fin de la tabla. -->
    <tr><th>Modelo</th><td>{{ $reporte->modelo }}</td></tr> <!-- Fin de la tabla. -->
    <tr><th>Marca</th><td>{{ $reporte->marca }}</td></tr> <!-- Fin de la tabla. -->
    <tr><th>Serie</th><td>{{ $reporte->serie }}</td></tr> <!-- Fin de la tabla. -->
    <tr><th>Estado</th><td>{{ $reporte->estado }}</td></tr> <!-- Fin de la tabla. -->
    <tr><th>Fecha</th><td>{{ $reporte->created_at->format('d/m/Y') }}</td></tr> <!-- Fin de la tabla. -->
  </table>
</body>
</html>
