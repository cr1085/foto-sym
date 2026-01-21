<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AgendaController;

/*
|--------------------------------------------------------------------------
| WEB PÚBLICA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

Route::post('/reservar', [
    ReservationController::class,
    'store'
]);

/*
|--------------------------------------------------------------------------
| API DE AGENDA (PÚBLICO)
|--------------------------------------------------------------------------
*/

Route::get('/horas-disponibles', [
    AgendaController::class,
    'horas'
]);

Route::get('/servicios-disponibles', [
    AgendaController::class,
    'servicios'
]);

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::resource('servicios', ServiceController::class);

});
