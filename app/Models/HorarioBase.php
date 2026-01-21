<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioBase extends Model
{
    protected $table = 'horario_bases';

    protected $fillable = [
        'dia',
        'desde',
        'hasta',
        'activo'
    ];
}
