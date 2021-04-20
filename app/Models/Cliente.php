<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'nif','endereco','tipo_pagamento','ref_pagamento'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function encomenda()
    {
        return $this->belongsTo(Encomenda::class, 'cliente_id', 'id');
    }

    public function estampa()
    {
        return $this->belongsTo(Estampa::class, 'cliente_id', 'id');
    }
}
