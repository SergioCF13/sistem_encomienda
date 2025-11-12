<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\ChoferController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// RUTAS CLIENTES
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
// rutas sucursales
Route::get('/sucursales', [SucursalController::class, 'index'])->name('sucursales.index');
Route::get('/sucursales/create', [SucursalController::class, 'create'])->name('sucursales.create');
Route::post('/sucursales', [SucursalController::class, 'store'])->name('sucursales.store');
Route::get('/sucursales/edit/{id_sucursal}', [SucursalController::class, 'edit'])->name('sucursales.edit');
Route::put('/sucursales/update/{id_sucursal}', [SucursalController::class, 'update'])->name('sucursales.update');
Route::delete('/sucursales/destroy/{id_sucursal}', [SucursalController::class, 'destroy'])->name('sucursales.destroy');

// rutas choferes
Route::get('/choferes', [ChoferController::class, 'index'])->name('choferes.index');
Route::get('/choferes/create', [ChoferController::class, 'create'])->name('choferes.create');
Route::post('/choferes', [ChoferController::class, 'store'])->name('choferes.store');
Route::get('/choferes/{choferes}/edit', [ChoferController::class, 'edit'])->name('choferes.edit');
Route::put('/choferes/{choferes}', [ChoferController::class, 'update'])->name('choferes.update');
Route::delete('/choferes/{choferes}', [ChoferController::class, 'destroy'])->name('choferes.destroy');
