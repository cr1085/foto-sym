<?php

namespace App\Services;

use App\Models\HorarioBase;
use App\Models\Reservation;
use App\Models\Service;

class AgendaService
{
    public function horasDisponibles($fecha, $servicioId)
    {
        $servicio = Service::find($servicioId);
        if (!$servicio) {
            return [];
        }

        $duracion  = $servicio->duracion_minutos;
        $tipo      = $servicio->tipo;
        $capacidad = $servicio->capacidad_simultanea;

        // 🔥 TRAER TODOS LOS HORARIOS ACTIVOS (SIN DIA)
        $bloques = HorarioBase::where('activo', 1)->get();

        if ($bloques->isEmpty()) {
            return [];
        }

        $horas = [];

        foreach ($bloques as $b) {

            $inicio = strtotime($b->desde);
            $fin    = strtotime($b->hasta);

            while (($inicio + ($duracion * 60)) <= $fin) {

                $hora = date('H:i:s', $inicio);

                $ocupadas = Reservation::where('fecha', $fecha)
                    ->where('hora', $hora)
                    ->whereIn('estado', ['pendiente','anticipo_pagado','pagado'])
                    ->count();

                if ($tipo === 'estudio' && $ocupadas === 0) {
                    $horas[] = $hora;
                }

                if ($tipo === 'evento' && $ocupadas < $capacidad) {
                    $horas[] = $hora;
                }

                // saltos de 30 min
                $inicio += 1800;
            }
        }

        return array_values(array_unique($horas));
    }
}
