<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\Chofer;
use App\Models\Cliente;
use App\Models\Sucursal;
use App\Models\Encomienda;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        
        $usersCount = User::count();
        $autosCount = Auto::count();
        $choferesCount = Chofer::count();
        $clientesCount = Cliente::count();
        $sucursalesCount = Sucursal::count();

        
        $encomiendasEnTransito = Encomienda::where('estado', 'En tránsito')->count();
        $encomiendasEntregadas = Encomienda::where('estado', 'Entregado')->count();
        $encomiendasPendientes = Encomienda::whereNull('fecha_entrega')->count();

        
        $pagoCancelado = Encomienda::where('pago', 'Cancelado')->count();
        $pagoPorPagar = Encomienda::where('pago', 'Por pagar')->count();
        $pagoQr = Encomienda::where('pago', 'Qr')->count();
        $pagoOtro = Encomienda::where('pago', 'Otro')->count();

        
        $sucursalesInactivas = Sucursal::where('estado', 'Inactivo')->count();

     
        $ultimasEncomiendas = Encomienda::latest()->take(5)->get();

        
        $userRole = auth()->user()->roles->first()->name;

        
        return view('home', compact(
            'usersCount',
            'autosCount',
            'choferesCount',
            'clientesCount',
            'sucursalesCount',
            'encomiendasEnTransito',
            'encomiendasEntregadas',
            'encomiendasPendientes',
            'sucursalesInactivas',
            'pagoCancelado',
            'pagoPorPagar',
            'pagoQr',
            'pagoOtro',
            'ultimasEncomiendas',
            'userRole'
        ));
    }
}
