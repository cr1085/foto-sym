@extends('layouts.admin')

@section('breadcrumb','Usuarios / Crear')

@section('content')

<div class="admin-form-wrapper">

    <div class="card user-card">

        <h3 class="form-title">
            👤 Crear usuario
        </h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label>Nombre</label>
                <input name="name" placeholder="Nombre completo" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="correo@ejemplo.com" required>
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Confirmar contraseña</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <div class="form-actions">
                <button class="btn">Crear usuario</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Cancelar</a>
            </div>

        </form>

    </div>

</div>

@endsection
