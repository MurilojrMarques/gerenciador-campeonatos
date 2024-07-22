<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confronto extends Model
{
    protected $fillable = [
        'time_casa',
        'placar_casa',
        'time_visitante',
        'placar_visitante',
        'vencedor',
    ];
}
