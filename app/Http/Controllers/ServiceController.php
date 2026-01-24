<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $servicios = Service::all();

        return view('admin.servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('admin.servicios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'duracion_minutos' => 'required|integer',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')
                ->store('servicios', 'public');
        }


        Service::create($data);

        return redirect('/admin/servicios')
            ->with('ok', 'Servicio creado correctamente');
    }

    public function edit(Service $servicio)
    {
        return view('admin.servicios.edit', compact('servicio'));
    }

    public function update(Request $request, Service $servicio)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'duracion_minutos' => 'required|integer',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')
                ->store('servicios', 'public');
        }


        $servicio->update($data);

        return redirect('/admin/servicios')
            ->with('ok', 'Servicio actualizado');
    }

    public function destroy(Service $servicio)
    {
        $servicio->delete();

        return back()->with('ok', 'Servicio eliminado');
    }
}
