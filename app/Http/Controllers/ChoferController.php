<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chofer;

class ChoferController extends Controller
{
    public function index()
    {
        $choferes = Chofer::all();
        return view('choferes.index', compact('choferes'));
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

    public function edit(Chofer $choferes)
    {
        return view('choferes.edit', compact('choferes'));
    }

    public function update(Request $request, Chofer $choferes)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'ci' => 'required|string|max:8|unique:choferes,ci,' . $choferes->id_choferes . ',id_choferes',
            'licencia' => 'nullable|string|max:150',
            'telefono' => 'nullable|string|max:8',
        ]);

        $choferes->update($request->all()); // ✅ usar $choferes
        return redirect()->route('choferes.index')->with('success', 'Chofer actualizado correctamente.');
    }

    public function destroy(Chofer $choferes)
    {
        $choferes->update(['estado' => 'Inactivo']); // ✅ usar $choferes
        return redirect()->route('choferes.index')->with('success', 'Chofer desactivado correctamente.');
    }




}
