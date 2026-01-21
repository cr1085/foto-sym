<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioExcepcion extends Model
{
    //
    protected $fillable = [
        'fecha',
        'desde',
        'hasta',
        'motivo'
    ];
}
