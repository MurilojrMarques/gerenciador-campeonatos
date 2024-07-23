<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public static function boot()
    {
        parent::boot();

        
        static::creating(function ($model) {
            if (static::where('nome', $model->nome)->exists()) {
                throw new \Exception('Time já cadastrado.');
            }
        });
    }
}
