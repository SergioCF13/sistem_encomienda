<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'ci' => 'required|string|max:20|unique:clientes,ci',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:150',
        ]);

        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente registrado correctamente.');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'ci' => 'required|string|max:20|unique:clientes,ci,' . $cliente->id_cliente . ',id_cliente',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:150',
        ]);

        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->update(['estado' => 'Inactivo']);
        return redirect()->route('clientes.index')->with('success', 'Cliente desactivado correctamente.');
    }
}
