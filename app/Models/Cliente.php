<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','nif','endereco','tipo_pagamento','ref_pagamento'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function user()
    {
        //client belongsTo user (1:1)
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function encomendas()
    {
        //cliente hasMany encomendas (1:N)
        return $this->hasMany(Encomenda::class, 'cliente_id', 'id');
    }

    public function estampas()
    {
        //cliente hasMany estampas (1:N)
        return $this->hasMany(Estampa::class, 'cliente_id', 'id');
    }
}
