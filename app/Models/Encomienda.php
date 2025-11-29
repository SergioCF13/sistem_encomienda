<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encomienda extends Model
{
    protected $table = 'encomiendas';
    protected $primaryKey = 'id_encomienda';

    protected $fillable = [
        'codigo_barra',
        'descripcion',
        'peso',
        'fecha_envio',
        'fecha_entrega',
        'estado',
        'id_cliente',
        'id_empleado',
        'id_sucursal_origen',
        'id_sucursal_destino',
        'id_chofer',
        'id_auto',
    ];

    // Relaciones
    public function cliente() { return $this->belongsTo(Cliente::class, 'id_cliente'); }
    public function empleado() { return $this->belongsTo(User::class, 'id_empleado'); }
    public function sucursalOrigen() { return $this->belongsTo(Sucursal::class, 'id_sucursal_origen'); }
    public function sucursalDestino() { return $this->belongsTo(Sucursal::class, 'id_sucursal_destino'); }
    public function chofer() { return $this->belongsTo(Chofer::class, 'id_chofer'); }
    public function auto() { return $this->belongsTo(Auto::class, 'id_auto'); }
}
