<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo','nome',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function tshirt()
    {
        return $this->belongsTo(Tshirt::class, 'cor_codigo', 'codigo');
    }
}
