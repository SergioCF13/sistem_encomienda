<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chofer;

class ChoferController extends Controller
{
    public function index()
    {
        $chofer = Chofer::all();
        return view('choferes.index', compact('chofer'));
    }

    public function create()
    {
        return view('choferes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'ci' => 'required|string|max:8|unique:choferes,ci',
            'licencia' => 'nullable|string|max:150',
            'telefono' => 'nullable|string|max:8',
        ]);

        Chofer::create($request->all());
        return redirect()->route('choferes.index')->with('success', 'Chofer registrado correctamente.');
    }

public function edit(Chofer $chofer)
{
    return view('choferes.edit', compact('chofer'));
}


public function update(Request $request, Chofer $chofer)
{
    $request->validate([
        'nombre' => 'required|string|max:100',
        'ci' => 'required|string|max:8|unique:choferes,ci,' . $chofer->id_chofer . ',id_chofer',
        'licencia' => 'nullable|string|max:150',
        'telefono' => 'nullable|string|max:8',
    ]);

    $chofer->update($request->all()); 
    return redirect()->route('choferes.index')->with('success', 'Chofer actualizado correctamente.');
}


public function destroy(Chofer $chofer)
{
    
    $chofer->delete();  // Elimina al chofer completamente
    return redirect()->route('choferes.index')->with('success', 'Chofer eliminado correctamente.');
}




}
