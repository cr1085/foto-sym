{{-- @extends('layouts.app') --}}
@extends('layouts.public')


@section('content')
    <div class="booking-wrapper">

        <h1 class="text-3xl font-bold mb-6">
            📸 Reserva tu sesión
        </h1>

        @if (session('ok'))
            <div class="bg-green-200 p-4 mb-4">
                {{ session('ok') }}
            </div>
        @endif
        @if (session('ok'))
            <div class="bg-white border rounded-lg p-5 mb-6">
                <h2 class="text-xl font-semibold mb-3">
                    🎉 Reserva registrada
                </h2>

                <p class="mb-4 text-gray-700">
                    Tu sesión ha sido agendada. Para confirmar definitivamente,
                    puedes realizar el pago o comunicarte con nosotros.
                </p>

                <div style="display:flex; gap:15px; flex-wrap:wrap;">
                    <!-- Botón de pago -->
                    <a href="{{ route('pago.lite') }}" class="btn btn-primary"
                        style="background:#4f46e5;color:white;padding:10px 18px;border-radius:8px;text-decoration:none;">
                        💳 Realizar pago</a>

                    <!-- Botón WhatsApp -->
                    <a href="https://wa.me/573016752947?text=Hola,%20realicé%20una%20reserva%20y%20deseo%20confirmarla"
                        target="_blank" class="btn btn-success"
                        style="background:#25D366;color:white;padding:10px 18px;border-radius:8px;text-decoration:none;">
                        💬 Conversar por WhatsApp
                    </a>
                </div>
            </div>
        @endif


        <form method="POST" action="/reservar" id="formReserva">
            @csrf

            <div>
                <label>Servicio</label>
                {{-- <select name="servicio_id" id="servicio">
                    <option value="">Seleccione...</option>
                </select> --}}
                <select name="servicio_id" id="servicio" required>
                    <option value="">Seleccione un servicio</option>

                    @foreach ($servicios as $servicio)
                        <option value="{{ $servicio->id }}"
                            {{ old('servicio_id', $servicioSeleccionado) == $servicio->id ? 'selected' : '' }}>
                            {{ $servicio->nombre }} - ${{ number_format($servicio->precio) }}
                        </option>
                    @endforeach
                </select>

            </div>

            <div>
                <label>Fecha</label>
                <input type="date" name="fecha" id="fecha" min="{{ date('Y-m-d') }}">
            </div>

            <div>
                <label>Hora disponible</label>
                <select name="hora" id="hora" disabled>
                    <option value="">Seleccione fecha primero</option>
                </select>
            </div>
            <div id="msgHoras" class="msg-horas"></div>

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
                Reservar ahora
            </button>

            <p style="font-size:13px;color:#777;margin-top:10px">
                El pago se coordina después de confirmar disponibilidad.
            </p>


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



            async function cargarHoras() {

                let msg = document.getElementById('msgHoras');
                msg.style.display = 'none';
                msg.innerHTML = '';


                const btn = document.querySelector('button[type="submit"]');
                btn.disabled = true;

                let fecha = document.getElementById('fecha').value;
                let servicio = document.getElementById('servicio').value;
                let select = document.getElementById('hora');

                // Reset
                select.innerHTML = '';
                select.disabled = true;

                if (!fecha || !servicio) {
                    select.innerHTML = `<option>Seleccione servicio y fecha</option>`;
                    return;
                }

                // Feedback de carga
                // select.innerHTML = `<option>Cargando horarios...</option>`;
                select.innerHTML = `<option class="loading-option">⏳ Cargando horarios...</option>`;


                try {
                    let res = await fetch(
                        `/horas-disponibles?fecha=${fecha}&servicio_id=${servicio}`
                    );

                    let horas = await res.json();

                    select.innerHTML = '';

                    //         if (!horas || horas.length === 0) {
                    //             select.innerHTML = `
            //     <option>No hay horarios disponibles ese día</option>
            // `;
                    //             return;
                    //         }

                    if (!horas || horas.length === 0) {
                        select.innerHTML = `<option>No hay horarios disponibles</option>`;

                        msg.innerHTML = `
       ⏰ En este momento no tenemos horarios disponibles.<br>
Nuestro próximo horario disponible es más tarde.<br>
Por favor intenta nuevamente o elige otra fecha.
        Intenta otra fecha o escríbenos por WhatsApp.
    `;
                        msg.style.display = 'block';

                        return;
                    }


                    // Hay horas → habilitamos select
                    select.disabled = false;

                    btn.disabled = false;
                    msg.style.display = 'none';


                    horas.forEach(h => {
                        select.innerHTML += `
                <option value="${h}">${h}</option>
            `;
                    });

                } catch (e) {
                    console.error('Error al cargar horarios:', e);
                    select.innerHTML = `<option>Error al cargar horarios</option>`;
                }
            }


            document.getElementById('fecha')
                .addEventListener('change', cargarHoras);

            document.getElementById('servicio')
                .addEventListener('change', cargarHoras);
        </script>

    </div>
@endsection
