<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\ChoferController;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\EncomiendaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;



    // Ruta inicial de inicio de sesión
    Route::get('/', function () {
        return view('auth.login');
    });

    Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // RUTAS CLIENTES
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    // RUTAS SUCURSALES
    Route::get('/sucursales', [SucursalController::class, 'index'])->name('sucursales.index');
    Route::get('/sucursales/create', [SucursalController::class, 'create'])->name('sucursales.create');
    Route::post('/sucursales', [SucursalController::class, 'store'])->name('sucursales.store');
    Route::get('/sucursales/edit/{id_sucursal}', [SucursalController::class, 'edit'])->name('sucursales.edit');
    Route::put('/sucursales/update/{id_sucursal}', [SucursalController::class, 'update'])->name('sucursales.update');
    Route::delete('/sucursales/destroy/{id_sucursal}', [SucursalController::class, 'destroy'])->name('sucursales.destroy');

    // RUTAS CHOFERES
    Route::get('/choferes', [ChoferController::class, 'index'])->name('choferes.index');
    Route::get('/choferes/create', [ChoferController::class, 'create'])->name('choferes.create');
    Route::post('/choferes', [ChoferController::class, 'store'])->name('choferes.store');
    Route::get('/choferes/{chofer}/edit', [ChoferController::class, 'edit'])->name('choferes.edit');
    Route::put('/choferes/{chofer}', [ChoferController::class, 'update'])->name('choferes.update');
    Route::delete('/choferes/{chofer}', [ChoferController::class, 'destroy'])->name('choferes.destroy');

    // RUTAS AUTOS
    Route::get('/autos', [AutoController::class, 'index'])->name('autos.index');
    Route::get('/autos/create', [AutoController::class, 'create'])->name('autos.create');
    Route::post('/autos', [AutoController::class, 'store'])->name('autos.store');
    Route::get('/autos/{auto}/edit', [AutoController::class, 'edit'])->name('autos.edit');
    Route::put('/autos/{auto}', [AutoController::class, 'update'])->name('autos.update');
    Route::delete('/autos/{auto}', [AutoController::class, 'destroy'])->name('autos.destroy');

    // RUTAS ENCOMIENDAS
    Route::get('/encomiendas', [EncomiendaController::class, 'index'])->name('encomiendas.index');
    Route::get('/encomiendas/create', [EncomiendaController::class, 'create'])->name('encomiendas.create');
    Route::post('/encomiendas', [EncomiendaController::class, 'store'])->name('encomiendas.store');
    Route::get('/encomiendas/{encomienda}', [EncomiendaController::class, 'show'])->name('encomiendas.show');
    Route::get('/encomiendas/{encomienda}/edit', [EncomiendaController::class, 'edit'])->name('encomiendas.edit');
    Route::put('/encomiendas/{encomienda}', [EncomiendaController::class, 'update'])->name('encomiendas.update');
    Route::delete('/encomiendas/{encomienda}', [EncomiendaController::class, 'destroy'])->name('encomiendas.destroy');
    
    // Ruta para imprimir ticket
    Route::get('encomiendas/{id_encomienda}/print', [EncomiendaController::class, 'print'])->name('encomiendas.print');
    // Ruta para descargar PDF
    Route::get('encomiendas/{id_encomienda}/pdf', [EncomiendaController::class, 'pdf'])->name('encomiendas.pdf');
    // Ruta para la entrega
    Route::get('/encomiendas/{id}/deliver', [EncomiendaController::class, 'deliver'])->name('encomiendas.deliver');
    
    // Rutas de usuarios (sin middleware para los administradores)
    Route::resource('users', UserController::class);
});
