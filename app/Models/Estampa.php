<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estampa extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id','cliente_id', 'categoria_id', 'nome', 'descricao', 'imagem_url','informacao_extra',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function cliente()
    {
        //estampa belongsTo cliente (1:N)
        return $this->belongsTo(Cliente::class, 'id', 'id');
    }

    public function tshirt()
    {
        //estampa hasMany tshirt (N:1)
        return $this->hasMany(Tshirt::class, 'estampa_id', 'id');
    }

    public function categorias()
    {
        //estampa belongsTo categoria (1:N)
        return $this->belongsTo(Categoria::class, 'id', 'categoria_id');
    }
}
