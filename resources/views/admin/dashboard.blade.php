@extends('layouts.admin')

@section('breadcrumb', 'Dashboard')

@section('content')

 <h1 style="margin-bottom:30px">Bienvenid@ Admin Sym Foto Digital 👋</h1>

{{-- MÉTRICAS --}}
<div class="dashboard-metrics">
    <div class="card metric">
        <h3>Reservas totales</h3>
        <p>{{ $total }}</p>
    </div>

    <div class="card metric">
        <h3>Pendientes</h3>
        <p>{{ $pendiente }}</p>
    </div>

    <div class="card metric">
        <h3>Pagadas</h3>
        <p>{{ $pagado }}</p>
    </div>
</div>

{{-- GRÁFICA --}}
<div class="dashboard-chart">
    <div class="card">
        <h3>Estado de reservas</h3>
        <canvas id="reservasChart"></canvas>
    </div>
</div>

{{-- ÚLTIMAS RESERVAS --}}
<div class="dashboard-table">
    <div class="card">
        <h3 style="margin-bottom:15px">Últimas reservas</h3>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Servicio</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ultimas as $r)
                        <tr>
                            <td>{{ $r->fecha }} {{ $r->hora }}</td>
                            <td>{{ $r->nombre }}</td>
                            <td>{{ $r->servicio->nombre ?? '-' }}</td>
                            <td>
                                <span class="badge estado-{{ $r->estado }}">
                                    {{ str_replace('_', ' ', $r->estado) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.reservas.show', $r) }}" class="btn-sm">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('reservasChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pendiente', 'Por confirmar', 'Pagado', 'Cancelado'],
                datasets: [{
                    data: [
                        {{ $pendiente }},
                        {{ $confirmacion }},
                        {{ $pagado }},
                        {{ $cancelado }}
                    ],
                    backgroundColor: ['#fbbf24', '#a855f7', '#22c55e', '#ef4444']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

@endsection
