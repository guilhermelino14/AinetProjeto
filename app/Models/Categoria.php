<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;

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
