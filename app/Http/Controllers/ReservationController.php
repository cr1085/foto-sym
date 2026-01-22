<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Services\AgendaService;
use App\Models\Service;
// use App\Services\AgendaService;

class ReservationController extends Controller
{
    //
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'nombre' => 'required',
    //         'email' => 'required|email',
    //         'telefono' => 'required',
    //         'fecha' => 'required',
    //         'hora' => 'required',
    //         'tipo_evento' => 'required',
    //         'paquete' => 'required',
    //         'valor_total' => 'required'
    //     ]);

    //     $data['anticipo'] = $data['valor_total'] * 0.5;
    //     $data['saldo'] = $data['valor_total'] * 0.5;

    //     $reserva = Reservation::create($data);

    //     return redirect()->back()
    //         ->with('ok', 'Reserva creada');
    // }


    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'servicio_id' => 'required|exists:services,id',
    //         'fecha'       => 'required|date',
    //         'hora'        => 'required',
    //         'nombre'      => 'required',
    //         'email'       => 'required|email',
    //         'telefono'    => 'required',
    //     ]);

    //     $servicio = Service::findOrFail($data['servicio_id']);

    //     $valorTotal = $servicio->precio;
    //     $anticipo   = $valorTotal * 0.5;
    //     $saldo      = $valorTotal - $anticipo;

    //     $estado = $servicio->tipo === 'evento'
    //         ? 'pendiente_confirmacion'
    //         : 'pendiente';



    //     Reservation::create([
    //         'servicio_id' => $servicio->id,
    //         'nombre'      => $data['nombre'],
    //         'email'       => $data['email'],
    //         'telefono'    => $data['telefono'],
    //         'fecha'       => $data['fecha'],
    //         'hora'        => $data['hora'],
    //         'valor_total' => $valorTotal,
    //         'anticipo'    => $anticipo,
    //         'saldo'       => $saldo,
    //         'estado'      => $estado,
    //     ]);

    //     return redirect('/')
    //         ->with('ok', 'Reserva creada correctamente');
    // }




  public function store(Request $request)
{
    $agendaService = app(\App\Services\AgendaService::class);

    $data = $request->validate([
        'servicio_id' => 'required|exists:services,id',
        'nombre'      => 'required|string',
        'email'       => 'required|email',
        'telefono'    => 'required|string',
        'fecha'       => 'required|date',
        'hora'        => 'required',
        'paquete'     => 'nullable|string',
    ]);

    $servicio = Service::findOrFail($data['servicio_id']);

    $horasDisponibles = $agendaService->horasDisponibles(
        $data['fecha'],
        $servicio->id
    );

    if (!in_array($data['hora'], $horasDisponibles)) {
        return back()->withErrors([
            'hora' => 'La hora seleccionada ya no está disponible'
        ]);
    }

    $valorTotal = $servicio->precio;
    $anticipo   = $servicio->tipo === 'evento' ? $valorTotal / 2 : null;
    $saldo      = $anticipo ? $valorTotal - $anticipo : null;

    $estado = $servicio->tipo === 'evento'
        ? 'pendiente_confirmacion'
        : 'pendiente';

    Reservation::create([
        'servicio_id' => $servicio->id,
        'nombre'      => $data['nombre'],
        'email'       => $data['email'],
        'telefono'    => $data['telefono'],
        'fecha'       => $data['fecha'],
        'hora'        => $data['hora'],
        'paquete'     => $data['paquete'] ?? null,
        'valor_total' => $valorTotal,
        'anticipo'    => $anticipo,
        'saldo'       => $saldo,
        'estado'      => $estado,
    ]);

    return back()->with('success', 'Reserva creada correctamente');
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
