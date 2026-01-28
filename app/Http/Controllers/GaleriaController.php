<?php

namespace App\Http\Controllers;

use App\Models\Galeria;

class GaleriaController extends Controller
{
    public function index()
    {
        // $galerias = Galeria::orderBy('categoria')->get();

        // return view('galeria.index', compact('galerias'));

        $galerias = Galeria::orderBy('categoria')->get();

        $categorias = Galeria::select('categoria')
            ->distinct()
            ->pluck('categoria');

        return view('galeria.index', compact('galerias', 'categorias'));
    }
}
