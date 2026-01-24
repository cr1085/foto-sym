@extends('layouts.admin')

@section('breadcrumb', 'Servicios / Nuevo')

@section('content')

    <div class="card">
        <h3 style="margin-bottom:20px">➕ Nuevo servicio</h3>

        <form method="POST" action="{{ route('servicios.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label>Nombre</label>
                    <input name="nombre" required>
                </div>

                <div class="form-group">
                    <label>Duración (min)</label>
                    <input name="duracion_minutos" type="number" required>
                </div>

                <div class="form-group">
                    <label>Precio</label>
                    <input name="precio" type="number" required>
                </div>

                <div class="form-group">
                    <label>Imagen del servicio</label>
                    <input type="file" name="imagen" accept="image/*">
                </div>


            </div>

            <div class="form-actions">
                <button class="btn">Guardar</button>
                <a href="{{ route('servicios.index') }}" class="btn btn-outline">Cancelar</a>
            </div>
        </form>
    </div>

@endsection
