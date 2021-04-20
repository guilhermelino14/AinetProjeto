<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    use HasFactory;

    public function encomenda()
    {
        return $this->hasMany(Encomenda::class, 'id', 'encomenda_id');
    }

    public function estampa()
    {
        return $this->hasMany(Estampa::class, 'id', 'estampa_id');
    }

    public function cor()
    {
        return $this->hasMany(Cor::class, 'codigo', 'cor_codigo');
    }
}
