@extends('layouts.public')

@section('content')

<section class="section">
    <h2>Portafolio</h2>

    <div class="services-grid">

        @foreach($galerias as $g)
            <div class="service-card">

                <div class="service-image">
                    <img src="{{ asset('storage/'.$g->imagen) }}" alt="{{ $g->titulo }}">
                </div>

                <div class="service-body">
                    <h3>{{ $g->titulo }}</h3>

                    <p style="font-size:13px;color:#777">
                        {{ $g->categoria }}
                    </p>

                    @if($g->precio)
                        <p class="service-price">
                            ${{ number_format($g->precio) }}
                        </p>
                    @endif

                    <div class="service-actions">

                        <a href="https://wa.me/573016752947
?text=Hola,%20me%20interesa%20este%20servicio:%20{{ urlencode($g->titulo) }}
%0APrecio:%20${{ number_format($g->precio) }}
%0AImagen:%20{{ asset('storage/'.$g->imagen) }}"
                           target="_blank"
                           class="btn-whatsapp">
                            Consultar por WhatsApp
                        </a>

                    </div>
                </div>

            </div>
        @endforeach

    </div>
</section>

@endsection
