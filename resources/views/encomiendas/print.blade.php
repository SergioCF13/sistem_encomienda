<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ticket - {{ $data->codigo_barra }}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <style>
        /* Establecer márgenes de la página */
        @page { margin: 10mm; }
        body {
            font-family: 'Arial', Helvetica, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Fondo gris claro */
        }

        .ticket {
            width: 100%;
            max-width: 320px;
            margin: 0 auto;
            padding: 15px;
            background: #fff;
            border: 1px solid #ddd; /* Bordes suaves */
            margin-bottom: 15px;
            page-break-after: always;
            border-radius: 6px; /* Bordes redondeados */
        }

        .ticket:last-child {
            page-break-after: auto;
        }

        .center { text-align: center; }
        h2 {
            font-size: 20px;
            color: #444; /* Color oscuro para el título */
            margin-bottom: 8px;
            border-bottom: 2px solid #444; /* Línea de separación */
            padding-bottom: 5px;
        }

        .small {
            font-size: 13px;
            color: #777; /* Gris más suave para los detalles */
        }

        .bold {
            font-weight: 700;
            color: #222; /* Color más oscuro para los datos importantes */
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
        }

        .col {
            flex: 1;
        }

        .barcode {
            margin: 10px 0;
            text-align: center;
        }

        .divider {
            border-top: 1px solid #ddd; /* Línea de separación delgada */
            margin: 10px 0;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }

        /* Estilos para la impresión */
        @media print {
            body { margin: 0; padding: 0; }
            .no-print { display: none; } /* Esconde el botón de imprimir */
        }

        .no-print {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Ticket 1 para el cliente -->
    <div class="ticket">
        <div class="center">
            <h2>Parada de transporte 24 de Junio</h2>
            <div class="small">Montero</div>
            <div class="small">Tel: 700-68837629</div>
        </div>

        <div class="divider"></div>

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

        <div class="divider"></div> <!-- Línea de corte -->
    </div>

    <!-- Ticket 2 para la oficina -->
    <div class="ticket">
        <div class="center">
            <h2>Parada de transporte 24 de Junio</h2>
            <div class="small">Montero</div>
            <div class="small">Tel: 700-68837629</div>
        </div>

        <div class="divider"></div>

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

        <div class="footer">
            <p>Parada de transporte 24 de Junio | Tel: 700-68837629</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print(); // Imprime automáticamente cuando se carga la página
            setTimeout(function() {
                window.location.href = '{{ route("encomiendas.index") }}'; // Redirige a la vista de index
            }, 1000); // Retraso de 1 segundo antes de redirigir
        }
    </script>
</body>
</html>
