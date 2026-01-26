@extends('layouts.admin')

@section('breadcrumb', 'Galería')

@section('content')

<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
        <h2>🖼 Galería</h2>

        <a href="{{ route('admin.galeria.create') }}" class="btn">
            + Nueva imagen
        </a>
    </div>

    @if(session('ok'))
        <div style="background:#dcfce7;padding:12px;border-radius:8px;margin-bottom:15px">
            {{ session('ok') }}
        </div>
    @endif

    <div class="services-grid">

        @foreach($galerias as $g)
            <div class="service-card">

                <div class="service-image">
                    <img src="{{ asset('storage/'.$g->imagen) }}" alt="{{ $g->titulo }}">
                </div>

                <div class="service-body">
                    <h3>{{ $g->titulo }}</h3>

                    <p style="font-size:13px;color:#666">
                        {{ $g->categoria }}
                    </p>

                    @if($g->precio)
                        <p class="service-price">
                            ${{ number_format($g->precio) }}
                        </p>
                    @endif
                </div>

            </div>
        @endforeach

    </div>
</div>

@endsection
