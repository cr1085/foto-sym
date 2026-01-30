@extends('layouts.public')

@section('content')
<style>
/* ===== CONTENEDOR GENERAL ===== */
.pago-wrapper {
    max-width: 900px;
    margin: 40px auto;
    padding: 24px;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    color: #1f2937;
}

/* ===== HEADER ===== */
.pago-header {
    margin-bottom: 32px;
}
.pago-header h1 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 6px;
}
.pago-header p {
    color: #6b7280;
}

/* ===== CARD ===== */
.card {
    background: #ffffff;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 10px 25px rgba(0,0,0,.06);
    margin-bottom: 28px;
}

/* ===== RESUMEN ===== */
.resumen-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px,1fr));
    gap: 20px;
}
.resumen-label {
    font-size: 13px;
    color: #6b7280;
}
.resumen-value {
    font-size: 16px;
    font-weight: 600;
    margin-top: 4px;
}

/* ===== PASOS ===== */
.pasos li {
    display: flex;
    gap: 12px;
    margin-bottom: 10px;
    font-size: 14px;
}
.pasos span {
    font-weight: 700;
    color: #4f46e5;
}

/* ===== QR ===== */
.qr-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px,1fr));
    gap: 24px;
    margin-top: 20px;
}
.qr-card {
    text-align: center;
    padding: 20px;
    border-radius: 18px;
    background: #f9fafb;
    transition: transform .2s, box-shadow .2s;
}
.qr-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 30px rgba(0,0,0,.08);
}
.qr-card img {
    width: 400px;
    margin-bottom: 10px;
}

/* ===== TRANSFERENCIA ===== */
.transferencia p {
    font-size: 14px;
    margin: 4px 0;
}

/* ===== WHATSAPP ===== */
.whatsapp-box {
    background: linear-gradient(135deg,#22c55e,#16a34a);
    color: #fff;
    border-radius: 20px;
    padding: 28px;
    text-align: center;
}
.whatsapp-box h2 {
    font-size: 20px;
    margin-bottom: 10px;
}
.whatsapp-box p {
    font-size: 14px;
    opacity: .95;
    margin-bottom: 18px;
}
.whatsapp-btn {
    display: inline-block;
    background: #ffffff;
    color: #16a34a;
    padding: 14px 26px;
    border-radius: 14px;
    font-size: 16px;
    font-weight: 700;
    text-decoration: none;
}
.whatsapp-btn:hover {
    background: #f0fdf4;
}

/* ===== FOOTER ===== */
.pago-footer {
    text-align: center;
    font-size: 13px;
    color: #6b7280;
    margin-top: 30px;
}
</style>

<div class="pago-wrapper">

    {{-- HEADER --}}
    <div class="pago-header">
        <h1>💳 Pago de tu reserva</h1>
        <p>Estás a un paso de confirmar tu sesión en <strong>Sym Foto Digital</strong>.</p>
    </div>

    {{-- RESUMEN --}}
    <div class="card">
        <h3>📸 Detalles de tu reserva</h3>
        <div class="resumen-grid">
            <div>
                <div class="resumen-label">Servicio</div>
                <div class="resumen-value">{{ request('servicio','—') }}</div>
            </div>
            <div>
                <div class="resumen-label">Fecha</div>
                <div class="resumen-value">{{ request('fecha','—') }}</div>
            </div>
            <div>
                <div class="resumen-label">Hora</div>
                <div class="resumen-value">{{ request('hora','—') }}</div>
            </div>
        </div>
    </div>

    {{-- PASOS --}}
    <div class="card">
        <h3>📝 ¿Cómo confirmar tu reserva?</h3>
        <ul class="pasos">
            <li><span>1.</span> Realiza el pago con una de las opciones disponibles.</li>
            <li><span>2.</span> Guarda o toma captura del comprobante.</li>
            <li><span>3.</span> Envíanos el comprobante por WhatsApp.</li>
            <li><span>4.</span> Te confirmaremos lo antes posible.</li>
        </ul>
    </div>

    {{-- QR --}}
    <div class="card">
        <h3>📱 Pago con QR</h3>
        <div class="qr-grid">
            <div class="qr-card">
                <img src="/assets/images/qr-pago-bcb.png">
                <strong>Bancolombia</strong>
            </div>
            <div class="qr-card">
                <img src="/assets/images/qr-pago-nq.png">
                <strong>Nequi</strong>
            </div>
        </div>
    </div>

    {{-- TRANSFERENCIA --}}
    <div class="card transferencia">
        <h3>🏦 Transferencia bancaria</h3>
        <p><strong>Banco:</strong>Bancolombia</p>
        <p><strong>Cuenta:</strong>526-254138-00</p>
        <p><strong>Titular:</strong> Sym Foto Digital</p>
    </div>

    <div class="card transferencia">
        <h3>🏦 Transferencia bancaria</h3>
        <p><strong>Banco:</strong>Nequi</p>
        <p><strong>Cuenta:</strong>3016752947</p>
        <p><strong>Titular:</strong> Sym Foto Digital</p>
    </div>

    @php
        $mensajeWhatsapp = urlencode(
            "Hola, realicé el pago de mi reserva.\n\n".
            "📸 Servicio: ".request('servicio','—')."\n".
            "📅 Fecha: ".request('fecha','—')."\n".
            "⏰ Hora: ".request('hora','—')."\n\n".
            "Adjunto comprobante del pago."
        );
    @endphp

    {{-- WHATSAPP --}}
    <div class="whatsapp-box">
        <h2>📩 ¿Ya realizaste el pago?</h2>
        <p>Envíanos el comprobante por WhatsApp para confirmar tu reserva.</p>
        <a class="whatsapp-btn"
           href="https://wa.me/573016752947?text={{ $mensajeWhatsapp }}"
           target="_blank">
           💬 Enviar comprobante
        </a>
    </div>

    <div class="pago-footer">
        🕒 Nuestro equipo revisará el comprobante y se pondrá en contacto contigo.
    </div>

</div>
@endsection
