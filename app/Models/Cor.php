<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
    use HasFactory;

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
