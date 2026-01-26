<?php

namespace App\Http\Controllers;

use App\Models\Galeria;

class GaleriaController extends Controller
{
    public function index()
    {
        $galerias = Galeria::orderBy('categoria')->get();

        return view('galeria.index', compact('galerias'));
    }
}
