<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','nome',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function estampa()
    {
        return $this->belongsTo(Estampa::class, 'categoria_id', 'id');
    }
}
