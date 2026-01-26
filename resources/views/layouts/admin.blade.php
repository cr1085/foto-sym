<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">

    <title>Admin | Sym Foto Digital</title>

    <style>
        :root {
            --vinotinto: #6b0f3f;
        }

        body {
            margin: 0;
            font-family: Poppins, sans-serif;
            background: #f6f7fb;
        }

        header {
            background: var(--vinotinto);
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header a {
            color: white;
            margin-left: 25px;
            text-decoration: none;
            font-weight: 500;
        }

        /* .container {
    padding:30px;
} */

        .container {
            padding: 30px;
            max-width: 1200px;
            margin: auto;
        }


        .breadcrumb {
            font-size: 14px;
            margin-bottom: 25px;
            color: #666;
        }

        .breadcrumb a {
            color: var(--vinotinto);
            font-weight: 600;
            text-decoration: none;
        }

        /* .grid {
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:25px;
} */

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }


        /* .card {
    background:white;
    border-radius:18px;
    padding:30px;
    box-shadow:0 10px 25px rgba(0,0,0,.05);
} */


        .card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
        }


        /* .card h3 {
    margin:0 0 10px;
    color:var(--vinotinto);
} */

        .card h3 {
            font-size: 16px;
            margin-bottom: 8px;
            color: var(--vinotinto);
        }


        .card p {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
        }

        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 22px;
            background: var(--vinotinto);
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
        }

        /* .admin-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.admin-table th,
.admin-table td {
    padding: 12px 10px;
    border-bottom: 1px solid #eee;
}

.admin-table th {
    text-align: left;
    color: #555;
} */

        /* .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .admin-table th {
            background: #f4f4f4;
            text-align: left;
            padding: 14px;
            font-weight: 600;
        }

        .admin-table td {
            padding: 14px;
            border-bottom: 1px solid #eee;
        }

        .admin-table tr:hover {
            background: #fafafa;
        } */



        /* .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
            font-size: 14px;
        }

        .admin-table thead th {
            font-weight: 600;
            color: #555;
            padding-bottom: 10px;
        }

        .admin-table tbody tr {
            background: #fafafa;
            border-radius: 12px;
        }

        .admin-table td {
            padding: 14px;
        } */



        .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            font-size: 14px;
        }

        .admin-table thead th {
            padding: 14px;
            font-weight: 600;
            color: #555;
            text-align: left;
        }

        .admin-table tbody tr {
            background: #fafafa;
            border-radius: 12px;
        }

        .admin-table td {
            padding: 14px;
        }



        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* .estado-pendiente { background:#fde68a; }
.estado-pendiente_confirmacion { background:#e9d5ff; }
.estado-pagado { background:#bbf7d0; }
.estado-cancelado { background:#fecaca; } */

        .estado-pendiente {
            background: #fde68a;
        }

        .estado-pendiente_confirmacion {
            background: #e9d5ff;
        }

        .estado-pagado {
            background: #bbf7d0;
        }

        .estado-cancelado {
            background: #fecaca;
        }


        .btn-sm {
            padding: 6px 14px;
            border-radius: 20px;
            background: #6b0f3f;
            color: white;
            font-size: 13px;
            text-decoration: none;
        }

        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filters select,
        .filters input {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }


        .chart-card {
            max-width: 500px;
        }

        .chart-card canvas {
            max-width: 100%;
            height: auto !important;
        }


        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            header nav a {
                margin-left: 0;
                margin-right: 15px;
            }
        }


        /* Responsive tables */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        /* Cards más compactas */
        .card p {
            font-size: 22px;
        }

        /* Mobile adjustments */
        @media (max-width: 768px) {

            .container {
                padding: 15px;
            }

            h1 {
                font-size: 22px;
            }

            header {
                padding: 15px;
            }

            header nav {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .admin-table th,
            .admin-table td {
                padding: 10px;
                font-size: 13px;
                white-space: nowrap;
            }

            .btn-sm {
                padding: 6px 12px;
                font-size: 12px;
            }

            .chart-card {
                max-width: 100%;
            }
        }


        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .form-actions {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        .btn-outline {
            background: white;
            color: var(--vinotinto);
            border: 1px solid var(--vinotinto);
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 30px;
            margin-top: 30px;
        }

        @media (max-width: 900px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }


        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }


        /* ===== DASHBOARD ===== */

        .dashboard-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .metric {
            text-align: center;
        }

        .metric p {
            font-size: 32px;
            margin-top: 10px;
        }

        .dashboard-chart {
            max-width: 520px;
            margin-bottom: 40px;
        }

        .dashboard-chart canvas {
            max-width: 100%;
            height: 260px !important;
        }

        .dashboard-table {
            margin-bottom: 40px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-chart {
                max-width: 100%;
            }
        }

        .table-responsive {
            overflow-x: auto;
        }

        /* ===== FORM SERVICIOS UX ===== */

        .service-form-card {
            max-width: 820px;
            margin: auto;
        }

        .form-header {
            margin-bottom: 30px;
        }

        .form-header h3 {
            margin: 0;
            color: var(--vinotinto);
        }

        .form-header p {
            margin: 4px 0 0;
            font-size: 14px;
            color: #777;
        }

        /* Grid específico para servicios */
        .form-grid-services {
            grid-template-columns: 1fr 160px 200px;
            align-items: end;
        }

        .form-group-wide {
            grid-column: span 1;
        }

        /* Inputs más elegantes */
        .form-group input {
            height: 44px;
            border-radius: 12px;
            transition: border .2s, box-shadow .2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--vinotinto);
            box-shadow: 0 0 0 3px rgba(107, 15, 63, .08);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-grid-services {
                grid-template-columns: 1fr;
            }
        }

        /* ===== Crear usuario (Admin) ===== */

        .admin-form-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .user-card {
            width: 100%;
            max-width: 520px;
            padding: 30px 35px;
        }

        .form-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 25px;
            color: var(--vinotinto);
        }

        .user-card .form-group {
            margin-bottom: 18px;
        }

        .user-card .form-group label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
        }

        .user-card input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .user-card input:focus {
            outline: none;
            border-color: var(--vinotinto);
            box-shadow: 0 0 0 2px rgba(107, 15, 63, .08);
        }

        .user-card .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 25px;
            justify-content: flex-start;
        }
    </style>
