<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preco extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','preco_un_catalogo', 'preco_un_proprio', 'preco_un_catalogo_desconto', 'preco_un_proprio_desconto', 'quantidade_desconto',
    ];

    protected $hidden = [
        'deleted_at',
    ];
}
