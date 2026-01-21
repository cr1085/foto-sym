# 📸 Foto Sym – Sistema de Reservas

Sistema de reservas y agendamiento para estudio/agencia de fotografía, desarrollado en Laravel.

Permite a los clientes:
- Seleccionar un servicio
- Elegir fecha y hora disponible
- Reservar sesión
- Pagar anticipo o total (integración futura)

Incluye un panel administrativo para la gestión de servicios, horarios y reservas.

---

## 🚀 Tecnologías usadas

- PHP 8.2
- Laravel 12
- MySQL
- JavaScript (Vanilla)
- HTML / CSS

---

## ✨ Funcionalidades

### Cliente
- Selección dinámica de servicios
- Agenda inteligente (no muestra horas ocupadas)
- Respeto por duración del servicio
- Manejo de horarios y excepciones
- Formulario de reserva

### Administración
- CRUD de servicios
- Configuración de horarios base
- Manejo de excepciones (festivos, cierres)
- Control de reservas

---

## 🧠 Lógica de Agenda

El sistema calcula las horas disponibles teniendo en cuenta:

- Horario base por día
- Excepciones por fecha
- Duración del servicio
- Reservas existentes
- Saltos configurables (30 minutos)

---

## ⚙️ Instalación local

```bash
git clone https://github.com/tu-usuario/foto-sym.git
cd foto-sym

composer install
npm install

cp .env.example .env
php artisan key:generate
