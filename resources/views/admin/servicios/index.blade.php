@extends('layouts.admin')

@section('breadcrumb','Servicios')

@section('content')

<div class="card">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
        <h2>🛠 Servicios</h2>

        <a href="{{ route('servicios.create') }}" class="btn">
            + Nuevo servicio
        </a>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Duración</th>
                    <th>Precio</th>
                    <th style="width:120px"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($servicios as $s)
                    <tr>
                        <td><strong>{{ $s->nombre }}</strong></td>
                        <td>{{ $s->duracion_minutos }} min</td>
                        <td>${{ number_format($s->precio,0,',','.') }}</td>
                        <td>
                            <a href="{{ route('servicios.edit',$s) }}" class="btn-sm">
                                Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;color:#777;padding:30px">
                            No hay servicios creados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
