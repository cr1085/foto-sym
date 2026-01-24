@extends('layouts.public')

@section('content')
    <section class="section">
        <h2>Servicios</h2>

        <div class="services-grid">

            @foreach ($servicios as $s)
                <div class="service-card">

                    <div class="service-image">
                        {{-- <img src="{{ asset('storage/servicios/'.$s->imagen) }}" alt="{{ $s->nombre }}"> --}}
                        <img src="{{ asset('storage/' . $s->imagen) }}" alt="{{ $s->nombre }}">

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
                            <a href="{{ route('reservas') }}" class="btn-primary">
                                Reservar
                            </a>

                            <a href="https://wa.me/573XXXXXXXXX?text=Hola,%20quiero%20información%20sobre%20{{ urlencode($s->nombre) }}"
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
