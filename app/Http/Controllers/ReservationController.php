<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Services\AgendaService;

class ReservationController extends Controller
{
    //
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
            'tipo_evento' => 'required',
            'paquete' => 'required',
            'valor_total' => 'required'
        ]);

        $data['anticipo'] = $data['valor_total'] * 0.5;
        $data['saldo'] = $data['valor_total'] * 0.5;

        $reserva = Reservation::create($data);

        return redirect()->back()
            ->with('ok', 'Reserva creada');
    }


    public function horas(Request $r)
    {
        $horas = app(AgendaService::class)
            ->horasDisponibles(
                $r->fecha,
                $r->servicio_id
            );

        return response()->json($horas);
    }
}
