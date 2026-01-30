@extends('layouts.public')

@section('content')
    <section class="section">
        <h2>Servicios</h2>
@if(!empty($servicio->descripcion))
    <p class="service-desc">
        {{ $servicio->descripcion }}
    </p>
@endif

        <div class="services-grid">

            @foreach ($servicios as $s)
                <div class="service-card">

                    <div class="service-image">
                        {{-- <img src="{{ asset('storage/servicios/'.$s->imagen) }}" alt="{{ $s->nombre }}"> --}}
                        {{-- <img src="{{ asset('storage/' . $s->imagen) }}" alt="{{ $s->nombre }}"> --}}

                        <img src="{{ asset('storage/' . $s->imagen) }}" alt="{{ $s->nombre }}"
                            onclick="openLightbox(
        '{{ asset('storage/' . $s->imagen) }}',
        '{{ $s->nombre }}',
        '{{ number_format($s->precio) }}'
    )"
                            style="cursor:pointer">


                    </div>

                    <div class="service-body">
                        <h3>{{ $s->nombre }}</h3>

                        <p class="service-desc">
                            {{ $s->descripcion }}
                        </p>

                        <p class="service-price">
                            ${{ number_format($s->precio) }}
                        </p>

                        <div class="service-actions">
                            {{-- <a href="{{ route('reservas') }}" class="btn-primary">
                                Reservar
                            </a> --}}

                            <a href="{{ route('reservas', ['servicio' => $s->id]) }}" class="btn-primary">
                                Reservar
                            </a>


                            <a href="https://wa.me/573016752947?text=Hola,%20quiero%20informaci��n%20sobre%20{{ urlencode($s->nombre) }}"
                                target="_blank" class="btn-whatsapp">
                                WhatsApp
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </section>
@endsection
