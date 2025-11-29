<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ticket - {{ $data->codigo_barra }}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <style>
        /* Estilos para impresión */
        @page { margin: 10mm; }
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #111;
            margin: 0;
            padding: 0;
        }

        .ticket {
            max-width: 320px; /* tamaño típico de etiqueta */
            margin: 0 auto;
            padding: 12px;
            background: #fff;
            border: 1px solid #e6e6e6;
        }

        .center { text-align: center; }
        h2 { margin: 6px 0; font-size: 18px; }
        .small { font-size: 12px; color: #555; }
        .bold { font-weight: 700; }

        .row { display: flex; justify-content: space-between; margin: 6px 0; }
        .col { flex: 1; }

        .barcode { margin: 10px 0; text-align: center; }

        /* Botones no se imprimen */
        .no-print { margin-top: 10px; text-align: center; }
        @media print {
            .no-print { display: none; }
            body { margin: 0; }
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="center">
            <h>Parada de transporte 24 de Junio</h2>
            <div class="small">Montero</div>
            <div class="small">Tel: 700-68837629</div>
        </div>

        <hr>

        <div class="row">
            <div class="col small">Código:</div>
            <div class="col right bold">{{ $data->codigo_barra }}</div>
        </div>
                <div class="barcode">
            <img src="{{ $barcodeUrl }}" alt="Código de barras" style="max-width:100%; height:auto;">
        </div>

        <div class="row">
            <div class="col small">Fecha envío:</div>
            <div class="col right">{{ \Carbon\Carbon::parse($data->fecha_envio)->format('d/m/Y') }}</div>
        </div>

        <div class="row">
            <div class="col small">Cliente:</div>
            <div class="col right">{{ $data->cliente->nombre }}</div>
        </div>

        <div class="row">
            <div class="col small">Descripción:</div>
            <div class="col right">{{ $data->descripcion }}</div>
        </div>

        <div class="row">
            <div class="col small">Peso:</div>
            <div class="col right">{{ $data->peso }} kg</div>
        </div>

        <div class="row">
            <div class="col small">Origen:</div>
            <div class="col right">{{ $data->sucursalOrigen->nombre }}</div>
        </div>

        <div class="row">
            <div class="col small">Destino:</div>
            <div class="col right">{{ $data->sucursalDestino->nombre }}</div>
        </div>


        <div class="center small">
            Firma: _______________________
        </div>

        <div class="no-print center">
            <button onclick="window.print()" style="padding:8px 14px; font-size:14px;">Imprimir</button>
            <a href="{{ route('encomiendas.show', $data->id_encomienda) }}" style="margin-left:8px;">Volver</a>
        </div>
    </div>
</body>
</html>
