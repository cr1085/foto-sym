<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

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
            'descripcion' => 'nullable|string',
            'duracion_minutos' => 'required|integer',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048',
        ]);

    //     if ($request->hasFile('imagen')) {
    //         $data['imagen'] = $request->file('imagen')
    //             ->store('servicios', 'public');
    //    }

  if ($request->hasFile('imagen')) {

    // 1️⃣ Guardar con Laravel (funcional, NO se toca)
    $path = $request->file('imagen')->store('servicios', 'public');
    $data['imagen'] = $path;

    // 2️⃣ ORIGEN REAL (correcto)
    $origen = Storage::disk('public')->path($path);

    // 3️⃣ DESTINO en public_html
    $destino = $_SERVER['DOCUMENT_ROOT'].'/storage/'.$path;

    if (!file_exists(dirname($destino))) {
        mkdir(dirname($destino), 0755, true);
    }

    copy($origen, $destino);
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
            'descripcion' => 'nullable|string',
            'duracion_minutos' => 'required|integer',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048',
        ]);

        // if ($request->hasFile('imagen')) {
        //     $data['imagen'] = $request->file('imagen')
        //         ->store('servicios', 'public');
        // }


     if ($request->hasFile('imagen')) {

    // 1️⃣ Guardar con Laravel (funcional, NO se toca)
    $path = $request->file('imagen')->store('servicios', 'public');
    $data['imagen'] = $path;

    // 2️⃣ ORIGEN REAL (correcto)
    $origen = Storage::disk('public')->path($path);

    // 3️⃣ DESTINO en public_html
    $destino = $_SERVER['DOCUMENT_ROOT'].'/storage/'.$path;

    if (!file_exists(dirname($destino))) {
        mkdir(dirname($destino), 0755, true);
    }

    copy($origen, $destino);
}




        $servicio->update($data);

        return redirect('/admin/servicios')
            ->with('ok', 'Servicio actualizado');
    }

      // public function destroy(Service $servicio)
    // {
    //     $servicio->delete();

    //     return back()->with('ok', 'Servicio eliminado');
    // }


    // public function destroy(Service $servicio)
    // {
    //     $servicio->delete();

    //     return redirect()
    //         ->route('servicios.index')
    //         ->with('success', 'Servicio eliminado correctamente');
    // }

    public function destroy(Service $servicio)
{
    try {
        $servicio->delete();

        return redirect()
            ->route('servicios.index')
            ->with('success', 'Servicio eliminado correctamente');

    } catch (QueryException $e) {

        return redirect()
            ->route('servicios.index')
            ->with('error', 'No se puede eliminar este servicio porque tiene reservas asociadas.');
    }
}
}
