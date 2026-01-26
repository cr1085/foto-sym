{{-- @extends('layouts.app')
 --}}

 @extends('layouts.public')

@section('content')

<section class="hero">
    <div>
        <h1>Creamos experiencias visuales<br>que conectan marcas y emociones</h1>
        <p>
            Fotografía profesional, marketing visual y producción de eventos.
            En Sym Foto Digital transformamos ideas en imágenes que impactan.
        </p>

        <div class="actions">
            <a href="{{ route('reservas') }}" class="btn-primary">Agendar sesión</a>
            {{-- <a href="#">Ver servicios</a> --}}
            {{-- <a href="{{ route('servicios') }}">Ver servicios</a> --}}
            <a href="{{ route('galeria.public') }}">Ver portafolio</a>
            {{-- <a href="{{ route('servicios.public') }}">Ver servicios</a> --}}


        </div>
    </div>

    <img src="{{ asset('assets/images/hero.png') }}" alt="Sym Foto Digital">
</section>

<section class="section">
    <h2>¿Qué hacemos?</h2>

    <div class="services">
        <div class="card">
            <h3>Fotografía Profesional</h3>
            <p>Estudio, bebés, familiar y eventos.</p>
        </div>

        <div class="card">
            <h3>Marketing Visual</h3>
            <p>Contenido creativo para marcas.</p>
        </div>

        <div class="card">
            <h3>Eventos & Producción</h3>
            <p>Cubrimos eventos sociales y corporativos.</p>
        </div>
    </div>
</section>

<section class="section socials-section">
    <h2>Síguenos en redes sociales</h2>
    <p class="socials-subtitle">
        Conoce nuestro trabajo, promociones y últimas sesiones
    </p>

    <div class="socials-grid">
        <a href="https://www.instagram.com/symfotodigital/?hl=es"
           target="_blank"
           class="social-card instagram">
            <span>Instagram</span>
        </a>

        <a href="https://www.facebook.com/symfotodigital/?locale=es_LA"
           target="_blank"
           class="social-card facebook">
            <span>Facebook</span>
        </a>

        <a href="https://www.tiktok.com/@symfotodigital"
           target="_blank"
           class="social-card tiktok">
            <span>TikTok</span>
        </a>
    </div>
</section>


<section class="cta">
    <h2>Agenda tu sesión en pocos pasos</h2>
    <p>Consulta disponibilidad y reserva tu fecha fácilmente.</p>
    <br>
    <a href="{{ route('reservas') }}" class="btn-primary">Ir a reservas</a>
</section>


@endsection
