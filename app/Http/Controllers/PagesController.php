<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Fíjate: No hace falta hacer 'use' del Controller porque ya estamos en la misma carpeta,
// pero si tu IDE lo pide, sería: use App\Http\Controllers\Controller;
// LO IMPORTANTE: ¡Nunca uses la ruta change_Monolitic...!

class PagesController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
}
