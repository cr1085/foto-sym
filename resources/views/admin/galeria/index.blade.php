@extends('layouts.admin')

@section('breadcrumb', 'Galería')

@section('content')

     <section class="section">
        <h2>Galería</h2>

      <div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
        <h2>Galería</h2>
        <a href="{{ route('admin.galeria.create') }}" class="btn">
            + Nueva imagen
        </a>
    </div>
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
                <div class="gallery-card" data-category="{{ $g->categoria }}">

                    <img src="{{ asset('storage/' . $g->imagen) }}" alt="{{ $g->titulo }}"
                        onclick="openLightbox('{{ asset('storage/' . $g->imagen) }}')">

                    <a href="https://wa.me/573016752947?text={{ urlencode(
                        'Hola, me interesa esta imagen: ' . $g->titulo . ($g->precio ? ' | Precio: $' . number_format($g->precio) : ''),
                    ) }}"
                        target="_blank" class="whatsapp-float">
                        💬
                    </a>
                    
                    {{-- BOTÓN BORRAR --}}
                        <form action="{{ route('admin.galeria.destroy', $g->id) }}" method="POST"
                            onsubmit="return confirm('¿Seguro que deseas eliminar esta imagen?')" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">🗑</button>
                        </form>

                </div>
            @endforeach

        </div>


    </section>
@endsection
