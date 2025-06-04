<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\User;
class BitacoraController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
public function bitacoraIndex()
{
    $bitacoras = Bitacora::with('user')->orderBy('created_at', 'desc')->paginate(20);
    return view('bitacora.index', compact('bitacoras'));
}
}
