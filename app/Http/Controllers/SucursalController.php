<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function index()
    {
        $sucursales = Sucursal::all();
        return view('sucursales.index', compact('sucursales'));
    }

    public function create()
    {
        return view('sucursales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'ciudad' => 'required|max:100',
            'direccion' => 'required|max:150',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        Sucursal::create($request->all());
        return redirect()->route('sucursales.index')->with('success', 'Sucursal creada correctamente.');
    }

    public function edit($id_sucursal)
    {
        $sucursal = Sucursal::findOrFail($id_sucursal);
        return view('sucursales.edit', compact('sucursal'));
    }

    public function update(Request $request, $id_sucursal)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'ciudad' => 'required|max:100',
            'direccion' => 'required|max:150',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $sucursal = Sucursal::findOrFail($id_sucursal);
        $sucursal->update($request->all());

        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada correctamente.');
    }

    public function destroy($id_sucursal)
    {
        $sucursal = Sucursal::findOrFail($id_sucursal);
        $sucursal->update(['estado' => 'Inactivo']);
        return redirect()->route('sucursales.index')->with('success', 'Sucursal desactivada.');
    }
}
