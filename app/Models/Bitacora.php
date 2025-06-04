<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $fillable = ['user_id', 'accion', 'descripcion', 'ip'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
