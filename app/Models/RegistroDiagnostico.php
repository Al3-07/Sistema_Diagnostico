<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroDiagnostico extends Model
{
    protected $table = 'equipo';

    protected $fillable = [
        'equipo', 'modelo', 'marca', 'serie', 'descripcion','foto_antes','foto_despues'
    ];
}
