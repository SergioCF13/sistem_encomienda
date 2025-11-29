@extends('adminlte::page')

@section('title', 'Registrar Encomienda')

@section('content_header')
    <h1>Nueva Encomienda</h1>
@stop

@section('content')

<form action="{{ route('encomiendas.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Descripción:</label>
        <input type="text" name="descripcion" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Peso (kg):</label>
        <input type="number" step="0.01" name="peso" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Fecha Envío:</label>
        <input type="date" name="fecha_envio" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Cliente:</label>
        <select name="id_cliente" class="form-control" required>
            @foreach ($clientes as $c)
            <option value="{{ $c->id_cliente }}">{{ $c->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Empleado:</label>
        <select name="id_empleado" class="form-control" required>
            @foreach ($empleados as $e)
            <option value="{{ $e->id }}">{{ $e->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Sucursal Origen:</label>
        <select name="id_sucursal_origen" class="form-control" required>
            @foreach ($sucursales as $s)
            <option value="{{ $s->id_sucursal }}">{{ $s->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Sucursal Destino:</label>
        <select name="id_sucursal_destino" class="form-control" required>
            @foreach ($sucursales as $s)
            <option value="{{ $s->id_sucursal }}">{{ $s->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Chofer:</label>
        <select name="id_chofer" class="form-control" required>
            @foreach ($choferes as $ch)
            <option value="{{ $ch->id_choferes }}">{{ $ch->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Auto:</label>
        <select name="id_auto" class="form-control" required>
            @foreach ($autos as $a)
            <option value="{{ $a->id_auto }}">{{ $a->placa }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Guardar</button>

</form>

@stop
