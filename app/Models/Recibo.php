<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;
    protected $table='recibos';
    protected $fillable = [
        'fecha',
        'total',
        'user_id',
        'mesa_id',
        'pedido_id'
    ];
}
