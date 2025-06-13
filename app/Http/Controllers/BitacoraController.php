<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\User;
class BitacoraController extends Controller
{   // Constructor.
    public function __construct()
{
    $this->middleware('auth');
}

// Muestra la vista de bitacora.
public function bitacoraIndex()
{
    $bitacoras = Bitacora::with('user')->orderBy('created_at', 'desc')->paginate(10);
    return view('bitacora.index', compact('bitacoras'));
}
}
