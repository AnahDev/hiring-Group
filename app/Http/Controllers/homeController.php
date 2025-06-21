<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function __invoke()
    {
        return view('home');

        // 'aqui va la vista del home';
        // Se va a reemplazar por la vista de home
    }
}
