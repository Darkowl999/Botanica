<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoPlato extends Model
{
    use HasFactory;
    protected $table='pedido_plato';
    protected $fillable = [
        'cantidad',
        'pedido_id',
        'plato_id'
    ];
    public function pedidos()
    {
        return $this->belongsTo(Pedido::class);
    }
}
