@extends('layouts.admin')

@section('breadcrumb', 'Servicios / Editar')

@section('content')

    <div class="card service-form-card">

        <div class="form-header">
            <h3>✏️ Editar servicio</h3>
            <p>Actualiza la información del servicio</p>
        </div>

        <form method="POST" action="{{ route('servicios.update', $servicio) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid form-grid-services">

                <div class="form-group form-group-wide">
                    <label>Nombre del servicio</label>
                    <input name="nombre" value="{{ $servicio->nombre }}" placeholder="Ej: Sesión básica" required>
                </div>

                <div class="form-group">
                    <label>Duración (min)</label>
                    <input name="duracion_minutos" type="number" value="{{ $servicio->duracion_minutos }}" placeholder="60"
                        required>
                </div>

                <div class="form-group">
                    <label>Precio</label>
                    <input name="precio" type="number" value="{{ $servicio->precio }}" placeholder="120000" required>
                </div>

                <div class="form-group">
                    <label>Descripción (opcional)</label>
                    <textarea name="descripcion" rows="4">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                </div>


                <div class="form-group">
                    <label>Imagen del servicio</label>
                    <input type="file" name="imagen" accept="image/*">
                </div>
                @if ($servicio->imagen)
                    <img src="{{ asset('storage/' . $servicio->imagen) }}"
                        style="max-width:150px;border-radius:12px;margin-bottom:10px">
                @endif


            </div>

            <div class="form-actions">
                <button class="btn">Actualizar servicio</button>
                <a href="{{ route('servicios.index') }}" class="btn btn-outline">Cancelar</a>
            </div>

        </form>

    </div>

@endsection
