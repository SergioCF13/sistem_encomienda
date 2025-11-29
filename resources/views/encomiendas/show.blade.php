@extends('adminlte::page')

@section('title','Detalle Encomienda')

@section('content_header')
<h1>Detalle de Encomienda</h1>
@stop

@section('content')

<div class="card p-3">

    <h4><b>Código:</b> {{ $data->codigo_barra }}</h4>

    <p><b>Descripción:</b> {{ $data->descripcion }}</p>
    <p><b>Peso:</b> {{ $data->peso }} kg</p>
    <p><b>Cliente:</b> {{ $data->cliente->nombre }}</p>
    <p><b>Empleado:</b> {{ $data->empleado->name }}</p>

    <p><b>Origen:</b> {{ $data->sucursalOrigen->nombre }}</p>
    <p><b>Destino:</b> {{ $data->sucursalDestino->nombre }}</p>

    <p><b>Chofer:</b> {{ $data->chofer->nombre }}</p>
    <p><b>Auto:</b> {{ $data->auto->placa }}</p>

    <p><b>Estado:</b> {{ $data->estado }}</p>

</div>

@stop
