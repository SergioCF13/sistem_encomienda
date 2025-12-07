<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        
        $users = User::with('sucursal')->get();
        return view('users.index', compact('users'));
    }

public function create()
{
    // Obtener todos los roles disponibles
    $roles = Role::all();
    
    // Obtener todas las sucursales disponibles
    $sucursales = Sucursal::all();

    return view('users.create', compact('roles', 'sucursales'));
}

public function store(Request $request)
{
    // Validar los datos
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed', // La confirmación de la contraseña también debe coincidir
        'role' => 'required|exists:roles,name', // Validar que el rol exista en la tabla roles
        'id_sucursal' => 'required|exists:sucursales,id_sucursal',  // Validar que la sucursal exista
    ]);

    // Crear el nuevo usuario
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Cifrar la contraseña
        'id_sucursal' => $request->id_sucursal, // Asignar la sucursal
    ]);

    // Asignar el rol seleccionado al usuario
    $user->assignRole($request->role);

    // Redirigir con un mensaje de éxito
    return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente');
}


public function edit($id)
{
    // Obtener el usuario que se va a editar
    $user = User::findOrFail($id);

    // Obtener todos los roles
    $roles = Role::all();

    // Obtener todas las sucursales
    $sucursales = Sucursal::all();

    // Pasar los datos a la vista
    return view('users.edit', compact('user', 'roles', 'sucursales'));
}

public function update(Request $request, $id)
{
    // Validación
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8|confirmed',
        'role' => 'required|exists:roles,name', // Validar que el rol exista
        'id_sucursal' => 'required|exists:sucursales,id_sucursal',
    ]);

    // Obtener el usuario
    $user = User::findOrFail($id);

    // Actualizar el usuario
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
        'id_sucursal' => $request->id_sucursal, // Actualizar sucursal
    ]);

    // Sincronizar el rol del usuario
    $user->syncRoles($request->role); // Sincronizar el rol seleccionado

    // Redirigir con un mensaje de éxito
    return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente');
}


    public function destroy($id)
    {
       
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado');
    }
}
