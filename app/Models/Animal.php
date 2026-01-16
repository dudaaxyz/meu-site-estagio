<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animais';

    protected $fillable = [
        'nome','especie','raca','idade','sexo','foto','status',
        'user_id','descricao','cidade','uf','contato_whatsapp'
    ];

    public function dono()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'user_id');
    }
}
