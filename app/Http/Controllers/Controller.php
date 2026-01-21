<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

abstract class Controller
{
    //
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
        'precio' => 'required|numeric'
    ]);

    Service::create($data);

    return redirect('/admin/servicios')
        ->with('ok','Servicio creado');
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
        'precio' => 'required|numeric'
    ]);

    $servicio->update($data);

    return redirect('/admin/servicios')
        ->with('ok','Actualizado');
}

public function destroy(Service $servicio)
{
    $servicio->delete();

    return back()->with('ok','Eliminado');
}


}
