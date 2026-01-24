<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Services\AgendaService;
use App\Models\Service;
// use App\Services\AgendaService;

class ReservationController extends Controller
{


public function index()
{
    $reservas = Reservation::with('servicio')
        ->orderBy('fecha')
        ->orderBy('hora')
        ->get();

    return view('admin.reservas.index', compact('reservas'));
}

public function show(Reservation $reservation)
{
    return view('admin.reservas.show', compact('reservation'));
}

public function cambiarEstado(Request $request, Reservation $reservation)
{
    $request->validate([
        'estado' => 'required|in:pendiente,pendiente_confirmacion,anticipo_pagado,pagado,cancelado'
    ]);

    $reservation->estado = $request->estado;
    $reservation->save();

    return back()->with('ok', 'Estado actualizado');
}


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
