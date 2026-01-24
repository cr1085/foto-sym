<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;


class Reservation extends Model
{
    // protected $fillable = [
    //     'nombre',
    //     'email',
    //     'telefono',
    //     'fecha',
    //     'hora',
    //     'tipo_evento',
    //     'paquete',
    //     'valor_total',
    //     'anticipo',
    //     'saldo',
    //     'estado'
    // ];


    protected $fillable = [
        'servicio_id',
        'nombre',
        'email',
        'telefono',
        'fecha',
        'hora',
        'valor_total',
        'anticipo',
        'saldo',
        'estado'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Service::class, 'servicio_id');
    }
}
