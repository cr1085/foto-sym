<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    // protected $fillable = [
    //     'nombre',
    //     'duracion_minutos',
    //     'precio',
    //     'activo'
    // ];

    protected $fillable = [
        'nombre',
        'duracion_minutos',
        'precio',
        'tipo',
        'capacidad_simultanea',
        'activo',
         'imagen'
    ];
}
