@extends('layouts.public')

@section('content')
    <style>
        /* ===== CONTACTO ===== */
        .contact-hero {
            padding: 80px 60px;
            background: linear-gradient(135deg, #6b0f3f, #8f1d55);
            color: white;
            text-align: center;
        }

        .contact-hero h1 {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .contact-hero p {
            font-size: 18px;
            opacity: .9;
        }

        .contact-wrapper {
            max-width: 1100px;
            margin: 80px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 60px;
        }

        .contact-form {
            background: #fff;
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .08);
        }

        .contact-form h3 {
            color: #6b0f3f;
            margin-bottom: 25px;
            font-size: 24px;
        }

        .contact-form .group {
            margin-bottom: 20px;
        }

        .contact-form label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #444;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 14px 16px;
            border-radius: 14px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .contact-form textarea {
            resize: none;
            height: 120px;
        }

        .contact-form button {
            margin-top: 10px;
            background: #6b0f3f;
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 30px;
            font-size: 15px;
            cursor: pointer;
        }

        .contact-info {
            display: grid;
            gap: 25px;
        }

        .info-card {
            background: #fafafa;
            padding: 30px;
            border-radius: 22px;
        }

        .info-card h4 {
            color: #6b0f3f;
            margin-bottom: 10px;
        }

        .info-card p {
            font-size: 14px;
            color: #555;
        }

        .whatsapp-card {
            background: #25d366;
            color: white;
            padding: 35px;
            border-radius: 25px;
            text-align: center;
        }

        .whatsapp-card h3 {
            margin-bottom: 10px;
        }

        .whatsapp-card a {
            display: inline-block;
            margin-top: 15px;
            background: white;
            color: #25d366;
            padding: 12px 26px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
        }

        /* Responsive */
        @media(max-width: 900px) {
            .contact-wrapper {
                grid-template-columns: 1fr;
            }

            .contact-hero {
                padding: 60px 20px;
            }
        }
    </style>

    <section class="contact-hero">
        <h1>Hablemos 📸</h1>
        <p>Estamos listos para crear algo increíble contigo</p>
    </section>

    <section class="contact-wrapper">

        {{-- FORMULARIO --}}
        <div class="contact-form">
            <h3>Envíanos un mensaje</h3>

            {{-- <form >
            <div class="group">
                <label>Nombre</label>
                <input type="text" placeholder="Tu nombre">
            </div>

            <div class="group">
                <label>Email</label>
                <input type="email" placeholder="correo@email.com">
            </div>

            <div class="group">
                <label>Mensaje</label>
                <textarea placeholder="Cuéntanos qué necesitas..."></textarea>
            </div>

            <button type="submit">
                Enviar mensaje
            </button>
        </form> --}}

            <form method="POST" action="{{ route('contacto.enviar') }}">
                @csrf

                <div class="group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" required>
                </div>

                <div class="group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="group">
                    <label>Mensaje</label>
                    <textarea name="mensaje" required></textarea>
                </div>

                <button type="submit">
                    Enviar mensaje
                </button>
            </form>

        </div>

        {{-- INFO --}}
        <div class="contact-info">

            <div class="info-card">
                <h4>📍 Ubicación</h4>
                <p>Atendemos en estudio y eventos<br>
                    (previa cita)</p>
            </div>

            <div class="info-card">
                <h4>📧 Email</h4>
                <p>symfotodigital@gmail.com</p>
            </div>

            <div class="info-card">
                <h4>📱 Redes sociales</h4>
                <p>
                    Instagram · Facebook · TikTok<br>
                    @symfotodigital
                </p>
            </div>

            <div class="whatsapp-card">
                <h3>¿Prefieres WhatsApp?</h3>
                <p>Respuesta rápida y directa</p>
                <a href="https://wa.me/573016752947" target="_blank">
                    Escribir por WhatsApp
                </a>
            </div>

        </div>

    </section>
@endsection
