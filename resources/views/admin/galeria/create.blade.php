@extends('layouts.admin')

@section('breadcrumb', 'Galería / Nueva imagen')

@section('content')

    <div class="card" style="max-width:700px;margin:auto">

        <h3 style="margin-bottom:10px">📸 Nueva imagen</h3>
        <small style="color:#999">
            Máx. 10 imágenes – 5MB cada una
        </small>
        <p style="color:#777;font-size:14px;margin-bottom:25px">
            Agrega una imagen a la galería del portafolio
        </p>

        <form method="POST" action="{{ route('admin.galeria.store') }}" enctype="multipart/form-data">

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
                    <input type="file" name="imagen" accept="image/*">
                </div>

            </div>

            <div class="form-group" style="margin-top:20px">
                <label>Imágenes múltiples (opcional)</label>
                <input type="file" name="imagenes[]" multiple>
                <small style="color:#777">
                    Puedes seleccionar varias imágenes para cargarlas con la misma categoría
                </small>
            </div>

            <div class="form-actions">
                {{-- <button class="btn">Guardar imagen</button> --}}
                <button class="btn" id="btn-submit">Guardar imagen</button>
                <a href="{{ route('admin.galeria.index') }}" class="btn btn-outline">
                    Cancelar
                </a>
            </div>


            <div id="loading" style="display:none; margin-top:20px; text-align:center">
                <strong>⏳ Subiendo imágenes, por favor espera...</strong>
            </div>


        </form>

    </div>


    <script>
        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            const loading = document.getElementById('loading');

            btn.disabled = true;
            btn.innerText = 'Cargando...';
            loading.style.display = 'block';

            // 🔥 fuerza repintado antes de enviar
            setTimeout(() => {}, 50);
        });
    </script>


    <script>
        const single = document.querySelector('input[name="imagen"]');
        const multiple = document.querySelector('input[name="imagenes[]"]');

        single.addEventListener('change', () => multiple.value = '');
        multiple.addEventListener('change', () => single.value = '');
    </script>

@endsection
