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
            width: 33%;
            text-align: center;
        }

        .tabla-firmas td {
            width: 33%;
            vertical-align: top;
            padding: 40px 20px;
        }

        .firma {
    text-align: center;
    font-weight: bold;
    font-size: 14px;
   
}

        .firma {
        text-align: center;
        font-weight: bold;
        font-size: 14px;
    }
    .firma-img {
        display: block;
        margin: 0 auto;
        height: 80px;
        object-fit: contain;
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

      @php

function firmaBase64($ruta){
    if(!$ruta || !Storage::disk('public')->exists($ruta)) return null;
    $data = Storage::disk('public')->get($ruta);
    return 'data:image/png;base64,'.base64_encode($data);
}

$firmaRealizado  = firmaBase64($registro->firma_realizado);
$firmaSupervisado= firmaBase64($registro->firma_supervisado);
$firmaRecibido   = firmaBase64($registro->firma_recibido);

// Agregar logs para verificar las firmas
\Log::info('Firma Realizado: ' . $firmaRealizado);
\Log::info('Firma Supervisado: ' . $firmaSupervisado);
\Log::info('Firma Recibido: ' . $firmaRecibido);
@endphp

</header>


<div class="fecha">
    <strong></strong> {{ $correlativo }}<br>
    <strong>Fecha:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
</div>

<h2>Soporte Realizado</h2>

<div class="descripcion">
    {{ $registro->descripcion }}
</div>
@php
    $estado = $registro->estado;
@endphp

<div style="margin-top: 30px;">
    <strong>Estado del equipo:</strong><br><br>

    [{{ $estado === 'Mal estado' ? 'X' : ' ' }}] Mal Estado<br>
    [{{ $estado === 'Regular' ? 'X' : ' ' }}] Regular<br>
    [{{ $estado === 'Buen estado' ? 'X' : ' ' }}] Buen Estado<br>
</div>

    <table width="100%" style="margin-top: 150px;">
    <tr>
        <td style="text-align: center;">
            <div class="firma">Realizado por</div>
            @if ($firmaRealizado)
                <img src="{{ $firmaRealizado }}" class="firma-img" alt="Firma realizado">
            @endif
            <div style="border-top: 1px solid #000; width: 80%; margin: 10px auto 0;"></div>
        </td>
        <td></td>
        <td style="text-align: center;">
            <div class="firma">Supervisado por</div>
            @if ($firmaSupervisado)
                <img src="{{ $firmaSupervisado }}" class="firma-img" alt="Firma supervisado">
            @endif
            <div style="border-top: 1px solid #000; width: 80%; margin: 10px auto 0;"></div>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="padding-top: 80px; text-align: center;">
            <div class="firma">Recibido por</div>
            @if ($firmaRecibido)
                <img src="{{ $firmaRecibido }}" class="firma-img" alt="Firma recibido">
            @endif
            <div style="border-top: 1px solid #000; width: 30%; margin: 10px auto 0;"></div>
        </td>
    </tr>
</table>




</body>
</html>
