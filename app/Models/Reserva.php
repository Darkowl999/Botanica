<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table='reservas';
    protected $fillable = [
        'fecha',
        'hora',
        'cant_personas',
        'estado',
        'user_id',
        'mesa_id'
    ];
}
