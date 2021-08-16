<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table='pedidos';
    protected $fillable = [
        'activo',
        'user_id',
        'mesa_id'

    ];

    public function platos()
    {
        return $this->belongsToMany(Plato::class);
    }
    public function pplatos()
    {
        return $this->hasMany(PedidoPlato::class);
    }

}
