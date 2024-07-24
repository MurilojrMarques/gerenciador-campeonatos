<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confronto extends Model
{
    use HasFactory;

    protected $fillable = [
        'campeonato_id',
        'time_casa',
        'placar_casa',
        'time_visitante',
        'placar_visitante',
        'vencedor',
    ];

    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class);
    }
}
