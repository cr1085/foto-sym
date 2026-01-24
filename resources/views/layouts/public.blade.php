<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sym Foto Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('head')
</head>

<body>

    <header>
        <img src="{{ asset('assets/images/logo.jpeg') }}" alt="Sym Foto Digital">

        <nav>
            <a href="{{ route('home') }}">Inicio</a>
            {{-- <a href="#">Servicios</a> --}}
            {{-- <a href="{{ route('servicios.public') }}">Servicios</a> --}}
            <a href="{{ route('servicios') }}">Servicios</a>
            {{-- <a href="{{ route('reservas') }}">Reservas</a> --}}
            <a href="#">Contacto</a>
            <a href="{{ route('login') }}">Admin</a>

        </nav>
    </header>

    @yield('content')

    <footer>
        <p>© 2026 Sym Foto Digital</p>
    </footer>

</body>

</html>
