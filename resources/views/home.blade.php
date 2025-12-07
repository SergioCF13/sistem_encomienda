@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
   
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Usuarios</span>
                    <span class="info-box-number">{{ $usersCount }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-car"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Autos</span>
                    <span class="info-box-number">{{ $autosCount }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-user-tie"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Choferes</span>
                    <span class="info-box-number">{{ $choferesCount }}</span>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Encomiendas en tránsito</span>
                    <span class="info-box-number">{{ $encomiendasEnTransito }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Encomiendas entregadas</span>
                    <span class="info-box-number">{{ $encomiendasEntregadas }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Encomiendas pendientes</span>
                    <span class="info-box-number">{{ $encomiendasPendientes }}</span>
                </div>
            </div>
        </div>
    </div>

   
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-store-slash"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Sucursales inactivas</span>
                    <span class="info-box-number">{{ $sucursalesInactivas }}</span>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-money-bill-wave"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pagos Cancelados</span>
                    <span class="info-box-number">{{ $pagoCancelado }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-hourglass-half"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Por Pagar</span>
                    <span class="info-box-number">{{ $pagoPorPagar }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-qrcode"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pago QR</span>
                    <span class="info-box-number">{{ $pagoQr }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-credit-card"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Otro Pago</span>
                    <span class="info-box-number">{{ $pagoOtro }}</span>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h3>Últimas Encomiendas</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th>Fecha Envío</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ultimasEncomiendas as $encomienda)
                        <tr>
                            <td>{{ $encomienda->codigo_barra }}</td>
                            <td>{{ $encomienda->cliente->nombre }}</td>
                            <td>{{ $encomienda->estado }}</td>
                            <td>{{ \Carbon\Carbon::parse($encomienda->fecha_envio)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop

@section('css')
    {{-- Aquí puedes agregar tus estilos personalizados --}}
@stop

@section('js')
    <script> console.log("Dashboard cargado con éxito"); </script>
@stop
