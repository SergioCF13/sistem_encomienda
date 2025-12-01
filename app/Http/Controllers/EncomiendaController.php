<?php

namespace App\Http\Controllers;

use App\Models\Encomienda;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Sucursal;
use App\Models\Chofer;
use App\Models\Auto;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;

class EncomiendaController extends Controller
{
    // Mostrar todas las encomiendas con la opción de búsqueda por código de barra
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $encomiendas = Encomienda::with('cliente', 'empleado')
            ->when($buscar, function ($q) use ($buscar) {
                $q->where('codigo_barra', 'LIKE', "%$buscar%");
            })
            ->get();

        return view('encomiendas.index', compact('encomiendas', 'buscar'));
    }

    // Mostrar formulario para crear una nueva encomienda
    public function create()
    {
        return view('encomiendas.create', [
            'clientes'   => Cliente::all(),
            'empleados'  => User::all(),
            'sucursales' => Sucursal::all(),
            'choferes'   => Chofer::all(),
            'autos'      => Auto::all(),
        ]);
    }

    // Almacenar una nueva encomienda en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'pago' => 'required|in:Cancelado,Por pagar,Qr,Otro', // Validación para los valores de pago
            'fecha_envio' => 'required|date',
            'id_cliente' => 'required',
            'id_empleado' => 'required',
            'id_sucursal_origen' => 'required',
            'id_sucursal_destino' => 'required',
            'id_chofer' => 'required',
            'id_auto' => 'required',
        ]);

        // Generar código único de la encomienda
        $codigo = 'ENC-' . time() . '-' . rand(100, 999);

        // Crear la encomienda con los datos recibidos
        $encomienda = Encomienda::create([
            'codigo_barra' => $codigo,
            'descripcion' => $request->descripcion,
            'pago' => $request->pago,  // Guardamos el estado del pago
            'fecha_envio' => now(),  // Fecha actual
            'fecha_entrega' => null, 
            'estado' => 'En tránsito',
            'id_cliente' => $request->id_cliente,
            'id_empleado' => $request->id_empleado,
            'id_sucursal_origen' => $request->id_sucursal_origen,
            'id_sucursal_destino' => $request->id_sucursal_destino,
            'id_chofer' => $request->id_chofer,
            'id_auto' => $request->id_auto,
        ]);

        // Crear código de barras
        $this->ensureBarcodeImage($codigo);

        return redirect()->route('encomiendas.print', $encomienda->id_encomienda);
    }

    // Mostrar formulario para editar una encomienda existente
public function edit($id)
{
    $encomienda = Encomienda::findOrFail($id);
    $encomienda->fecha_envio = \Carbon\Carbon::parse($encomienda->fecha_envio); // Convertir a Carbon

    return view('encomiendas.edit', [
        'encomienda' => $encomienda,
        'clientes'   => Cliente::all(),
        'empleados'  => User::all(),
        'sucursales' => Sucursal::all(),
        'choferes'   => Chofer::all(),
        'autos'      => Auto::all(),
    ]);
}


    // Actualizar la encomienda existente
public function update(Request $request, $id)
{
    // Encontrar la encomienda
    $encomienda = Encomienda::findOrFail($id);

    // Validación de los datos
    $request->validate([
        'descripcion' => 'required',
        'pago' => 'required|in:Cancelado,Por pagar,Qr,Otro', // Validación para el pago
        'fecha_envio' => 'required|date',
        'id_cliente' => 'required',
        'id_empleado' => 'required',
        'id_sucursal_origen' => 'required',
        'id_sucursal_destino' => 'required',
        'id_chofer' => 'required',
        'id_auto' => 'required',
    ]);

    // Actualizar la encomienda con los datos recibidos
    $encomienda->update([
        'descripcion' => $request->descripcion,
        'pago' => $request->pago,  // Actualizamos el estado del pago
        'fecha_envio' => $request->fecha_envio,
        'fecha_entrega' => $request->fecha_entrega,
        'estado' => $request->estado,
        'id_cliente' => $request->id_cliente,
        'id_empleado' => $request->id_empleado,
        'id_sucursal_origen' => $request->id_sucursal_origen,
        'id_sucursal_destino' => $request->id_sucursal_destino,
        'id_chofer' => $request->id_chofer,
        'id_auto' => $request->id_auto,
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->route('encomiendas.index')
        ->with('success', 'Encomienda actualizada correctamente.');
}


    // Eliminar una encomienda
    public function destroy($id)
    {
        Encomienda::findOrFail($id)->delete();

        return redirect()->route('encomiendas.index')
            ->with('success', 'Encomienda eliminada.');
    }

    // Mostrar los detalles de una encomienda
    public function show($id)
    {
        $data = Encomienda::with([
            'cliente',
            'empleado',
            'sucursalOrigen',
            'sucursalDestino',
            'chofer',
            'auto'
        ])->findOrFail($id);

        return view('encomiendas.show', compact('data'));
    }

    // Crear la imagen del código de barras
    protected function ensureBarcodeImage(string $codigo_barra): string
    {
        $dir = public_path('barcodes');

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $fileName = $codigo_barra . '.png';
        $path = $dir . DIRECTORY_SEPARATOR . $fileName;

        if (!file_exists($path)) {
            $generator = new BarcodeGeneratorPNG();
            $barcodeData = $generator->getBarcode($codigo_barra, $generator::TYPE_CODE_128);

            file_put_contents($path, $barcodeData);
        }

        return asset('barcodes/' . $fileName);
    }

    // Mostrar la vista para imprimir la encomienda con el código de barras
    public function print($id_encomienda)
    {
        $data = Encomienda::with([
            'cliente',
            'empleado',
            'sucursalOrigen',
            'sucursalDestino',
            'chofer',
            'auto'
        ])->findOrFail($id_encomienda);

        $barcodeUrl = $this->ensureBarcodeImage($data->codigo_barra);

        return view('encomiendas.print', compact('data', 'barcodeUrl'));
    }

    // Cambiar el estado de la encomienda a "Entregado"
    public function deliver($id)
    {
        $encomienda = Encomienda::findOrFail($id);

        // Verificar si la encomienda está en tránsito
        if ($encomienda->estado == 'En tránsito') {
            // Cambiar el estado a "Entregado"
            $encomienda->estado = 'Entregado';
            $encomienda->fecha_entrega = now();  // Fecha y hora de entrega
            $encomienda->save();

            return redirect()->route('encomiendas.index')->with('success', 'Encomienda entregada correctamente.');
        }

        return redirect()->route('encomiendas.index')->with('error', 'Esta encomienda no puede ser entregada.');
    }
}
