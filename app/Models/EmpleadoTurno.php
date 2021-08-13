<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoTurno extends Model
{
    use HasFactory;
    protected $table='empleado_turnos';
    protected $fillable = [
        'user_id',
        'turno_id'
    ];
}
