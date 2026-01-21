<h1>Editar servicio</h1>

<form method="POST" action="/admin/servicios/{{ $servicio->id }}">
@csrf
@method('PUT')

<input name="nombre" value="{{ $servicio->nombre }}">
<input name="duracion_minutos" value="{{ $servicio->duracion_minutos }}">
<input name="precio" value="{{ $servicio->precio }}">

<button>Actualizar</button>

</form>
