<!DOCTYPE html>
<html>

<head>
    <title>Fotos & Momentos - Reservas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- @vite(['resources/css/app.css']) --}}

</head>

<body>

    <div class="container mx-auto p-8">

        <h1 class="text-3xl font-bold mb-6">
            📸 Reserva tu sesión
        </h1>

        @if (session('ok'))
            <div class="bg-green-200 p-4 mb-4">
                {{ session('ok') }}
            </div>
        @endif


        {{-- <form action="/reservar" method="POST" class="space-y-3">

        @csrf

        <input name="nombre" placeholder="Nombre"
        class="border p-2 w-full">

        <input name="email" placeholder="Email"
        class="border p-2 w-full">

        <input name="telefono" placeholder="Teléfono"
        class="border p-2 w-full">

        <input type="date" name="fecha"
        class="border p-2 w-full">

        <input type="time" name="hora"
        class="border p-2 w-full">

        <select name="tipo_evento" class="border p-2 w-full">
          <option>Boda</option>
          <option>Corporativo</option>
          <option>15 años</option>
        </select>

        <select name="paquete" class="border p-2 w-full">
          <option>Básico</option>
          <option>Premium</option>
        </select>

        <input name="valor_total" value="744000"
        class="border p-2 w-full">

        <button class="bg-black text-white p-3">
            Reservar
        </button>

    </form> --}}

        <form method="POST" action="/reservar" id="formReserva">
            @csrf

            <div>
                <label>Servicio</label>
                <select name="servicio_id" id="servicio">
                    <option value="">Seleccione...</option>
                </select>
            </div>

            <div>
                <label>Fecha</label>
                <input type="date" name="fecha" id="fecha">
            </div>

            <div>
                <label>Hora disponible</label>
                <select name="hora" id="hora">
                    <option value="">Seleccione fecha primero</option>
                </select>
            </div>

            <div>
                <label>Nombre</label>
                <input name="nombre" required>
            </div>

            <div>
                <label>Email</label>
                <input name="email" required>
            </div>

            <div>
                <label>Teléfono</label>
                <input name="telefono" required>
            </div>

            <button type="submit">
                Continuar al pago
            </button>

        </form>

        <script>
            const token = document.querySelector('meta[name="csrf-token"]').content;

            // 1. Cargar servicios al entrar
            fetch('/servicios-disponibles', {
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                })
                .then(r => r.json())
                .then(data => {

                    let select = document.getElementById('servicio');

                    data.forEach(s => {
                        select.innerHTML += `
            <option value="${s.id}">
                ${s.nombre} - $${s.precio}
            </option>
        `;
                    });
                });


            // 2. Cuando cambie fecha o servicio
            async function cargarHoras() {

                let fecha = document.getElementById('fecha').value;
                let servicio = document.getElementById('servicio').value;

                if (!fecha || !servicio) return;

                let res = await fetch(
                    `/horas-disponibles?fecha=${fecha}&servicio_id=${servicio}`, {
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    }
                );

                let horas = await res.json();

                let select = document.getElementById('hora');

                select.innerHTML = '';

                if (horas.length === 0) {
                    select.innerHTML = `
            <option>
                No hay horas disponibles
            </option>`;
                    return;
                }

                horas.forEach(h => {
                    select.innerHTML += `
            <option value="${h}">
                ${h}
            </option>`;
                });
            }

            document.getElementById('fecha')
                .addEventListener('change', cargarHoras);

            document.getElementById('servicio')
                .addEventListener('change', cargarHoras);
        </script>

    </div>

</body>

</html>
