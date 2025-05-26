<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Diagnóstico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        header img {
            width: 100%;
            max-height: 150px;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .fecha {
            text-align: right;
            font-size: 14px;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            text-transform: uppercase;
        }

        .descripcion {
            margin-top: 30px;
            font-size: 16px;
        }

        .tabla-firmas {
            margin-top: 150px;
            width: 100%;
            text-align: center;
        }

        .tabla-firmas td {
            width: 33%;
            vertical-align: top;
            padding: 40px 20px;
        }

        .firma {
            border-top: 1px solid #000;
            padding-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
@php
    $membretes = [
        'TAOSA' => 'membrete_TAOSA.png',
        'TAOPAR' => 'membrete_TAOSA.png',
        'TAOGUALI' => 'membrete_TAOSA.png',
         'TAOCA' => 'membrete_TAOSA.png',
        'TAOMOR' => 'membrete_TAOSA.png',
        'Clasificadora y Exportadora de Tabaco' => 'membrete_clasi.png',
        'La Vega' => 'membrete_plasencia.png',
        'Calpule' => 'membrete_plasencia.png',
        'San Luis' => 'membrete_plasencia.png',
        'Azacualpa' => 'membrete_plasencia.png',
        'Escogida3' => 'membrete_plasencia.png',
    ];

    $imagen = $membretes[$registro->empresa] ?? 'default.png';
    $rutaImagen = public_path('img/membretes/' . $imagen);

    if (file_exists($rutaImagen)) {
        $type = pathinfo($rutaImagen, PATHINFO_EXTENSION);
        $data = file_get_contents($rutaImagen);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    } else {
        $base64 = '';
    }

    $correlativo = 'REP-' . str_pad($registro->id ?? 0, 4, '0', STR_PAD_LEFT);
@endphp

<header>
    @if ($base64)
        <img src="{{ $base64 }}" alt="Membrete {{ $registro->empresa }}">
    @else
        <p><strong>Imagen de membrete no encontrada.</strong></p>
    @endif
</header>

<div class="fecha">
    <strong></strong> {{ $correlativo }}<br>
    <strong>Fecha:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
</div>

<h2>Soporte Realizado</h2>

<div class="descripcion">
    {{ $registro->descripcion }}
</div>

<table class="tabla-firmas">
    <tr>
        <td>
            <div class="firma">Realizado por:</div>
        </td>
        <td></td>
        <td>
            <div class="firma">Supervisado por:</div>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="padding-top: 100px;">
            <div class="firma" style="width: 40%; margin: auto;">Recibido por:</div>
        </td>
    </tr>
</table>

</body>
</html>
