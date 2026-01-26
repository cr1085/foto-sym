<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        $data = $request->validate([
            'nombre'  => 'required',
            'email'   => 'required|email',
            'mensaje' => 'required'
        ]);

        Mail::raw(
            "Nombre: {$data['nombre']}\nEmail: {$data['email']}\n\nMensaje:\n{$data['mensaje']}",
            function ($message) {
                $message->to('symfotodigital@gmail.com')
                        ->subject('Nuevo mensaje de contacto');
            }
        );

        return back()->with('ok', 'Mensaje enviado correctamente');
    }
}
