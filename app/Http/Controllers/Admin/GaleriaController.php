<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use Illuminate\Http\Request;


class GaleriaController extends Controller
{
    public function index()
    {
        $galerias = Galeria::latest()->get();
        return view('admin.galeria.index', compact('galerias'));
    }

    public function create()
    {
        return view('admin.galeria.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required',
            'categoria' => 'required',
            'precio' => 'nullable|numeric',
            'imagen' => 'required|image|max:4096',
        ]);

        // Guardar imagen
        $data['imagen'] = $request->file('imagen')->store('galeria', 'public');

        Galeria::create($data);

        return redirect()->route('admin.galeria.index')
            ->with('ok', 'Imagen agregada a la galería');
    }
}
