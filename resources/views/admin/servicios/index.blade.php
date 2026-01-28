@extends('layouts.admin')

@section('breadcrumb','Servicios')

@section('content')

<div class="card">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
        <h2>Servicios</h2>

        <a href="{{ route('servicios.create') }}" class="btn">
            + Nuevo servicio
        </a>
    </div>

    <div class="table-responsive">
          @if (session('success'))
                <div style="background:#bbf7d0;padding:12px 18px;border-radius:12px;margin-bottom:20px">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div style="background:#fecaca;padding:12px 18px;border-radius:12px;margin-bottom:20px">
                    {{ session('error') }}
                </div>
            @endif
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Duraci贸n</th>
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
                             {{-- <td>
                            <a href="{{ route('servicios.edit',$s) }}" class="btn-sm">
                                Editar
                            </a>
                        </td> --}}
                            <td style="display:flex; gap:8px">

                                <a href="{{ route('servicios.edit', $s) }}" class="btn-sm">
                                   Editar
                                </a>

                                <form action="{{ route('servicios.destroy', $s) }}" method="POST"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar este servicio?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-sm" style="background:#b00020">
                                         Eliminar
                                    </button>
                                </form>

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
