<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estampa extends Model
{
    use HasFactory;


    public function cliente()
    {
        return $this->hasMany(Cliente::class, 'id', 'cliente_id');
    }

    public function tshirt()
    {
        return $this->belongsTo(Tshirt::class, 'estampa_id', 'id');
    }

    public function categoria()
    {
        return $this->hasMany(Categoria::class, 'id', 'categoria_id');
    }
}
