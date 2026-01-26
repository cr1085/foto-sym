@extends('layouts.admin')

@section('breadcrumb', 'Galería / Nueva imagen')

@section('content')

<div class="card" style="max-width:700px;margin:auto">

    <h3 style="margin-bottom:10px">📸 Nueva imagen</h3>
    <p style="color:#777;font-size:14px;margin-bottom:25px">
        Agrega una imagen a la galería del portafolio
    </p>

    <form method="POST"
          action="{{ route('admin.galeria.store') }}"
          enctype="multipart/form-data">

        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>Título</label>
                <input name="titulo" required>
            </div>

            <div class="form-group">
                <label>Categoría</label>
                <input name="categoria" placeholder="Ej: Bodas, Retrato, Producto" required>
            </div>

            <div class="form-group">
                <label>Precio (opcional)</label>
                <input type="number" name="precio">
            </div>

            <div class="form-group">
                <label>Imagen</label>
                <input type="file" name="imagen" accept="image/*" required>
            </div>

        </div>

        <div class="form-actions">
            <button class="btn">Guardar imagen</button>
            <a href="{{ route('admin.galeria.index') }}" class="btn btn-outline">
                Cancelar
            </a>
        </div>

    </form>

</div>

@endsection
