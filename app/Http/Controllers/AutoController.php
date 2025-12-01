<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use Illuminate\Http\Request;

class AutoController extends Controller
{
    public function index()
    {
        $autos = Auto::all();
        return view('autos.index', compact('autos'));
    }

    public function create()
    {
        return view('autos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_movil'=> 'required',
            'placa' => 'required|unique:autos,placa',
            'marca' => 'required',
            'modelo' => 'required',
            
        ]);

        Auto::create($request->all());

        return redirect()->route('autos.index')->with('success', 'Auto registrado correctamente');
    }

    public function edit(Auto $auto)
    {
        return view('autos.edit', compact('auto'));
    }

    public function update(Request $request, Auto $auto)
    {
        $request->validate([
            'numero_movil'=> 'required',
            'placa' => 'required|unique:autos,placa,' . $auto->id_auto . ',id_auto',
            'marca' => 'required',
            'modelo' => 'required',
            
        ]);

        $auto->update($request->all());

        return redirect()->route('autos.index')->with('success', 'Auto actualizado correctamente');
    }

    public function destroy(Auto $auto)
    {
        $auto->delete();
        return redirect()->route('autos.index')->with('success', 'Auto eliminado correctamente');
    }
}
