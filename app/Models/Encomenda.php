<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    public function cliente()
    {
        return $this->hasMany(Cliente::class, 'id', 'cliente_id');
    }

    public function tshirt()
    {
        return $this->belongsTo(Tshirt::class, 'encomenda_id', 'id');
    }
}
