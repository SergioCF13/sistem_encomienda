@extends('adminlte::page')

@section('title', 'Editar Encomienda')

@section('content_header')
    <h1>Editar Encomienda</h1>
@stop

@section('content')

<form action="{{ route('encomiendas.update', $encomienda->id_encomienda) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Descripción:</label>
        <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $encomienda->descripcion) }}" required>
    </div>

<div class="form-group">
    <label for="estado" class="form-label fw-bold">Estado:</label>
    <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
        <option value="En tránsito" {{ old('estado', $encomienda->estado) == 'En tránsito' ? 'selected' : '' }}>En tránsito</option>
        <option value="Entregado" {{ old('estado', $encomienda->estado) == 'Entregado' ? 'selected' : '' }}>Entregado</option>
        <option value="Cancelado" {{ old('estado', $encomienda->estado) == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
    </select>
    @error('estado') <small class="text-danger">{{ $message }}</small> @enderror
</div>


    <div class="form-group">
        <label>Fecha Envío:</label>
        <input type="date" name="fecha_envio" class="form-control" value="{{ old('fecha_envio', \Carbon\Carbon::parse($encomienda->fecha_envio)->format('Y-m-d')) }}" required>

    </div>

    <div class="form-group">
        <label>Cliente:</label>
        <select name="id_cliente" class="form-control" required>
            @foreach ($clientes as $c)
                <option value="{{ $c->id_cliente }}" {{ old('id_cliente', $encomienda->id_cliente) == $c->id_cliente ? 'selected' : '' }}>{{ $c->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Empleado:</label>
        <select name="id_empleado" class="form-control" required>
            @foreach ($empleados as $e)
                <option value="{{ $e->id }}" {{ old('id_empleado', $encomienda->id_empleado) == $e->id ? 'selected' : '' }}>{{ $e->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Sucursal Origen:</label>
        <select name="id_sucursal_origen" class="form-control" required>
            @foreach ($sucursales as $s)
                <option value="{{ $s->id_sucursal }}" {{ old('id_sucursal_origen', $encomienda->id_sucursal_origen) == $s->id_sucursal ? 'selected' : '' }}>{{ $s->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Sucursal Destino:</label>
        <select name="id_sucursal_destino" class="form-control" required>
            @foreach ($sucursales as $s)
                <option value="{{ $s->id_sucursal }}" {{ old('id_sucursal_destino', $encomienda->id_sucursal_destino) == $s->id_sucursal ? 'selected' : '' }}>{{ $s->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Chofer:</label>
        <select name="id_chofer" class="form-control" required>
            <option value="">Seleccionar Chofer</option>
            @foreach ($choferes as $ch)
                <option value="{{ $ch->id_chofer }}" {{ old('id_chofer', $encomienda->id_chofer) == $ch->id_chofer ? 'selected' : '' }}>{{ $ch->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Auto:</label>
        <select name="id_auto" class="form-control" required>
            @foreach ($autos as $a)
                <option value="{{ $a->id_auto }}" {{ old('id_auto', $encomienda->id_auto) == $a->id_auto ? 'selected' : '' }}>{{ $a->placa }}</option>
            @endforeach
        </select>
    </div>

    <a href="{{ route('encomiendas.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Cancelar
    </a>
    <button class="btn btn-success">Actualizar</button>

</form>

@stop
