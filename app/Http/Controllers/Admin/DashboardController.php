<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'total' => Reservation::count(),
            'pendiente' => Reservation::where('estado','pendiente')->count(),
            'confirmacion' => Reservation::where('estado','pendiente_confirmacion')->count(),
            'pagado' => Reservation::where('estado','pagado')->count(),
            'cancelado' => Reservation::where('estado','cancelado')->count(),
            'ultimas' => Reservation::with('servicio')
                ->latest()
                ->limit(5)
                ->get(),
            'servicios' => Service::count()
        ]);
    }
}
