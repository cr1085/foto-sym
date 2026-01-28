<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class GaleriaController extends Controller
{
    public function index()
    {
        // $galerias = Galeria::latest()->get();
        // return view('admin.galeria.index', compact('galerias'));}
        $galerias = Galeria::orderBy('categoria')->get();

        $categorias = Galeria::select('categoria')
            ->distinct()
            ->pluck('categoria');

        return view('admin.galeria.index', compact('galerias', 'categorias'));
    }

    public function create()
    {
        return view('admin.galeria.create');
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'titulo' => 'required',
    //         'categoria' => 'required',
    //         'precio' => 'nullable|numeric',
    //         'imagen' => 'required|image|max:5120',
    //     ]);

    //     //         // Guardar imagen
    //     //         $data['imagen'] = $request->file('imagen')->store('galeria', 'public');

    //     //         /*
    //     // |--------------------------------------------------------------------------
    //     // | COPIAR IMAGEN A public/storage/galeria (local y cPanel)
    //     // |--------------------------------------------------------------------------
    //     // */

    //     //         // origen real del archivo
    //     //         $source = storage_path('app/public/' . $data['imagen']);

    //     //         // destino público (local: /public, cPanel: /public_html)
    //     //         $destinationDir = public_path('storage/galeria');

    //     //         // crear carpeta si no existe (seguridad)
    //     //         if (!is_dir($destinationDir)) {
    //     //             mkdir($destinationDir, 0755, true);
    //     //         }

    //     //         // copiar archivo solo si existe el origen
    //     //         if (file_exists($source)) {
    //     //             copy($source, $destinationDir . '/' . basename($data['imagen']));
    //     //         }

    //     // Guardar imagen (NO se toca la lógica base)
    //     $path = $request->file('imagen')->store('galeria', 'public');
    //     $data['imagen'] = $path;

    //     // 1️⃣ ORIGEN REAL (igual que servicios)
    //     $origen = Storage::disk('public')->path($path);

    //     // 2️⃣ DESTINO en public_html/storage/galeria
    //     $destino = $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $path;

    //     // 3️⃣ Crear carpeta si no existe
    //     if (!file_exists(dirname($destino))) {
    //         mkdir(dirname($destino), 0755, true);
    //     }

    //     // 4️⃣ Copiar archivo
    //     copy($origen, $destino);


    //     Galeria::create($data);

    //     return redirect()->route('admin.galeria.index')
    //         ->with('ok', 'Imagen agregada a la galería');
    // }


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'nullable|string',
            'categoria' => 'required',
            'precio' => 'nullable|numeric',
            'imagen' => 'nullable|image|max:51200',
            'imagenes.*' => 'image|max:51200',
        ]);

        // 🔹 CASO 1: CARGA MÚLTIPLE
        if ($request->hasFile('imagenes')) {

            foreach ($request->file('imagenes') as $img) {

                $nombre = uniqid() . '.jpg';
                $path = 'galeria/' . $nombre;

                // optimizar
                $image = $this->optimizarImagen($img);

                // 1️⃣ guardar optimizada en storage/app/public
                Storage::disk('public')->put(
                    $path,
                    (string) $image->toJpeg(80)
                );

                // 2️⃣ ORIGEN REAL (ya existe)
                $origen = Storage::disk('public')->path($path);

                // 3️⃣ DESTINO PUBLICO (local o cPanel)
                $destino = $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $path;

                // 4️⃣ crear carpeta si no existe
                if (!file_exists(dirname($destino))) {
                    mkdir(dirname($destino), 0755, true);
                }

                // 5️⃣ copiar archivo
                copy($origen, $destino);

                Galeria::create([
                    'titulo' => pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME),
                    'categoria' => $request->categoria,
                    'precio' => $request->precio,
                    'imagen' => $path,
                ]);
            }
        }
        // 🔹 CASO 2: IMAGEN ÚNICA
        elseif ($request->hasFile('imagen')) {

            $img = $request->file('imagen');

            $nombre = uniqid() . '.jpg';
            $path = 'galeria/' . $nombre;

            $image = $this->optimizarImagen($img);

            Storage::disk('public')->put(
                $path,
                (string) $image->toJpeg(80)
            );

            $origen = Storage::disk('public')->path($path);
            $destino = $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $path;

            if (!file_exists(dirname($destino))) {
                mkdir(dirname($destino), 0755, true);
            }

            copy($origen, $destino);

            Galeria::create([
                'titulo' => $request->titulo,
                'categoria' => $request->categoria,
                'precio' => $request->precio,
                'imagen' => $path,
            ]);
        } else {
            return back()->with('error', 'Debes seleccionar al menos una imagen.');
        }

        return redirect()
            ->route('admin.galeria.index')
            ->with('ok', 'Imágenes agregadas correctamente');
    }


    private function optimizarImagen($file)
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read($file);

        // 🔧 redimensionar (máx 2000px)
        $image->scaleDown(2000);

        return $image;
    }



    public function destroy($id)
    {
        $galeria = Galeria::findOrFail($id);

        // Borrar imagen física
        if ($galeria->imagen && Storage::disk('public')->exists($galeria->imagen)) {
            Storage::disk('public')->delete($galeria->imagen);
        }


        // Borrar copia pública en public/storage/galeria
        // $publicCopy = public_path('storage/galeria/' . basename($galeria->imagen));

        // if (file_exists($publicCopy)) {
        //     unlink($publicCopy);
        // }

        $destino = $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $galeria->imagen;

        if (file_exists($destino)) {
            unlink($destino);
        }


        // Borrar registro BD
        $galeria->delete();

        return redirect()
            ->route('admin.galeria.index')
            ->with('success', 'Imagen eliminada correctamente');
    }
}
