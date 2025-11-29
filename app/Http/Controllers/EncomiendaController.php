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
    /* ============================================================
       LISTAR / BUSCAR
    ============================================================ */
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

    /* ============================================================
       CREAR FORM
    ============================================================ */
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

    /* ============================================================
       GUARDAR ENCOMIENDA
    ============================================================ */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'peso' => 'required|numeric',
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

        // Crear registro en BD
        $encomienda = Encomienda::create([
            'codigo_barra' => $codigo,
            'descripcion' => $request->descripcion,
            'peso' => $request->peso,
            'fecha_envio' => $request->fecha_envio,
            'fecha_entrega' => null,
            'estado' => 'En tránsito',
            'id_cliente' => $request->id_cliente,
            'id_empleado' => $request->id_empleado,
            'id_sucursal_origen' => $request->id_sucursal_origen,
            'id_sucursal_destino' => $request->id_sucursal_destino,
            'id_chofer' => $request->id_chofer,
            'id_auto' => $request->id_auto,
        ]);

        // Crear imagen del código de barras
        $this->ensureBarcodeImage($codigo);

        return redirect()->route('encomiendas.index')
            ->with('success', 'Encomienda registrada exitosamente.');
    }

    /* ============================================================
       EDITAR FORM
    ============================================================ */
    public function edit($id)
    {
        return view('encomiendas.edit', [
            'encomienda' => Encomienda::findOrFail($id),
            'clientes'   => Cliente::all(),
            'empleados'  => User::all(),
            'sucursales' => Sucursal::all(),
            'choferes'   => Chofer::all(),
            'autos'      => Auto::all(),
        ]);
    }

    /* ============================================================
       ACTUALIZAR
    ============================================================ */
    public function update(Request $request, $id)
    {
        $encomienda = Encomienda::findOrFail($id);

        $request->validate([
            'descripcion' => 'required',
            'peso' => 'required|numeric',
            'fecha_envio' => 'required|date',
            'id_cliente' => 'required',
            'id_empleado' => 'required',
            'id_sucursal_origen' => 'required',
            'id_sucursal_destino' => 'required',
            'id_chofer' => 'required',
            'id_auto' => 'required',
        ]);

        $encomienda->update($request->all());

        return redirect()->route('encomiendas.index')
            ->with('success', 'Encomienda actualizada correctamente.');
    }

    /* ============================================================
       ELIMINAR
    ============================================================ */
    public function destroy($id)
    {
        Encomienda::findOrFail($id)->delete();

        return redirect()->route('encomiendas.index')
            ->with('success', 'Encomienda eliminada.');
    }

    /* ============================================================
       MOSTRAR DETALLE
    ============================================================ */
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

    /* ============================================================
       GENERAR IMAGEN DE BARRA
    ============================================================ */
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

    /* ============================================================
       IMPRIMIR TICKET / VISTA
    ============================================================ */
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
}
