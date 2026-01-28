<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sym Foto Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
   {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">

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
            {{-- <a href="#">Contacto</a>
             --}}
            <a href="{{ route('galeria.public') }}">Galería</a>
            <a href="{{ route('contacto') }}">Contacto</a>
            <a href="{{ route('login') }}">Admin</a>

        </nav>
    </header>

    @yield('content')

    {{-- <div id="lightbox"
        style="display:none; position:fixed; inset:0;
            background:rgba(0,0,0,.9);
            justify-content:center; align-items:center;
            z-index:9999"
        onclick="closeLightbox()">

        <img id="lightbox-img" style="max-width:90%; max-height:90%; border-radius:12px">
    </div> --}}

    {{-- <div id="lightbox"
        style="display:none; position:fixed; inset:0;
            background:rgba(0,0,0,.9);
            justify-content:center; align-items:center;
            z-index:9999">

        <div style="position:relative; text-align:center">
            <img id="lightbox-img" style="max-width:90vw; max-height:80vh; border-radius:12px">

            <a id="whatsapp-btn" target="_blank" style="display:inline-block;margin-top:15px" class="btn-whatsapp">
                Consultar por WhatsApp
            </a>
        </div>
    </div> --}}

    {{-- <div id="lightbox" onclick="closeLightbox()"
        style="
        display:none;
        position:fixed;
        inset:0;
        background:rgba(0,0,0,.9);
        z-index:9999;
        align-items:center;
        justify-content:center;
     ">

        <div onclick="event.stopPropagation()" style="text-align:center">
            <img id="lightbox-img" style="max-width:90vw; max-height:85vh; border-radius:12px">

            <a id="whatsapp-btn" target="_blank" class="btn-whatsapp" style="display:inline-block;margin-top:15px">
                Consultar por WhatsApp
            </a>
        </div>
    </div> --}}


    <div id="lightbox"
        style="display:none; position:fixed; inset:0;
            background:rgba(0,0,0,.9);
            justify-content:center; align-items:center;
            z-index:9999"
        onclick="closeLightbox()">




        <div style="position:relative; text-align:center" onclick="event.stopPropagation()">

            <img id="lightbox-img" style="max-width:90vw; max-height:80vh; border-radius:12px">

            <a id="whatsapp-btn" target="_blank" class="btn-whatsapp" style="display:inline-block;margin-top:15px">
                Consultar por WhatsApp
            </a>

             <button onclick="closeLightbox()"
        style="
            position:absolute;
            top:-40px;
            right:0;
            background:none;
            border:none;
            font-size:30px;
            color:white;
            cursor:pointer;">
    ✕
</button>
        </div>
    </div>


    <script>
        function openLightbox(src, titulo = '', precio = '') {

            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            const btn = document.getElementById('whatsapp-btn');

            if (!lightbox || !img) {
                console.error('Lightbox no encontrado');
                return;
            }

            img.src = src;

            const msg =
                `Hola, me interesa esta imagen:
${titulo}
Precio: ${precio || 'Consultar'}
Imagen: ${src}`;

            btn.href = 'https://wa.me/573016752947?text=' + encodeURIComponent(msg);

            lightbox.style.display = 'flex';
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }
    </script>


    {{-- <script>
        function openLightbox(src, titulo, precio) {

            document.getElementById('lightbox-img').src = src;

            const msg =
                `Hola, me interesa esta imagen:
                 ${titulo}
                 Precio: ${precio ?? 'Consultar'}
                 Imagen: ${src}`;

            document.getElementById('whatsapp-btn').href =
                'https://wa.me/573016752947?text=' + encodeURIComponent(msg);

            document.getElementById('lightbox').style.display = 'flex';
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }
    </script> --}}


    {{-- <script>
        function openLightbox(src) {
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox').style.display = 'flex';
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }
    </script> --}}


    {{-- <script>
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', () => {

                document.querySelectorAll('.filter-btn')
                    .forEach(b => b.classList.remove('active'));

                btn.classList.add('active');

                const filter = btn.dataset.filter;

                document.querySelectorAll('.gallery-card').forEach(card => {
                    if (filter === 'all' || card.dataset.category === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script> --}}
    <script>
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', () => {

                document.querySelectorAll('.filter-btn')
                    .forEach(b => b.classList.remove('active'));

                btn.classList.add('active');

                const filter = btn.dataset.filter;

                document.querySelectorAll('.gallery-card').forEach(card => {
                    if (filter === 'all' || card.dataset.category === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>


    <footer>
        <p>© 2026 Sym Foto Digital</p>
    </footer>

</body>

</html>
