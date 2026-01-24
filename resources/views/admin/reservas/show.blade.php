@extends('layouts.admin')

@section('breadcrumb','Reservas / Detalle')

@section('content')

<div class="card">

    <h3 style="margin-bottom:20px">📸 Detalle de reserva</h3>

    <div class="form-grid">

        <div><strong>Cliente:</strong><br>{{ $reservation->nombre }}</div>
        <div><strong>Email:</strong><br>{{ $reservation->email }}</div>
        <div><strong>Teléfono:</strong><br>{{ $reservation->telefono }}</div>
        <div><strong>Servicio:</strong><br>{{ $reservation->servicio->nombre ?? '-' }}</div>
        <div><strong>Fecha:</strong><br>{{ $reservation->fecha }}</div>
        <div><strong>Hora:</strong><br>{{ $reservation->hora }}</div>

    </div>

    <form method="POST"
          action="{{ route('admin.reservas.estado',$reservation) }}"
          style="margin-top:25px">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label>Estado</label>
                <select name="estado">
                    @foreach(['pendiente','pendiente_confirmacion','pagado','cancelado'] as $e)
                        <option value="{{ $e }}" @selected($reservation->estado==$e)>
                            {{ ucfirst(str_replace('_',' ',$e)) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button class="btn">Actualizar estado</button>
            <a href="{{ route('admin.reservas.index') }}" class="btn btn-outline">Volver</a>
        </div>
    </form>

</div>

@endsection