</head>

<body>

    <header>
        <strong>Panel Admin</strong>

        <nav>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.reservas.index') }}">Reservas</a>
            <a href="{{ route('servicios.index') }}">Servicios</a>
            {{-- <a href="/" target="_blank">Ver sitio</a> --}}
            <a href="{{ route('admin.galeria.index') }}" class="btn btn-primary"
                style="margin-top:15px; display:inline-block">
                🖼️ Administrar galería
            </a>

            <a href="/">Ver sitio</a>
            <a href="{{ route('admin.usuarios.create') }}">
                Crear usuario
            </a>

        </nav>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit"
                style="
            background: transparent;
            border: none;
            color: white;
            font-weight: 500;
            cursor: pointer;
            margin-left: 25px;
        ">
                Cerrar sesión
            </button>
        </form>

    </header>

    <div class="container">

        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Admin</a> / @yield('breadcrumb')
        </div>

        @yield('content')

    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('reservasChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    'Pendiente',
                    'Por confirmar',
                    'Pagado',
                    'Cancelado'
                ],
                datasets: [{
                    data: [
                        {{ $pendiente }},
                        {{ $confirmacion }},
                        {{ $pagado }},
                        {{ $cancelado }}
                    ],
                    backgroundColor: [
                        '#fbbf24',
                        '#a855f7',
                        '#22c55e',
                        '#ef4444'
                    ]
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script> --}}



    {{-- @if (isset($pendiente))
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('reservasChart');

            if (ctx) {
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: [
                            'Pendiente',
                            'Por confirmar',
                            'Pagado',
                            'Cancelado'
                        ],
                        datasets: [{
                            data: [
                                {{ $pendiente }},
                                {{ $confirmacion }},
                                {{ $pagado }},
                                {{ $cancelado }}
                            ],
                            backgroundColor: [
                                '#fbbf24',
                                '#a855f7',
                                '#22c55e',
                                '#ef4444'
                            ]
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
        </script>
    @endif --}}


</body>

</html>
