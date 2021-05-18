<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','encomenda_id', 'estampa_id', 'cor_codigo', 'tamanho', 'quantidade','preco_un', 'subtotal',
    ];

    public function encomenda()
    {
        //tshirt belongsTo encomenda (1:N)
        return $this->belongsTo(Encomenda::class, 'id', 'encomenda_id');
    }

    public function estampas()
    {
        //tshirt belongsTo estampa (1:N)
        return $this->belongsTo(Estampa::class, 'id', 'estampa_id');
    }

    public function cor()
    {
        //tshirt belongsTo cor (1:N)
        return $this->belongsTo(Cor::class, 'codigo', 'cor_codigo');
    }
}
