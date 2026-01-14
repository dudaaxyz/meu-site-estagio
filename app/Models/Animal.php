<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animais';

    protected $fillable = [
        'nome',
        'especie',
        'raca',
        'idade',
        'sexo',
        'foto',
        'status',
    ];

    public function adocoes()
    {
        return $this->hasMany(Adoe::class, 'animal_id');
    }
}
