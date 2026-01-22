<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE reservations
            MODIFY estado ENUM(
                'pendiente',
                'pendiente_confirmacion',
                'anticipo_pagado',
                'pagado',
                'cancelado'
            ) NOT NULL DEFAULT 'pendiente'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE reservations
            MODIFY estado ENUM(
                'pendiente',
                'anticipo_pagado',
                'pagado',
                'cancelado'
            ) NOT NULL DEFAULT 'pendiente'
        ");
    }
};
