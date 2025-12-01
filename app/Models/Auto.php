<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    protected $primaryKey = 'id_auto';

    protected $fillable = [
        'numero_movil',
        'placa',
        'marca',
        'modelo',
        'estado'
    ];
}
