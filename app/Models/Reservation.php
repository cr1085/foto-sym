<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'fecha',
        'hora',
        'tipo_evento',
        'paquete',
        'valor_total',
        'anticipo',
        'saldo',
        'estado'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
