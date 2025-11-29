@extends('adminlte::page')

@section('title', 'Detalles de la Encomienda')

@section('content_header')
    <h1>Detalles de la Encomienda</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <strong>Código:</strong> {{ $data->codigo_barra }}<br>
                    <strong>Descripción:</strong> {{ $data->descripcion }}<br>
                    <strong>Peso:</strong> {{ $data->peso }} kg<br>
                    <strong>Cliente:</strong> {{ $data->cliente->nombre }}<br>
                    <strong>Fecha Envío:</strong> {{ \Carbon\Carbon::parse($data->fecha_envio)->format('d/m/Y H:i:s') }}<br> <!-- Mostrar fecha y hora -->
                    <strong>Fecha Entrega:</strong> 
                    @if($data->fecha_entrega)
                        {{ \Carbon\Carbon::parse($data->fecha_entrega)->format('d/m/Y H:i:s') }}
                    @else
                        <span class="text-muted">Pendiente</span>
                    @endif<br>
                    <strong>Estado:</strong> {{ $data->estado }}<br>
                    <strong>Origen:</strong> {{ $data->sucursalOrigen->nombre }}<br>
                    <strong>Destino:</strong> {{ $data->sucursalDestino->nombre }}<br>

                    <!-- Botón de Entregar solo si está en tránsito -->
                    @if($data->estado == 'En tránsito')
                        <a href="{{ route('encomiendas.deliver', $data->id_encomienda) }}" class="btn btn-success mt-3">Entregar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
