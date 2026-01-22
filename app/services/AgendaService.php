<?php

namespace App\Services;

use App\Models\HorarioBase;
use App\Models\HorarioExcepcion;
use App\Models\Reservation;
use App\Models\Service;
use Carbon\Carbon;

class AgendaService
{
    public function horasDisponibles($fecha, $servicioId)
    {
        // 1. Servicio
        $servicio = Service::find($servicioId);
        if (!$servicio) {
            return [];
        }

        $duracion  = $servicio->duracion_minutos;
        $tipo      = $servicio->tipo;
        $capacidad = $servicio->capacidad_simultanea;

        // 2. Día en español sin tildes
        $dia = strtolower(
            Carbon::parse($fecha)->locale('es')->dayName
        );

        // Normalizar tildes (miércoles, sábado)
        $dia = str_replace(
            ['á','é','í','ó','ú'],
            ['a','e','i','o','u'],
            $dia
        );

        // 3. Horarios base
        $bloques = HorarioBase::where('dia', $dia)
            ->where('activo', 1)
            ->get();

        if ($bloques->isEmpty()) {
            return [];
        }

        // 4. Excepciones
        $excepcion = HorarioExcepcion::where('fecha', $fecha)->first();

        if ($excepcion) {
            if (!$excepcion->desde) {
                return [];
            }

            $bloques = collect([[
                'desde' => $excepcion->desde,
                'hasta' => $excepcion->hasta
            ]]);
        }

        // 5. Generar horas
        $horas = [];

        foreach ($bloques as $b) {

            $inicio = Carbon::parse($b['desde']);
            $fin    = Carbon::parse($b['hasta']);

            while ($inicio->copy()->addMinutes($duracion) <= $fin) {

                // $hora = $inicio->format('H:i');
                $hora = $inicio->format('H:i:s');


                // Reservas existentes para esa hora
                $ocupadas = Reservation::where('fecha', $fecha)
                    ->where('hora', $hora)
                    ->whereIn('estado', [
                        'pendiente',
                        'anticipo_pagado',
                        'pagado'
                    ])
                    ->count();

                if ($tipo === 'estudio') {
                    // Estudio: solo 1 permitido
                    if ($ocupadas === 0) {
                        $horas[] = $hora;
                    }
                }

                if ($tipo === 'evento') {
                    // Evento: hasta N simultáneos
                    if ($ocupadas < $capacidad) {
                        $horas[] = $hora;
                    }
                }

                // Saltos de 30 minutos
                $inicio->addMinutes(30);
            }
        }

        return array_values(array_unique($horas));
    }
}
