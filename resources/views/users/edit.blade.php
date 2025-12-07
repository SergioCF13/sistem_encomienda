@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Nombre del Usuario -->
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <!-- Email del Usuario -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <!-- Contraseña del Usuario (opcional para actualizar) -->
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control">
        <small>Deja en blanco si no deseas cambiarla</small>
    </div>

    <!-- Confirmación de Contraseña -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>

    <!-- Selección del Rol -->
    <div class="mb-3">
        <label for="role" class="form-label">Rol</label>
        <select name="role" id="role" class="form-select" required>
            <option value="" disabled selected>Seleccione un rol</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Selección de Sucursal -->
    <div class="mb-3">
        <label for="id_sucursal" class="form-label">Sucursal</label>
        <select name="id_sucursal" id="id_sucursal" class="form-select" required>
            <option value="" disabled selected>Seleccione una sucursal</option>
            @foreach($sucursales as $sucursal)
                <option value="{{ $sucursal->id_sucursal }}" {{ old('id_sucursal', $user->id_sucursal) == $sucursal->id_sucursal ? 'selected' : '' }}>{{ $sucursal->nombre }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Actualizar Usuario</button>
</form>

        </div>
    </div>
@stop
