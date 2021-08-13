<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoPlato extends Model
{
    use HasFactory;
    protected $table='pedido_platos';
    protected $fillable = [
        'cantidad',
        'modificacion',
        'pedido_id',
        'plato_id'
    ];
}
