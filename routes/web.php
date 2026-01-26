<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Admin\ReservationAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\Service;

/*
|--------------------------------------------------------------------------
| WEB PÚBLICA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/reservas', function () {
    return view('reservas.index');
})->name('reservas');

// Route::get('/servicios', function () {
//     return view('servicios.index');
// })->name('servicios.public');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');


Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    return 'Cache limpio';
});


Route::post('/contacto', [\App\Http\Controllers\ContactoController::class, 'enviar'])
    ->name('contacto.enviar');



Route::get('/servicios', function () {
    $servicios = Service::all();
    return view('servicios.index', compact('servicios'));
})->name('servicios');

Route::post('/reservar', [ReservationController::class, 'store']);

/*
|--------------------------------------------------------------------------
| API AGENDA (PÚBLICA)
|--------------------------------------------------------------------------
*/

Route::get('/horas-disponibles', [AgendaController::class, 'horas']);
Route::get('/servicios-disponibles', [AgendaController::class, 'servicios']);

/*
|--------------------------------------------------------------------------
| ADMIN (PROTEGIDO)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'nocache'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::resource('servicios', ServiceController::class);

        Route::get('/reservas', [ReservationAdminController::class, 'index'])
            ->name('admin.reservas.index');

        Route::get('/reservas/{reservation}', [ReservationAdminController::class, 'show'])
            ->name('admin.reservas.show');

        Route::post('/reservas/{reservation}/estado', [ReservationAdminController::class, 'cambiarEstado'])
            ->name('admin.reservas.estado');

        Route::get('/usuarios/crear', function () {
            return view('admin.usuarios.create');
        })->name('admin.usuarios.create');
});

/*
|--------------------------------------------------------------------------
| PERFIL (BREEZE)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
