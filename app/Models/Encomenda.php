<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','estado', 'cliente_id', 'data', 'preco_total', 'notas','nif', 'endereco', 'tipo_pagamento', 'ref_pagamento', 'recibo_url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function cliente()
    {
        //encomenda belongsTo cliente (N:1)
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function tshirt()
    {
        //encomenda hasMany tshirt (N:1)
        return $this->hasMany(Tshirt::class, 'encomenda_id', 'id');
    }
}
