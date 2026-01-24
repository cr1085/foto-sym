<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;


class ReservationAdminController extends Controller
{
    //  public function index()
    // {
    //     $reservas = Reservation::with('servicio')
    //         ->orderBy('fecha')
    //         ->orderBy('hora')
    //         ->get();

    //     return view('admin.reservas.index', compact('reservas'));
    // }

     public function index(Request $request)
    {
        $query = Reservation::with('servicio')
            ->orderBy('fecha')
            ->orderBy('hora');

        if ($request->estado) {
            $query->where('estado', $request->estado);
        }

        if ($request->fecha) {
            $query->whereDate('fecha', $request->fecha);
        }

        $reservas = $query->get();

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

        $reservation->update([
            'estado' => $request->estado
        ]);

        return back()->with('ok', 'Estado actualizado');
    }



}
