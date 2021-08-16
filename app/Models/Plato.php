<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    use HasFactory;
    protected $table='platos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'estado',
        'cantidad'
    ];

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class);
    }


}
