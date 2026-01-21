<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('reservations', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });


        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('email');
            $table->string('telefono');

            $table->date('fecha');
            $table->time('hora');

            $table->string('tipo_evento');
            $table->string('paquete');

            $table->decimal('valor_total', 10, 2);
            $table->decimal('anticipo', 10, 2)->nullable();
            $table->decimal('saldo', 10, 2)->nullable();

            $table->enum('estado', [
                'pendiente',
                'anticipo_pagado',
                'pagado',
                'cancelado'
            ])->default('pendiente');

            $table->string('referencia_pago')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
