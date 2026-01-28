@extends('layouts.admin')

@section('breadcrumb','Reservas')

@section('content')

<div class="card">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
        <h2>ðŸ“¸ Reservas</h2>
    </div>

    {{-- FILTROS --}}
    <form method="GET" class="filters">
        <select name="estado">
            <option value="">Todos los estados</option>
            @foreach(['pendiente','pendiente_confirmacion','anticipo_pagado','pagado','cancelado'] as $e)
                <option value="{{ $e }}" {{ request('estado')==$e?'selected':'' }}>
                    {{ str_replace('_',' ',$e) }}
                </option>
            @endforeach
        </select>

        <input type="date" name="fecha" value="{{ request('fecha') }}">

        <button type="submit" class="btn-sm">Filtrar</button>

        <a href="{{ route('admin.reservas.index') }}" class="link">Limpiar</a>
    </form>

    {{-- TABLA --}}
    <div class="table-responsive">
        @if (session('success'))
                <div style="background:#bbf7d0;padding:12px 18px;border-radius:12px;margin-bottom:20px">
                    {{ session('success') }}
                </div>
            @endif

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservas as $r)
                    <tr>
                        <td>{{ $r->fecha }}</td>
                        <td>{{ $r->hora }}</td>
                        <td>{{ $r->nombre }}</td>
                        <td>{{ $r->servicio->nombre ?? '-' }}</td>
                        <td>
                            <span class="badge estado-{{ $r->estado }}">
                                {{ str_replace('_',' ', $r->estado) }}
                            </span>
                        </td>
                           {{-- <td>
                            <a href="{{ route('admin.reservas.show',$r) }}" class="btn-sm">
                                Ver
                            </a>
                        </td> --}}
                            <td style="display:flex; gap:8px">

                                <a href="{{ route('admin.reservas.show', $r) }}" class="btn-sm">
                                    Ver
                                </a>

                                <form action="{{ route('admin.reservas.destroy', $r) }}" method="POST"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar esta reserva?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-sm" style="background:#b00020">
                                        🗑 Eliminar
                                    </button>
                                </form>

                            </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;color:#777;padding:30px">
                            No hay reservas con estos filtros
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
