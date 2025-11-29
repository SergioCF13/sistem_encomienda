<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    protected $primaryKey = 'id_auto';

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'capacidad',
        'estado'
    ];
}
