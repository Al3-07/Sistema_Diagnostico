<?php

namespace App\Helpers;

use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log; // 

class BitacoraHelper
{
     public static function registrar($accion, $descripcion = null)
    {
        // Ver qué devuelve Auth::user()
        Log::info('Usuario autenticado:', ['user' => Auth::user()]);
        Log::info('ID:', ['id' => Auth::id()]);

        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => $accion,
            'descripcion' => $descripcion,
            'ip' => Request::ip(),
        ]);
    }
}
