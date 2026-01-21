<h1>Servicios</h1>

@if(session('ok'))
<div>{{ session('ok') }}</div>
@endif

<a href="/admin/servicios/create">Nuevo</a>

<table border="1">
<tr>
    <th>Nombre</th>
    <th>Duración</th>
    <th>Precio</th>
    <th></th>
</tr>

@foreach($servicios as $s)
<tr>
    <td>{{ $s->nombre }}</td>
    <td>{{ $s->duracion_minutos }} min</td>
    <td>${{ $s->precio }}</td>

    <td>
        <a href="/admin/servicios/{{ $s->id }}/edit">
            Editar
        </a>
    </td>
</tr>
@endforeach

</table>
