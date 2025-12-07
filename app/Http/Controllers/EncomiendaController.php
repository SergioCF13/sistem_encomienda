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

    
public function create()
{
    return view('encomiendas.create', [
        'clientes'   => Cliente::all(),
        'empleados'  => User::all(),
        'sucursales' => Sucursal::all(),
        'choferes'   => Chofer::all(),
        'autos'      => Auto::all(),
        'id_empleado' => auth()->id(), 
    ]);
}


    
public function store(Request $request)
{
    $request->validate([
        'descripcion' => 'required',
        'pago' => 'required|in:Cancelado,Por pagar,Qr,Otro',
        'fecha_envio' => 'required|date',
        'id_cliente' => 'required',
        'id_empleado' => 'required', // Ya no es necesario seleccionar el empleado, lo asignamos automáticamente
        'id_sucursal_origen' => 'required',
        'id_sucursal_destino' => 'required',
        'id_chofer' => 'required',
        'id_auto' => 'required',
    ]);

    $codigo = 'ENC-' . time() . '-' . rand(100, 999);

    // Al crear la encomienda, se asigna automáticamente el id del usuario logueado
    $encomienda = Encomienda::create([
        'codigo_barra' => $codigo,
        'descripcion' => $request->descripcion,
        'pago' => $request->pago,
        'fecha_envio' => now(),
        'fecha_entrega' => null,
        'estado' => 'En tránsito',
        'id_cliente' => $request->id_cliente,
        'id_empleado' => auth()->id(),  // El usuario logueado se asigna automáticamente
        'id_sucursal_origen' => $request->id_sucursal_origen,
        'id_sucursal_destino' => $request->id_sucursal_destino,
        'id_chofer' => $request->id_chofer,
        'id_auto' => $request->id_auto,
    ]);

    // Generar el código de barras
    $this->ensureBarcodeImage($codigo);

    return redirect()->route('encomiendas.print', $encomienda->id_encomienda);
}


    
public function edit($id)
{
    $encomienda = Encomienda::findOrFail($id);
    $encomienda->fecha_envio = \Carbon\Carbon::parse($encomienda->fecha_envio); 

    return view('encomiendas.edit', [
        'encomienda' => $encomienda,
        'clientes'   => Cliente::all(),
        'empleados'  => User::all(),
        'sucursales' => Sucursal::all(),
        'choferes'   => Chofer::all(),
        'autos'      => Auto::all(),
    ]);
}


public function update(Request $request, $id)
{
  
    $encomienda = Encomienda::findOrFail($id);


    $request->validate([
        'descripcion' => 'required',
        'pago' => 'required|in:Cancelado,Por pagar,Qr,Otro',
        'fecha_envio' => 'required|date',
        'id_cliente' => 'required',
        'id_empleado' => 'required',
        'id_sucursal_origen' => 'required',
        'id_sucursal_destino' => 'required',
        'id_chofer' => 'required',
        'id_auto' => 'required',
    ]);


    $encomienda->update([
        'descripcion' => $request->descripcion,
        'pago' => $request->pago,  
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


    return redirect()->route('encomiendas.index')
        ->with('success', 'Encomienda actualizada correctamente.');
}


  
    public function destroy($id)
    {
        Encomienda::findOrFail($id)->delete();

        return redirect()->route('encomiendas.index')
            ->with('success', 'Encomienda eliminada.');
    }

    
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

   
    public function deliver($id)
    {
        $encomienda = Encomienda::findOrFail($id);

       
        if ($encomienda->estado == 'En tránsito') {
          
            $encomienda->estado = 'Entregado';
            if ($encomienda->pago=='Qr'){
                $encomienda->pago = 'Qr';
            }else{
                $encomienda->pago = 'Cancelado';
            }
            
            $encomienda->fecha_entrega = now();  
            $encomienda->save();
            

            return redirect()->route('encomiendas.index')->with('success', 'Encomienda entregada correctamente.');
        }

        return redirect()->route('encomiendas.index')->with('error', 'Esta encomienda no puede ser entregada.');
    }
}
