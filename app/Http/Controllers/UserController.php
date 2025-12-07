<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios con sus respectivas sucursales
        $users = User::with('sucursal')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        // Obtener todas las sucursales para el formulario
        $sucursales = Sucursal::all();
        return view('users.create', compact('sucursales'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',  // Asegurarse que la sucursal exista
        ]);

        // Crear el nuevo usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_sucursal' => $request->id_sucursal,  // Asignar la sucursal
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente');
    }

    public function edit($id)
    {
        // Obtener usuario y sucursales disponibles
        $user = User::findOrFail($id);
        $sucursales = Sucursal::all();
        return view('users.edit', compact('user', 'sucursales'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal', // Asegurarse que la sucursal exista
        ]);

        // Obtener el usuario
        $user = User::findOrFail($id);

        // Actualizar los datos del usuario
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'id_sucursal' => $request->id_sucursal, // Asignar o actualizar la sucursal
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy($id)
    {
        // Eliminar el usuario
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado');
    }
}
