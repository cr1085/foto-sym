<?php

namespace App\Http\Controllers;

use App\Services\AgendaService;
use App\Models\Service;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function horas(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'servicio_id' => 'required|exists:services,id'
        ]);

        $agenda = new AgendaService();

        $horas = $agenda->horasDisponibles(
            $request->fecha,
            $request->servicio_id
        );

        return response()->json($horas);
    }

    public function servicios()
    {
        return response()->json(
            Service::where('activo',1)->get()
        );
    }
}

