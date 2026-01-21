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
        // 👉 1. Obtener día en español y normalizar tildes
        $dia = strtolower(
            Carbon::parse($fecha)->locale('es')->dayName
        );

        $dia = str_replace(
            ['á','é','í','ó','ú'],
            ['a','e','i','o','u'],
            $dia
        );

        // 👉 2. Traer horarios base de ese día
        $bloques = HorarioBase::where('dia', $dia)
            ->where('activo', 1)
            ->get();

        // Si no hay horario configurado → no hay horas
        if ($bloques->isEmpty()) {
            return [];
        }

        // 👉 3. Revisar excepción de ese día
        $excepcion = HorarioExcepcion::where('fecha', $fecha)->first();

        if ($excepcion) {

            // Si la excepción no tiene "desde" = día cerrado
            if (!$excepcion->desde) {
                return [];
            }

            // Reemplazar bloques por la excepción
            $bloques = collect([[
                'desde' => $excepcion->desde,
                'hasta' => $excepcion->hasta
            ]]);
        }

        // 👉 4. Validar servicio
        $servicio = Service::find($servicioId);

        if (!$servicio) {
            return [];
        }

        $duracion = $servicio->duracion_minutos;

        $horas = [];

        // 👉 5. Generar slots por cada bloque
        foreach ($bloques as $b) {

            $inicio = Carbon::parse($b['desde']);
            $fin    = Carbon::parse($b['hasta']);

            while ($inicio->copy()->addMinutes($duracion) <= $fin) {

                $hora = $inicio->format('H:i');

                // 👉 6. Validar si ya está ocupada
                $ocupado = Reservation::where('fecha', $fecha)
                    ->where('hora', $hora)
                    ->exists();

                if (!$ocupado) {
                    $horas[] = $hora;
                }

                // Saltos de 30 minutos
                $inicio->addMinutes(30);
            }
        }

        return $horas;
    }
}
