@extends('layouts.public')

@section('content')
    <section class="section">
        <h2>Galería</h2>

        {{-- <div class="gallery-filters">
            <button class="filter-btn active" data-filter="all">Todos</button>

            @foreach ($galerias->pluck('categoria')->unique() as $cat)
                <button class="filter-btn" data-filter="{{ Str::slug($cat) }}">
                    {{ $cat }}
                </button>
            @endforeach
        </div> --}}

        <div class="gallery-filters">
            <button class="filter-btn active" data-filter="all">Todos</button>

            @foreach ($categorias as $cat)
                <button class="filter-btn" data-filter="{{ $cat }}">
                    {{ ucfirst($cat) }}
                </button>
            @endforeach
        </div>


        <div class="gallery-grid">

            @foreach ($galerias as $g)
                {{-- <div class="gallery-card" onclick="openLightbox('{{ asset('storage/' . $g->imagen) }}')"> --}}
                {{-- <div class="gallery-card" data-category="{{ $g->categoria }}">

                    <img src="{{ asset('storage/' . $g->imagen) }}" alt="{{ $g->titulo }}"
                        onclick="openLightbox(
    '{{ asset('storage/' . $g->imagen) }}',
    '{{ $g->titulo }}',
    '{{ $g->precio }}'
)">

                    <a href="https://wa.me/573016752947?text={{ urlencode(
                        'Hola, me interesa esta imagen: ' . $g->titulo . ($g->precio ? ' | Precio: $' . number_format($g->precio) : ''),
                    ) }}"
                        target="_blank" class="whatsapp-float">
                        💬
                    </a>

                </div> --}}


                <div class="gallery-card"
     data-category="{{ $g->categoria }}"
     onclick="openLightbox(
        '{{ asset('storage/'.$g->imagen) }}',
        '{{ $g->titulo }}',
        '{{ $g->precio }}'
     )">

    <img src="{{ asset('storage/'.$g->imagen) }}" alt="{{ $g->titulo }}">

    <a href="https://wa.me/573016752947?text={{ urlencode(
        'Hola, me interesa esta imagen: '.$g->titulo
    ) }}"
       target="_blank"
       class="whatsapp-float"
       onclick="event.stopPropagation()">
        💬
    </a>

</div>

            @endforeach

        </div>


    </section>
@endsection
