<h1>Crear servicio</h1>

<form method="POST" action="/admin/servicios">
@csrf

<input name="nombre" placeholder="Nombre">
<input name="duracion_minutos" placeholder="Minutos">
<input name="precio" placeholder="Precio">

<button>Guardar</button>

</form>
