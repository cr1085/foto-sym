{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html> --}}


{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Auth</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    {{ $slot }}
</body>
</html> --}}


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso | Sym Foto Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fuente -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --vinotinto: #6b0f3f;
        }

        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: #f6f7fb;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .auth-card {
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .auth-logo img {
            height: 60px;
        }

        h1 {
            text-align: center;
            font-size: 22px;
            color: var(--vinotinto);
            margin-bottom: 25px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #ddd;
            margin-top: 6px;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 12px;
            border-radius: 25px;
            border: none;
            background: var(--vinotinto);
            color: white;
            font-weight: 600;
            cursor: pointer;
        }

        .auth-links {
            margin-top: 15px;
            text-align: center;
            font-size: 13px;
        }

        .auth-links a {
            color: var(--vinotinto);
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>

<body>

<div class="auth-wrapper">
    <div class="auth-card">

        <div class="auth-logo">
            <img src="{{ asset('assets/images/logo.jpeg') }}" alt="Sym Foto Digital">
        </div>

        {{ $slot }}

    </div>
</div>

</body>
</html>

