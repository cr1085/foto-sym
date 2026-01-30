@extends('layouts.public')

@section('content')
<div style="padding:20px">

    <h2>🧪 Debug Agenda</h2>

    <p><strong>Fecha:</strong> {{ $fecha }}</p>
    <p><strong>Servicio ID:</strong> {{ $servicioId }}</p>

    <hr>

    <h3>Horas devueltas:</h3>

    @if (empty($horas))
        <p style="color:red;">❌ No se generaron horarios</p>
    @else
        <ul>
            @foreach ($horas as $hora)
                <li>{{ $hora }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection
