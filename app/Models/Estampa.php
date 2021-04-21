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
