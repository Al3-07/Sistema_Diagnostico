<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroDiagnostico extends Model
{
    protected $table = 'equipo';

    protected $fillable = [
       'empresa', 'equipo', 'modelo', 'marca', 'serie', 'descripcion','foto_antes','foto_despues','firma_realizado','firma_supervisado','firma_recibido'
    ];
}
